<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsGallery extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['products_id', 'photo', 'is_default'];

    protected $table = 'product_galleries';

    protected $hidden = [];

    public function products()
    {
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }

    public function getPhotoAttribute($value)
    {
        return url('storage/' . $value);
    }
}
