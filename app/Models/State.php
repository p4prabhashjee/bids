<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'country_id',
        'name',
        'image',
        'status'
    ];

    function country() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}