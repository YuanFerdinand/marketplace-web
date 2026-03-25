<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /** @use HasFactory<\Database\Factories\ProductImageFactory> */
    use UUID;

    protected $fillable = [
        'product_id',
        'image',
        'is_thumbnail',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
