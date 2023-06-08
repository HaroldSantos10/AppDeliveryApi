<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;

use App\Models\Featured_dish;
use Illuminate\Http\Request;

class FeaturedDishController extends Controller
{

    public function index()
    {
        
        $featured_dishes = Featured_dish::all();
        return response()->json([
            'status' => true,
            'data' => $featured_dishes
        ], 200);

    }


    public function store(Request $request)
    {
        $validator = \Validator::make($request->input(), Featured_dish::$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $featuredDish = new Featured_dish($request->input());
        $featuredDish->save();
        return response()->json([
            'status' => true,
            'message' => 'Featured Dish created successfully'
        ], 200);
    }


    public function show(Featured_dish $featured_dish)
    {
        return response()->json(['status' => true, 'data' => $featured_dish]);
    }


    public function update(Request $request, Featured_dish $featured_dish)
    {
        $validator = \Validator::make($request->input(), Featured_dish::$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
    
        $featured_dish->update($request->all());
    
        return response()->json([
            'status' => true,
            'message' => 'Featured Dish updated successfully',
        ], 200);
    }


    public function destroy(Featured_dish $featured_dish)
    {
        $featured_dish->delete();

        return response()->json([
            'status' => true,
            'message' => 'Featured Dish deleted successfully'
        ], 200);
    }

    public function all()
    {
        $featured_dishes = Featured_dish::all();

        return response()->json([
            'status' => true,
            'data' => $featured_dishes
        ], 200);
    }





}
