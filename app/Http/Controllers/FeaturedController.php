<?php

namespace App\Http\Controllers;

use App\Models\Featured;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Models\Restaurant;

/**
 * Class FeaturedController
 * @package App\Http\Controllers
 */
class FeaturedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featureds = Featured::paginate();
        $restaurants = Restaurant::all();

        return view('featured.index', compact('featureds', 'restaurants'))
            ->with('i', (request()->input('page', 1) - 1) * $featureds->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $featured = new Featured();
        $restaurants = Restaurant::all();
        return view('featured.create', compact('featured', 'restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Featured::$rules);

        $featured = Featured::create($request->all());

        return redirect()->route('featureds.index')
            ->with('success', 'Featured created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $featured = Featured::find($id);
        $restaurants = Restaurant::all();

        return view('featured.show', compact('featured', 'restaurants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $featured = Featured::find($id);
        $restaurants = Restaurant::all();

        return view('featured.edit', compact('featured', 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Featured $featured
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Featured $featured)
    {
        request()->validate(Featured::$rules);

        $featured->update($request->all());


        return redirect()->route('featureds.index')
            ->with('success', 'Featured updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $featured = Featured::find($id)->delete();

        return redirect()->route('featureds.index')
            ->with('success', 'Featured deleted successfully');
    }
}
