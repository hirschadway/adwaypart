<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'link',
        'img',
        'price',
        'situation',
        'properties',
        'mainproduct_id',
        'shop_id',
    ];
    protected $casts = [
        'img'=>'array',
        'properties'=>'array',
    ];
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id');
    }
    public function mainproduct()
    {
        return $this->belongsTo(Mainproduct::class,'mainproduct_id');
    }
    
    public function kalas()
    {
        return $this->hasMany(Kala::class,'product_id');
    }
    public function categorizedproducts()
    {
        return $this->hasMany(Categorizedproduct::class,'product_id');
    }

}
