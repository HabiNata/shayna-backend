<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'type', 'description', 'price', 'quantity'];

    protected $hidden = [];

    public function galleries()
    {
        return $this->hasMany(ProductsGallery::class, 'products_id');
    }
}
