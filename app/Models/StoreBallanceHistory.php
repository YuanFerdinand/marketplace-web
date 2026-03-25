<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class StoreBallanceHistory extends Model
{
    use UUID;

    protected $fillable = [
        'store_balance_id',
        'reference_id',
        'reference_type',
        'amount',
        'type',
        'remarks',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function storeBalance()
    {
        return $this->belongsTo(StoreBalance::class);
    }
}
