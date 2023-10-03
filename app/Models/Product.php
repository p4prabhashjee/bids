<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ='products';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'subcategory_id',
        'auction_type_id',
        'auction_start_date',
        'auction_end_date',
        'auction_start_time',
        'auction_end_time',
        'reserved_price',
        'minimum_bid',
        'brand_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

}
