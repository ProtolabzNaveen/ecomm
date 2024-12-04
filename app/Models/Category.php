<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Modles\Product;
class Category extends Model
{
    protected $table = 'categories';
   
    protected $fillable = [
        'name',
        'description'
    ];

    // public function product(){

    //     return $this->hasOne(Product::class);
    // }

}
