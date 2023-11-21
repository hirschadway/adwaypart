<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kala extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'properties',
        'product_id',
        'img',
        'properties',
    ];
    protected $casts = [
        'img'=>'array',
        'properties'=>'array',
    ];
   
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    
}
