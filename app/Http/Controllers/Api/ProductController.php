<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductRessource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
//        Checking for authorization
        $this->authorize('viewAny', Product::class);

        $products = ProductRessource::collection(Product::all());

        return response()->json([
            'products' => $products
        ]);
    }

    public function store(ProductRequest $request): JsonResponse
    {
//        Checking for authorization
        $this->authorize('create', Product::class);

//       Getting the category from the id
        $category = Category::where('name', $request->input('category'))->first();
//       Creating a new product and initializing it
        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category()->associate($category);
        $product->save();
//        dd($product);
//        Transforming the product to display the product with the ProductRessource
        $product = ProductRessource::make($product);

        return response()->json([
            'product' => $product
        ]);
    }

    public function show($id): JsonResponse
    {
//        Checking for authorization
        $this->authorize('view', Product::class);

        $product = new ProductRessource(Product::find($id));
//        dd($product);

        return response()->json([
            "product" => $product
        ]);
    }

    public function update($id, ProductRequest $request): JsonResponse
    {
//        Checking for authorization
        $this->authorize('update', Product::class);

        $product = Product::find($id);
        $category = Category::where('name', $request->input('category'))->first();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category()->associate($category);
        $product->save();
//        Transforming the product to display the product with the ProductRessource
        $product = ProductRessource::make($product);

        return response()->json([
            'product' => $product
        ]);
    }

    public function destroy($id): JsonResponse
    {
//        Checking for authorization
        $this->authorize('delete', Product::class);

        $product = Product::find($id);
        $product->delete();
        $products = ProductRessource::collection(Product::all());

        return response()->json([
            'products' => $products
        ]);
    }
}
