<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorizedproduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'situation',
        'product_id',
        'kalagroup_id',
    ];
    public function kalagroup()
    {
        return $this->belongsTo(Kalagroup::class,'kalagroup_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
