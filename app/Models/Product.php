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
        'Is_It_Bid_Increment',
        'Bid_Increment',
        'brand_id',
        'status',
        'deposit',
        'deposit_amount',
        'no_of_entries',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

    public function auctiontype()
    {
        return $this->belongsTo(Auctiontype::class,'auction_type_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'product_id');
    }
    

}
