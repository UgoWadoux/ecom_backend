<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\UserResource;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = BlogResource::collection(Blog::all());

        return response()->json([
            'blogs'=>$blogs
        ]);
    }
    public function show($id)
    {
        $blog = BlogResource::make(Blog::find($id));

        return response()->json([
            'blog'=>$blog
        ]);
    }
    public function store(BlogRequest $request)
    {
        $blog = Blog::create($request->all());
        $blog = BlogResource::make($blog);

        return response()->json([
            'blog'=>$blog
        ]);
    }
    public function update($id, BlogRequest $request)
    {
        $blog = Blog::find($id);
        $blog->update($request->all());
        $blog->save();
        $blog = BlogResource::make($blog);

        return response()->json([
            'blog'=>$blog
        ]);
    }
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        $blogs = BlogResource::collection(Blog::all());

        return response()->json([
           'blogs'=>$blogs
        ]);
    }
}
