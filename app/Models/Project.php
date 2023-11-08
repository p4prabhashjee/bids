<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_path',
        'status',
        'is_trending',
        'auction_type_id',
        'start_date_time',
       
    ];

  
    public function auctiontype()
{
    return $this->belongsTo(Auctiontype::class, 'auction_type_id');
}


    
    
}
