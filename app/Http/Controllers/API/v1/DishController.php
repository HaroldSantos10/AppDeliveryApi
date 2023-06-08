<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;

use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
  
    public function index()
    {
        $dishes = Dish::select('dishes.*'
        ,'restaurants.name as restaurant')
        ->join('restaurants', 'restaurants.id', '=','dishes.restaurant_id')
        ->paginate(10);
        return response()->json($dishes);
    }

    
    public function store(Request $request)
    {
        $validator = \Validator::make($request->input(),Dish::$rules);
        if ($validator->fails()){
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $dish = new Dish($request->input());
        $dish->save();
        return response()->json([
            'status' =>true,
            'message' => 'Dish created succesfully'
        ], 200);
    }

    
    public function show(Dish $dish)
    {
        return respose()->json(['status' => true, 'data' => $dish]);
    }

    
    public function update(Request $request, Dish $dish)
    {
        $validator = \Validator::make($request->input(),Dish::$rules);
        if ($validator->fails()){
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $dish->update($request->input());

        return response()->json([
            'status' => true,
            'message' => 'Dish updated succesfully'
        ], 200);
    }

    
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return response()->json([
            'status' => true,
            'message' => 'Dish deleted succesfully'
        ], 200);
    }

    //get how much dishes exist for each restaurant

    public function dishesByRestaurant(){
        $dishes = Dish::select(DB::raw('count(dishes.id) as count, restaurants.name'))
        ->rightJoin('restaurants', 'restaurants.id', '=', 'dishes.restaurant_id')
        ->groupBy('restaurants.name')->get();
        return response()->json($dishes);
    }
    public function all(){
        $dishes = Dish::select('dishes.*', 'restaurants.name as restaurant')
        ->join('restaurants', 'restaurants.id', '=', 'dishes.restaurant_id')
        ->get();
        return response()->json($dishes);
    }


}
