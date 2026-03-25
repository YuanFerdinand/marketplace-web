<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use UUID;

    protected $fillable = [
        'code',
        'buyer_id',
        'store_id',
        'address',
        'address_id',
        'city',
        'postal_code',
        'shipping',
        'shipping_type',
        'shipping_cost',
        'tax',
        'grand_total',
        'payment_status',
    ];

    protected $casts = [
        'shipping_cost' => 'decimal:2',
        'tax' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
