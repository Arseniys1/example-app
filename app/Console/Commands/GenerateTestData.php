<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Warehouse;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Profit;
use Faker\Factory as Faker;

class GenerateTestData extends Command
{
    protected $signature = 'generate:test-data
                            {--warehouses=5 : Number of warehouses to create}
                            {--orders=20 : Number of orders to create}
                            {--sales=30 : Number of sales to create}
                            {--profits=40 : Number of profits to create}';

    protected $description = 'Generate test data for warehouses, orders, sales and profits with customizable quantities';

    public function handle()
    {
        $faker = Faker::create();

        $this->info('Starting test data generation...');

        $warehouseCount = (int)$this->option('warehouses');
        $this->info("Creating {$warehouseCount} warehouses...");

        $warehouses = [];
        for ($i = 0; $i < $warehouseCount; $i++) {
            $warehouses[] = Warehouse::create([
                'name' => $faker->company . ' Warehouse',
                'address' => $faker->address,
                'contact_phone' => $faker->phoneNumber,
                'is_active' => $faker->boolean(90)
            ]);
        }
        $this->info("{$warehouseCount} warehouses created successfully.");

        $orderCount = (int)$this->option('orders');
        $this->info("Creating {$orderCount} orders...");

        $orders = [];
        for ($i = 0; $i < $orderCount; $i++) {
            $totalAmount = $faker->randomFloat(2, 50, 5000);
            $discount = $faker->randomFloat(2, 0, $totalAmount * 0.3);
            $tax = $faker->randomFloat(2, 0, $totalAmount * 0.2);
            $finalAmount = $totalAmount - $discount + $tax;

            $orders[] = Order::create([
                'order_number' => 'ORD' . $faker->unique()->uuid(),
                'warehouse_id' => $faker->randomElement($warehouses)->id,
                'customer_name' => $faker->name,
                'customer_phone' => $faker->phoneNumber,
                'customer_address' => $faker->address,
                'total_amount' => $totalAmount,
                'discount_amount' => $discount,
                'tax_amount' => $tax,
                'final_amount' => $finalAmount,
                'status' => $faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
                'notes' => $faker->boolean(30) ? $faker->sentence : null,
            ]);
        }
        $this->info("{$orderCount} orders created successfully.");

        $saleCount = (int)$this->option('sales');
        $this->info("Creating {$saleCount} sales...");

        $sales = [];
        for ($i = 0; $i < $saleCount; $i++) {
            $order = $faker->randomElement($orders);
            $amount = $faker->randomFloat(2, 10, 2000);
            $cost = $faker->randomFloat(2, $amount * 0.4, $amount * 0.9);
            $profit = $amount - $cost;

            $sales[] = Sale::create([
                'order_id' => $order->id,
                'warehouse_id' => $order->warehouse_id,
                'amount' => $amount,
                'cost' => $cost,
                'profit' => $profit,
                'payment_status' => $faker->randomElement(['pending', 'paid', 'partial', 'refunded']),
                'payment_method' => $faker->randomElement(['cash', 'card', 'transfer']),
            ]);
        }
        $this->info("{$saleCount} sales created successfully.");

        $profitCount = (int)$this->option('profits');
        $this->info("Creating {$profitCount} profits...");

        for ($i = 0; $i < $profitCount; $i++) {
            $sale = $faker->randomElement($sales);
            $amount = $sale->profit;
            $taxAmount = $faker->randomFloat(2, 0, $amount * 0.2);
            $netAmount = $amount - $taxAmount;

            Profit::create([
                'sale_id' => $sale->id,
                'amount' => $amount,
                'tax_amount' => $taxAmount,
                'net_amount' => $netAmount,
                'type' => $faker->randomElement(['sale', 'refund', 'other']),
                'description' => $faker->boolean(40) ? $faker->sentence : null,
            ]);
        }
        $this->info("{$profitCount} profits created successfully.");

        $this->info('Test data generation completed successfully!');
        $this->info("Total created: {$warehouseCount} warehouses, {$orderCount} orders, {$saleCount} sales, {$profitCount} profits");
    }
}
