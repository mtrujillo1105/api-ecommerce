<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Producto creado exitosamente',
            'product' => $product
        ], 201);
    }

    public function update(Request $request, $id) 
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => "Producto no encontrado"
            ], 404);
        }

        $product->update($request->all());

        return response()->json([
            'message' => 'Producto actualizado exitosamente',
            'product' => $product
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => "Producto no encontrado"
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Producto eliminado'
        ], 200);
    }
}
