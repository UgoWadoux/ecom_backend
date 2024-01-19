<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryRessource;
use App\Http\Resources\ProductRessource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = CategoryRessource::collection(Category::all());

        return response()->json([
           'categories'=>$categories
        ]);
    }
    public function getCategory($id)
    {
        $category = new CategoryRessource(Category::find($id));
        $category = CategoryRessource::make($category);

        return response()->json([
            'category'=>$category
        ]);
    }
    public function createCategory(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();
        $category = CategoryRessource::make($category);

        return response()->json([
            'category'=>$category
        ]);
    }
    public function modifyCategory($id, CategoryRequest $request)
    {
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();
        $category = CategoryRessource::make($category);

        return response()->json([
            'category'=>$category
        ]);
    }
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();

        $categories = CategoryRessource::collection(Category::all());

        return response()->json([
            'categories'=>$categories
        ]);
    }
}
