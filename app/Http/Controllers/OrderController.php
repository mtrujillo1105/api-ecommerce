<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
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

    public function store(Request $request)
    {
        try{

            DB::beginTransaction();
            
            $order = Order::create($request->all());

            foreach ($request->items as $item) {
                OrderItem::create([
                    "order_id"     => $order->id,
                    "product_id"   => $item['product_id'],
                    "product_name" => $item['product_name'],
                    "quantity"     => $item['quantity'],
                    "price"        => $item['price'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Orders creado exitosamente',
                'order' => $order
            ], 201);
        }
        catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al procesar el pedido',
                'error'   => $e->getMessage()
            ]);
        }
    }
}
