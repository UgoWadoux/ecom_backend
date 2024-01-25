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
        $this->authorize('viewAny', $comments);

        return response()->json([
           'comments'=>$comments
        ]);
    }
    public function show($id, Comment $comment): JsonResponse
    {
        $this->authorize('view', $comment);
        $comment = CommentResource::make($comment::find($id));

        return response()->json([
           'comment'=>$comment
        ]);
    }
    public function store(CommentRequest $request, Comment $comment): JsonResponse
    {
        $this->authorize('create', $comment);
        $comment = $comment::create($request->all());
        $comment = CommentResource::make($comment);

        return response()->json([
           'comment'=>$comment
        ]);
    }
    public function update($id, CommentRequest $request, Comment $comment): JsonResponse
    {
        $this->authorize('update', $comment);
        $comment = $comment::find($id);
        $comment->update($request->all());
        $comment->save();
        $comment = CommentResource::make($comment);

        return response()->json([
           'comment'=>$comment
        ]);
    }
    public function destroy($id, Comment $comment): JsonResponse
    {
        $this->authorize('delete', $comment);
        $comment = Comment::find($id);
        $comment->delete();

        return response()->json([
           'comments'=>$this->index()
        ]);
    }
}
