<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'image_path',
        'status',
        'auction_type_id',
        'lang_id'
       
    ];

    public function products()
{
    return $this->hasMany(Product::class, 'category_id');
}

public function projects()
{
    return $this->hasMany(Project::class, 'category_id');
}

}
