<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use UUID;

    protected $fillable = [
        'store_id',
        'product_category_id',
        'name',
        'slug',
        'description',
        'condition',
        'price',
        'weight',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'id');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
