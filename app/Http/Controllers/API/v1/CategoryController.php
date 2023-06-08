<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index() 
    {
        $categories = Category::all();
        return response()->json($categories);
    }

   
    public function store(Request $request)
    {
        //$rules = ['name' => 'required|string|min:3' ];

        $validator = \Validator::make($request->input(),Category::$rules);
        if ($validator->fails()){
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $category = new Category($request->input());
        $category->save();
        return response()->json([
            'status' =>true,
            'message' => 'Category created succesfully'
        ], 200);

    }

    
    public function show(Category $category)
    {
        return response()->json(['status' => true, 'data' => $category]);
    }

   
    public function update(Request $request, Category $category)
    {
        $validator = \Validator::make($request->input(),Category::$rules);
        if ($validator->fails()){
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $category->update($request->input());

        return response()->json([
            'status' => true,
            'message' => 'Category updated succesfully'
        ], 200);

    }

   
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'Category deleted succesfully'
        ], 200);

    }
}
