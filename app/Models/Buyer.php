<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    /** @use HasFactory<\Database\Factories\BuyerFactory> */
    use UUID;

    protected $fillable = [
        'user_id',
        'profile_picture',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'buyer_id');
    }
}
