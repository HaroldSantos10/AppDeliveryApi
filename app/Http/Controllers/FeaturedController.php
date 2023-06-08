<?php

namespace App\Http\Controllers;

use App\Models\Featured;
use Illuminate\Http\Request;

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

        return view('featured.index', compact('featureds'))
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
        return view('featured.create', compact('featured'));
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

        return view('featured.show', compact('featured'));
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

        return view('featured.edit', compact('featured'));
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
