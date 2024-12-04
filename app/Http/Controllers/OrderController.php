<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($id){
      
        $orders = Order::where('user_id',$id)->get()->toArray();

        return response()->json([
           'success'=> true,
            'orders' => $orders,
        ]);
    }
}
