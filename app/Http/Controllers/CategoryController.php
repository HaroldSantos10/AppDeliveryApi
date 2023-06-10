<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate();

        return view('category.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * $categories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view('category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Category::$rules);

        // Guardar la imagen en la carpeta de almacenamiento
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'category_images');
        } else {
            $imagePath = null;
        }
    
        // Crear la categoría y guardar la ruta de la imagen en la base de datos
        $category = Category::create([
            'name' => $request->input('name'),
            'image' => $imagePath,
        ]);
    
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate(Category::$rules);


        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($category->image) {
                Storage::disk('category_images')->delete($category->image);
            }
            // Guardar la nueva imagen
            $imagePath = $request->file('image')->store('categories', 'category_images');
            $category->image = $imagePath;
        }
    
        // Actualizar los demás campos de la categoría
        $category->name = $request->input('name');
        $category->save();
    
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $category = Category::find($id);

 
        if ($category->image) {
            Storage::disk('category_images')->delete($category->image);
        }
    
        $category->delete();
    
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
