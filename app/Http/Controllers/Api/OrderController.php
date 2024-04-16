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
    public function index(Order $order): JsonResponse
    {
        $this->authorize('viewAny', Order::class);
        $orders = OrderResource::collection($order::all());


        return response()->json([
            'orders' => $orders
        ]);
    }

    public function show($id): JsonResponse
    {
//        Checking for authorization
        $this->authorize('view', Order::class);

        $order = Order::find($id);
        $orderResource = OrderResource::make(Order::find($id));

        return response()->json([
            'order' => $orderResource
        ]);
    }

    public function store(OrderRequest $request): JsonResponse
    {
//        Checking for authorization
        $this->authorize('create', Order::class);

        $order = Order::create($request->safe()->except('products'));

        if (empty($order->service)) {
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

    public function update($id, OrderRequest $request): JsonResponse
    {
//        Checking for authorization


        $order = Order::find($id);
        $this->authorize('update', $order);
        $order->update($request->safe()->except('products'));

        if (empty($order->service)) {
//            $products = $request->input('products');
//            foreach ($products as $product) {
//                $productId = $product['id'];
//                $quantity = $product['quantity'];
//                $order->products()->update($productId, ['quantity' => $quantity]);
//            }
            // Extract product IDs and quantities from the request
            $products = collect($request->input('products'))->mapWithKeys(function ($product) {
                return [$product['id'] => ['quantity' => $product['quantity']]];
            })->toArray();

            // Sync products with the order, updating quantities as necessary
            $order->products()->sync($products);

        }

        $order->save();
        $order = OrderResource::make($order);

        return response()->json([
            'order' => $order
        ]);
    }

    public function destroy($id, Order $order): JsonResponse
    {
//        Checking for authorization
        $this->authorize('delete', Order::class);

        $order = Order::find($id);
        $order->delete();
        $orders = OrderResource::collection(Order::all());

        return response()->json([
            'order' => $orders
        ]);
    }
}
