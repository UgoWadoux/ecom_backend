<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryRessource;
use App\Http\Resources\ProductRessource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
//        Checking for authorization
//        $this->authorize('showAny', Category::class);

        $categories = CategoryRessource::collection(Category::all());

        return response()->json([
            'categories' => $categories
        ]);
    }

    public function show($id): JsonResponse
    {
//        Checking for authorization
//        $this->authorize('show', Category::class);

        $category = new CategoryRessource(Category::find($id));
        $category = CategoryRessource::make($category);

        return response()->json([
            'category' => $category
        ]);
    }

    public function store(CategoryRequest $request): JsonResponse
    {
//        Checking for authorization
        $this->authorize('create', Category::class);

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();
        $category = CategoryRessource::make($category);

        return response()->json([
            'category' => $category
        ]);
    }

    public function update($id, CategoryRequest $request): JsonResponse
    {
//        Checking for authorization
        $this->authorize('update', Category::class);

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();
        $category = CategoryRessource::make($category);

        return response()->json([
            'category' => $category
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $category = Category::find($id);
        $this->authorize('delete', $category);
        $category->delete();

        $categories = CategoryRessource::collection(Category::all());

        return response()->json([
            'categories' => $categories
        ]);
    }
}
