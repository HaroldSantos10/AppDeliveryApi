<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Models\Restaurant;

/**
 * Class DishController
 * @package App\Http\Controllers
 */
class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::paginate();
        $restaurants = Restaurant::all();

        return view('dish.index', compact('dishes', 'restaurants'))
            ->with('i', (request()->input('page', 1) - 1) * $dishes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dish = new Dish();
        $restaurants = Restaurant::all();
        return view('dish.create', compact('dish', 'restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Dish::$rules);

        // Guardar la imagen en la carpeta de almacenamiento
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('dishes', 'dish_images');
        } else {
            $imagePath = null;
        }
    
        // Crear el platillo y guardar la ruta de la imagen en la base de datos
        $dish = Dish::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),            
            'image' => $imagePath,
            'restaurant_id' => $request->input('restaurant_id')

        ]);
    
        return redirect()->route('dishes.index')
            ->with('success', 'Restaurat created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dish = Dish::find($id);
        $restaurants = Restaurant::all();

        return view('dish.show', compact('dish', 'restaurants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish = Dish::find($id);
        $restaurants = Restaurant::all();

        return view('dish.edit', compact('dish', 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Dish $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $request->validate(Dish::$rules);


        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if($dish->image) {
                Storage::disk('dish_images')->delete($dish->image);
            }
            // Guardar la nueva imagen
            $imagePath = $request->file('image')->store('dishes', 'dish_images');
            $dish->image = $imagePath;
        }
    
        // Actualizar los demás campos del platillo
        $dish->name = $request->input('name');
        $dish->description = $request->input('description');
        $dish->price = $request->input('price');
        $dish->restaurant_id = $request->input('restaurant_id');
        $dish->save();
        return redirect()->route('dishes.index')
            ->with('success', 'Dish updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);

 
        if ($dish->image) {
            Storage::disk('dish_images')->delete($dish->image);
        }

        $dish = Dish::find($id)->delete();

        return redirect()->route('dishes.index')
            ->with('success', 'Dish deleted successfully');
    }
}
