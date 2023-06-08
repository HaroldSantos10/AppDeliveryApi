<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;

use App\Models\Restaurant;
use Illuminate\Http\Request;

use App\Models\Category;
use DB;

class RestaurantController extends Controller
{
   
    public function index()
    {
        $restaurants = Restaurant::select('restaurants.*'
        ,'categories.name as category')
        ->join('categories', 'categories.id', '=','restaurants.category_id')
        ->paginate(10);
        return response()->json($restaurants);
    }

    
    public function store(Request $request)
    {
        //$rules = ['name' => 'required|string|min:3' ];

        $validator = \Validator::make($request->input(),Restaurant::$rules);
        if ($validator->fails()){
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $restaurant = new Restaurant($request->input());
        $restaurant->save();
        return response()->json([
            'status' =>true,
            'message' => 'Restaurant created succesfully'
        ], 200);
    }

    
    public function show(Restaurant $restaurant)
    {
        return response()->json(['status' => true, 'data' => $restaurant]);
    }

    
    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = \Validator::make($request->input(),Restaurant::$rules);
        if ($validator->fails()){
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $restaurant->update($request->input());

        return response()->json([
            'status' => true,
            'message' => 'Restaurant updated succesfully'
        ], 200);
    }

    
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return response()->json([
            'status' => true,
            'message' => 'Restaurant deleted succesfully'
        ], 200);
    }

    //get how much restaurants exist for each category

    public function RestaurantsByCategory(){
        $restaurants = Restaurant::select(DB::raw('count(restaurants.id) as count, categories.name'))
        ->rightJoin('categories', 'categories.id', '=', 'restaurants.category_id')
        ->groupBy('categories.name')->get();
        return response()->json($restaurants);
    }
    public function all(){
        $restaurants = Restaurant::select('restaurants.*', 'categories.name as category')
        ->join('categories', 'categories.id', '=', 'restaurants.category_id')
        ->get();
        return response()->json($restaurants);
    }




}
