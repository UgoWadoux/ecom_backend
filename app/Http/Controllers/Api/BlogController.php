<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\UserResource;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(): JsonResponse
    {
        $blogs = BlogResource::collection(Blog::all());

        return response()->json([
            'blogs'=>$blogs
        ]);
    }
    public function show($id): JsonResponse
    {
        $blog = BlogResource::make(Blog::find($id));

        return response()->json([
            'blog'=>$blog
        ]);
    }
    public function store(BlogRequest $request): JsonResponse
    {
        $blog = Blog::create($request->all());
        $blog = BlogResource::make($blog);

        return response()->json([
            'blog'=>$blog
        ]);
    }
    public function update($id, BlogRequest $request): JsonResponse
    {
        $blog = Blog::find($id);
        $blog->update($request->all());
        $blog->save();
        $blog = BlogResource::make($blog);

        return response()->json([
            'blog'=>$blog
        ]);
    }
    public function destroy($id): JsonResponse
    {
        $blog = Blog::find($id);
        $blog->delete();

        $blogs = BlogResource::collection(Blog::all());

        return response()->json([
           'blogs'=>$blogs
        ]);
    }
}
