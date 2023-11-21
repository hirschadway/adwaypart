<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalagroup extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'title',
    ];
    public function categorizedproducts()
    {
        return $this->hasMany(Categorizedproduct::class,'Kalagroup_id');
    }
   
}
