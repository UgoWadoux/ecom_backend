<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductRessource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class ProductController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    /**
     * @OA\Info(title="My First API", version="0.1")
     */
    /**
     * @OA\Get(
     *     path="/product",
     *     @OA\Response(response="200", description="Display a listing of projects.")
     * )
     */
    /**
     * @SWG\Get(
     *     path="/product",
     *     summary="Get a list of products",
     *     tags={"Products"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function index(): JsonResponse
    {
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
