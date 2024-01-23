<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index():JsonResponse
    {
        $orders = OrderResource::collection(Order::all());

        return response()->json([
            'orders' => $orders
        ]);
    }

    public function show($id): JsonResponse
    {
        $order = OrderResource::make(Order::find($id));

        return response()->json([
            'order' => $order
        ]);
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->safe()->except('products'));
        if (empty($order->service)){
            $products = $request->input('products');
            foreach ($products as $product) {
                $productId = $product['id'];
                $quantity = $product['quantity'];
                $order->products()->attach($productId, ['quantity' => $quantity]);
            }
        }
        $order = OrderResource::make($order);
        return response()->json([
            'order' => $order
        ]);
    }

    public function update($id, OrderRequest $request)
    {
        $order = Order::find($id);
        $order->update($request->safe()->except('products'));
        if (empty($order->service)){
            $products = $request->input('products');
            foreach ($products as $product) {
                $productId = $product['id'];
                $quantity = $product['quantity'];
                $order->products()->attach($productId, ['quantity' => $quantity]);
            }
        }
        $order->save();
        $order = OrderResource::make($order);

        return response()->json([
            'order' => $order
        ]);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        $orders = OrderResource::collection(Order::all());

        return response()->json([
            'order' => $orders
        ]);
    }
}
