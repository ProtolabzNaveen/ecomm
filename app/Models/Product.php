<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Product extends Model
{
    protected $table = 'products';

    // public function Category(){

    //     return $this->hasOne(Category::class);
    // }

}
