<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function productsByCategory($category_id) 
    {

        $category = Category::find($category_id);

        if (!$category) {
            return response()->json(
                ['mensaje' => 'Categoria no encontrada'], 404
            );
        }

        $products = Product::with('category')
                    ->where('category_id', $category_id)
                    ->get();
        return response()->json([
            'category' => $category->name,
            'products' => $products
        ], 200);
    }
}
