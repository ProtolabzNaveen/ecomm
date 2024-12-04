<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'products' => $products,
            'success' => true,
        ]);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction(); // Start database transaction
        try {
            $imagePath = null;

            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images/products', 'public');
            }
            // Create the product
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'stock' => $request->stock ?? 100,
                'category_id' => $request->category_id ?? 1,
                'sku' => $request->sku ?? 'PRODUCT-SKU-001',
                'image' => $imagePath,
                'status' => $request->status ?? 'active',
                'is_featured' => $request->is_featured ?? true,
                'attributes' => json_encode($request->attributes ?? ['color' => 'red', 'size' => 'M']),
                'rating' => $request->rating ?? 4.5,
            ]);

            DB::commit(); // Commit transaction

            return response()->json([
                'success' => true,
                'message' => 'Product saved successfully',
                'product' => $product,
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction in case of error

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
  {
    $product = Product::find($id);
    if (!$product) {
        return response()->json([
            'success' => false,
            'message' => 'Product not found',
        ], 404); // HTTP status code 404 for not found
    }

    return response()->json([
        'success' => true,
        'product' => $product,
    ]);
  }

   public function update(Request $request){
      
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string',
            'description'=> 'required|string',
            'image' => 'image|mimes:png,jpg'
        ]);

        if($validator->fails()){

            return response()->json([
                'errors'=> $validator->errors(),
                'success' => false,
                'message' => 'Validation errors',
            ],422);
        }

       DB::beginTransaction();

       try{

        $imagePath =Product::find($request->id)->value('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public');
        }

        Product::where('id',$request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock ?? 100,
            'category_id' => $request->category_id ?? 1,
            'sku' => $request->sku ?? 'PRODUCT-SKU-001',
            'image' => $imagePath,
            'status' => $request->status ?? 'active',
            'is_featured' => $request->is_featured ?? true,
            'attributes' => json_encode($request->attributes ?? ['color' => 'red', 'size' => 'M']),
            'rating' => $request->rating ?? 4.5,
           ]);

           DB::commit();
       }
       catch(Exception $err){
          DB::rollback();

          return response()->json([
            'success'=>false,
            'error'=> $err->messages(),
            'message'=>'something went wrong'
          ]);
       }
   }
}
