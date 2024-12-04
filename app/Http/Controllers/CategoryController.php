<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::paginate(10);

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    public function store(Request $request){
         
        $validator = Validator::make($request->all(),[
           'name'=> 'required:string',
           'description'=> 'required|string',
        ]);

        if($validator->fails()){

            return response()->json([
                'success'=>false,
                 'message'=> 'validaton error',
                 'errors'=> $validator->errors(),
            ],422);
        }

        try{

            $Category = Category::create($request->al());
            return response()->json([
               'success'=> true,
                'message' => 'category  added successfully',
                 'category' => $Category
            ],201);
        }
        catch(Exception $error){
            
            return response()->json([
               'error'=> $error->messages(),
               'success' => false,
            ],500);
        }
    }

    public function edit($id){

        $category =Category::find($id);

        if(!$category){
         
            return response()->json([
              'success'=> false,
               'error'=> 'category not found'
            ],404);
        }

        return response()->json([
            'success'=> true,
             'category'=> $category
          ],200);
    }
}
