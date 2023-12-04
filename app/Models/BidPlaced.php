<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidPlaced extends Model
{
    use HasFactory;
    protected $table ='bid_placed';
    protected $fillable = [
        'user_id',
        'project_id',
        'product_id',
        'bid_amount',
        'total_amount',
       
    ];

}
