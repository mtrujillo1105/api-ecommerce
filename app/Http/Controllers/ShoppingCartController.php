<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index(Request $request)
    {
        $shoppingcart = $request->session()->get('shoppingcart', []);
        return response()->json(array_values($shoppingcart));
    }

    public function store(Request $request)
    {
        $product = Product::find($request->producto_id);

        if (isset($product)) {
            $shoppingcart[$product->id]['cantidad'] += $request->cantidad;
        }
        else {
            $shoppingcart[$product->id] = [
                "product_id"   => $product->id,
                "product_name" => $product->name,
                "quantity"     => 2,
                "price"        => $product->price,
            ];
        }

        $request->session()->put('shoppingcart', $shoppingcart);

        return response()->json([
            'message'      => "Producto agregado al carrito", 
            'shoppingcart' => array_values($shoppingcart)
        ], 201);
    }

    public function update (Request $request)
    {
        $shoppingcart = $request->session()->get('shoppingcart', []);

        if(!isset($shoppingcart[$request->product_id])) {
            return response()->json([
                'message' => 'Producto no encontrado en el carrito'
            ], 404);
        }

        $shoppingcart[$request->product_id]['quantity'] = $request->quantity;
        $request->session()->put('shoppingcart', $shoppingcart);

        return response()->json([
            'message'      => 'Cantidad actualizada',
            'shoppingcart' => array_values($shoppingcart)
        ], 200);
    }

    public function destroy(Request $request)
    {
        $shoppingcart = $request->session()->get('shoppingcart', []);

        if (isset($shoppingcart[$request->product_id])) {
            unset($shoppingcart[$request->product_id]);
            $request->session()->put('shoppingcart', $shoppingcart);
        }

        return response()->json([
            'message' => 'Producto eliminado del carrito',
            'shoppingcart', array_values($shoppingcart)
        ], 200);
    }

    public function empty()
    {
        $request->session()->forget('shoppingcart');
        return response()->json(['message' => 'Carrito vaciado'], 200);
    }
}
