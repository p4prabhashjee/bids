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
        'auction_type_id',
        'auction_end_date',
        'project_id',
        'reserved_price',
        'description',
        'status', 
        'is_popular', 
        'slug', 
        'lot_no',
        'end_price',
        'lang_id'
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
    public function project()
{
    return $this->belongsTo(Project::class);
}


    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'product_id');
    }
   
    public function specifications()
    {
        return $this->hasMany(Specification::class, 'product_id');
    }

   
    

}
