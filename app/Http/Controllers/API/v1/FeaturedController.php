<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;

use App\Models\Featured;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
    
    public function index()
    {
        $featureds = Featured::select('featureds.*'
        ,'restaurants.name as restaurant')
        ->join('restaurants', 'restaurants.id', '=','featureds.restaurant_id')
        ->paginate(10);
        return response()->json($featureds);
    }

    
    public function store(Request $request)
    {
        $validator = \Validator::make($request->input(),Featured::$rules);
        if ($validator->fails()){
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $featured = new featured($request->input());
        $featured->save();
        return response()->json([
            'status' =>true,
            'message' => 'Featured created succesfully'
        ], 200);
    }

    
    public function show(Featured $featured)
    {
        return respose()->json(['status' => true, 'data' => $featured]);
    }

    
    public function update(Request $request, Featured $featured)
    {
        $validator = \Validator::make($request->input(),Featured::$rules);
        if ($validator->fails()){
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $featured->update($request->input());

        return response()->json([
            'status' => true,
            'message' => 'Featured updated succesfully'
        ], 200);
    }

    
    public function destroy(Featured $featured)
    {
        $featured->delete();
        return response()->json([
            'status' => true,
            'message' => 'Featured deleted succesfully'
        ], 200);
    }

    //get how much featureds exist for each restaurant

    public function featuredsByRestaurant(){
        $featureds = Featured::select(DB::raw('count(featureds.id) as count, restaurants.name'))
        ->rightJoin('restaurants', 'restaurants.id', '=', 'featureds.restaurant_id')
        ->groupBy('restaurants.name')->get();
        return response()->json($featureds);
    }
    public function all(){
        $featureds = Featured::select('featureds.*', 'restaurants.name as restaurant')
        ->join('restaurants', 'restaurants.id', '=', 'featureds.restaurant_id')
        ->get();
        return response()->json($featureds);
    }



}
