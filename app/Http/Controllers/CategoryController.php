<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::paginate(10);

        return response()->json([
            'data' => CategoryResource::collection($categories),
            'pagination' => $categories->toArray()
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

            $category = Category::create([
                'name'=> $request->name,
                'description' => $request->description
            ]);
            return response()->json([
               'success'=> true,
                'message' => 'category  added successfully',
                 'category' => $category
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

    public function update(Request $request){
       
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
               'success' => false,
               'errors' => $validator->errors()
            ]);
        }
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404); // Return 404 if category not found
        }
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully',
        ], 204); // Return 204 No Content for successful deletion
    }

}
