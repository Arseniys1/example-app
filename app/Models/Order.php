<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'income_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'total_amount',
        'discount_amount',
        'tax_amount',
        'final_amount',
        'status',
        'notes',
        'order_date'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'order_date' => 'datetime'
    ];

    public function income(): BelongsTo
    {
        return $this->belongsTo(Income::class);
    }

    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class);
    }
}
