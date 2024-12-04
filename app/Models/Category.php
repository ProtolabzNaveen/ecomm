<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
   
    protected $fillable = [
        'name',
        'description'
    ];

    public function product(){

        return $this->hasOne(Product::class);
    }

}