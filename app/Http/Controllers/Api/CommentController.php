<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index():JsonResponse
    {
        $comments = CommentResource::collection(Comment::all());

        return response()->json([
           'comments'=>$comments
        ]);
    }
    public function show($id): JsonResponse
    {
        $comment = CommentResource::make(Comment::find($id));

        return response()->json([
           'comment'=>$comment
        ]);
    }
    public function store(CommentRequest $request): JsonResponse
    {
        $comment = Comment::create($request->all());
        $comment = CommentResource::make($comment);

        return response()->json([
           'comment'=>$comment
        ]);
    }
    public function update($id, CommentRequest $request): JsonResponse
    {
        $comment = Comment::find($id);
        $comment->update($request->all());
        $comment->save();
        $comment = CommentResource::make($comment);

        return response()->json([
           'comment'=>$comment
        ]);
    }
    public function destroy($id): JsonResponse
    {
        $comment = Comment::find($id);
        $comment->delete();

        return response()->json([
           'comments'=>$this->index()
        ]);
    }
}
