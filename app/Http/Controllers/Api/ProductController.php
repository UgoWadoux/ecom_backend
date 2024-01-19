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
    public function createProduct(ProductRequest $request)
    {
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
            'product'=>$product
        ]);
    }

    public function findProduct($id)
    {
        $product = new ProductRessource(Product::find($id));
//        dd($product);

        return response()->json([
            "product"=>$product
        ]);
    }
    public function modifyProduct($id, ProductRequest $request)
    {
        $product = Product::find($id);
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

    public function deleteProduct($id): JsonResponse
    {
        $product = Product::find($id);
        $product->delete();
        $products = ProductRessource::collection(Product::all());

        return response()->json([
            'products'=>$products
        ]);
    }
}
