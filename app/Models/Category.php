<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Modles\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
   
    protected $fillable = [
        'name',
        'description'
    ];

    public function product(){

        return $this->hasOne(Product::class);
    }

}
