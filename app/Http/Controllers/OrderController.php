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

    public function store(Request $request){

         $validator = Validator::make([
            'user_id' => 'required',
            'shipping_address'=> 'required',
             'shipping_city' => 'required',
             'shipping_state' => 'required',
             'shipping_zip' =>'required',
             'total_amount' => 'required'
         ]);

         if($validator->fails()){

            return response()->json([
               'success' => false,
                'error' => $validator->errors(),
            ],422);
         }
         
         Product::create([
           'order_number'=>$request->order_number,
            'status' => $request->status,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_state' => $request->shipping_state,
            'shipping_zip' => $request->shipping_zip,
            'shipping_country' => $request->shipping_country,
            'shipping_method' => $request->shipping_method, // Method of shipping (e.g., standard, express)
            'shipping_cost' =>0,
            'total_amount' => $request->total_amount,
            'discount' => $request->discount,
            'tax' => $request->tax,
            'tracking_number' => $request->tracking_number,
            'carrier' => 'FedEx, UPS',
         ]);
          
         return response()->json([
            'success'=> true,
            'message' => 'order placed successfully',
         ]);
         
    }

}
