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
//    /**
//     * @throws AuthorizationException
//     */


    /**
     * @OA\Get(
     *     path="/api/product",
     *     summary="Get a list of products",
     *     tags={"Products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index(): JsonResponse
    {
        $products = ProductRessource::collection(Product::all());

        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/product",
     *     summary="Create a product",
     *     @OA\Parameter(
     *         name="name",
     *         in = "query",
     *         description="Product's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *          name="price",
     *          in="query",
     *          description="Product's price",
     *          required=true,
     *          @OA\Schema(type="double")
     *      ),
     *     @OA\Parameter(
     *           name="description",
     *           in="query",
     *           description="Product's description",
     *           required=true,
     *           @OA\Schema(type="string")
     *       ),
     *     @OA\Parameter(
     *           name="category_id",
     *           in="query",
     *           description="Product's category, foreign key to the category table",
     *           required=true,
     *           @OA\Schema(type="string")
     *       ),
     *     @OA\Parameter(
     *           name="created_at",
     *           in="query",
     *           description="Product's creation date",
     *           required=true,
     *           @OA\Schema(type="timestamp")
     *       ),
     *     @OA\Parameter(
     *           name="updated_at",
     *           in="query",
     *           description="Product's update date",
     *           required=true,
     *           @OA\Schema(type="timestamp")
     *       ),
     *     tags={"Products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
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
