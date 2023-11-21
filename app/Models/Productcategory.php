<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'description',
        'parent_id',
    ];
  
   
    public function mainproducts()
    {
        return $this->hasMany(Mainproduct::class,'productcategory_id');
    }
    
}
