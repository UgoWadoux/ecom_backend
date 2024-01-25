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
        $products = ProductRessource::collection(Product::all());
        return response()->json([
            'products'=>$products
        ]);
    }
    public function store(ProductRequest $request, Product $product):JsonResponse
    {
        $this->authorize('create', $product);
//       Getting the category from the id
        $category = Category::where('name', $request->input('category'))->first();
//       Creating a new product and initializing it
//        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category()->associate($category);
        $product->save();
//        dd($product);
//        Transforming the product to display the product with the ProductRessource
        $product = ProductRessource::make($product);

        return response()->json([
            'product'=>$product
        ]);
    }

    public function show($id): JsonResponse
    {
        $product = new ProductRessource(Product::find($id));
//        dd($product);

        return response()->json([
            "product"=>$product
        ]);
    }
    public function update($id, ProductRequest $request): JsonResponse
    {
        $product = Product::find($id);
        $this->authorize('update', $product);
        $category = Category::where('name', $request->input('category'))->first();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category()->associate($category);
        $product->save();
//        dd($product);
//        Transforming the product to display the product with the ProductRessource
        $product = ProductRessource::make($product);

        return response()->json([
            'product'=>$product
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $product = Product::find($id);
        $this->authorize('delete', $product);
        $product->delete();
        $products = ProductRessource::collection(Product::all());

        return response()->json([
            'products'=>$products
        ]);
    }
}
