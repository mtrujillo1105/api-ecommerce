<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'user', 'items.product'
        ])->orderBy('created_at', 'desc')->get();

        return response()->json($orders, 200);
    }

    public function show($id)
    {
        $order = Order::with([
            'user', 'items.product'
        ])->find($id);

        if (!$order) {
            return response()->json([
                'message' => 'Pedido no encontrado'
            ], 404);
        }

        return response()->json($order, 200);
    }

    public function changeState(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'message' => 'Pedido no encontrado'
            ], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => 'Estado del pedido actualizado correctamente',
            'order'   => $order
        ], 200);
    }
}
