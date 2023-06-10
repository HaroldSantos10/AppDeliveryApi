<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;

/**
 * Class RestaurantController
 * @package App\Http\Controllers
 */
class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::paginate();
        $categories = Category::all();

        return view('restaurant.index', compact('restaurants', 'categories'))
            ->with('i', (request()->input('page', 1) - 1) * $restaurants->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurant = new Restaurant();
        $categories = Category::all();
        return view('restaurant.create', compact('restaurant', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Restaurant::$rules);

        // Guardar la imagen en la carpeta de almacenamiento
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'restaurant_images');
        } else {
            $imagePath = null;
        }
    
        // Crear el restaurante y guardar la ruta de la imagen en la base de datos
        $restaurant = Restaurant::create([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'description' => $request->input('description'),
            'lng' => $request->input('lng'),
            'lat' => $request->input('lat'),
            'address' => $request->input('address'),
            'stars' => $request->input('stars'),
            'reviews' => $request->input('reviews'),
            'category_id' => $request->input('category_id')

        ]);
    
        return redirect()->route('restaurants.index')
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
        $restaurant = Restaurant::find($id);
        $categories = Category::all();

        return view('restaurant.show', compact('restaurant', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::find($id);
        $categories = Category::all();

        return view('restaurant.edit', compact('restaurant', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate(restaurant::$rules);


        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($restaurant->image) {
                Storage::disk('restaurant_images')->delete($restaurant->image);
            }
            // Guardar la nueva imagen
            $imagePath = $request->file('image')->store('restaurants', 'restaurant_images');
            $restaurant->image = $imagePath;
        }
    
        // Actualizar los demás campos del restaurante
        $restaurant->name = $request->input('name');
        $restaurant->description = $request->input('description');
        $restaurant->lng = $request->input('lng');
        $restaurant->lat = $request->input('lat');
        $restaurant->address = $request->input('address');
        $restaurant->stars = $request->input('stars');
        $restaurant->reviews = $request->input('reviews');
        $restaurant->category_id = $request->input('category_id');
        $restaurant->save();
    
        return redirect()->route('restaurants.index')
            ->with('success', 'Restaurant updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);

 
        if ($restaurant->image) {
            Storage::disk('restaurant_images')->delete($restaurant->image);
        }
    
        $restaurant->delete();
    
        return redirect()->route('restaurants.index')
            ->with('success', 'Restaurant deleted successfully');
    }
}
