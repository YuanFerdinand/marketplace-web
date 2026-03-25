<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionDetailFactory> */
    use UUID;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'sub_total',
    ];

    protected $casts = [
        'qty' => 'integer',
        'sub_total' => 'decimal:2',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
