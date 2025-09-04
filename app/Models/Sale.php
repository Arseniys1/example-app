<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'warehouse_id',
        'amount',
        'cost',
        'profit',
        'payment_status',
        'payment_method',
        'sale_date'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'cost' => 'decimal:2',
        'profit' => 'decimal:2',
        'sale_date' => 'datetime'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function profit(): HasOne
    {
        return $this->hasOne(Profit::class);
    }
}
