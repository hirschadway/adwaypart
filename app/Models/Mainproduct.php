<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mainproduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'link',
        'img',
        'properties',
        'productcategory_id',
    ];
    protected $casts = [
        'img'=>'array',
        'properties'=>'array',
    ];
    public function products()
    {
        return $this->hasMany(Product::class,'mainproduct_id');
    }
    public function productcategory()
    {
        return $this->belongsTo(Productcategory::class,'productcategory_id');
    }
}
