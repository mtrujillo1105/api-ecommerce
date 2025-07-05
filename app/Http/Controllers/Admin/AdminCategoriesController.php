<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCategoriesController extends Controller
{
   public function index ()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function store (Request $request)
    {
        $category = Category::create($request->all());

        return response()->json([
            'message' => 'Categoria creado exitosamente',
            'category' => $category
        ], 201);
    }

    public function update (Request $request, $id) 
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => "Categoria no encontrado"
            ], 404);
        }

        $category->update($request->all());

        return response()->json([
            'message' => 'Categoria actualizado exitosamente',
            'category' => $category
        ], 200);
    }

    public function destroy ($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => "Categoria no encontrado"
            ], 404);
        }

        $category->delete();

        return response()->json([
            'message' => 'Categoria eliminado'
        ], 200);
    }
}
