<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{

    use HasFactory, Sluggable;
    
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class); // 1 product memiliki 1 kategori
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class); // 1 product memiliki banyak gambar
    }

    public function variant()
    {
        return $this->hasMany(ProductVariant::class); // 1 product memiliki banyak ukuran
    }

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
