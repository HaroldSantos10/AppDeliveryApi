<?php

namespace App\Http\Controllers;

use App\Models\FeaturedDish;
use Illuminate\Http\Request;

/**
 * Class FeaturedDishController
 * @package App\Http\Controllers
 */
class FeaturedDishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featuredDishes = FeaturedDish::paginate();

        return view('featured-dish.index', compact('featuredDishes'))
            ->with('i', (request()->input('page', 1) - 1) * $featuredDishes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $featuredDish = new FeaturedDish();
        return view('featured-dish.create', compact('featuredDish'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(FeaturedDish::$rules);

        $featuredDish = FeaturedDish::create($request->all());

        return redirect()->route('featured-dishes.index')
            ->with('success', 'FeaturedDish created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $featuredDish = FeaturedDish::find($id);

        return view('featured-dish.show', compact('featuredDish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $featuredDish = FeaturedDish::find($id);

        return view('featured-dish.edit', compact('featuredDish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  FeaturedDish $featuredDish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeaturedDish $featuredDish)
    {
        request()->validate(FeaturedDish::$rules);

        $featuredDish->update($request->all());

        return redirect()->route('featured-dishes.index')
            ->with('success', 'FeaturedDish updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $featuredDish = FeaturedDish::find($id)->delete();

        return redirect()->route('featured-dishes.index')
            ->with('success', 'FeaturedDish deleted successfully');
    }
}
