<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auctiontype extends Model
{
    use HasFactory;
    protected $table ='auction_types';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];
}
