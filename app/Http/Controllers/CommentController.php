<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Events\CommentCreated;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $comments
        ], 200);
    }

    public function create(CommentRequest $request)
    {
        $data = $request->validated();
        $comment = new Comment($data);
        $comment->save();
        CommentCreated::dispatch($comment);

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $comment
        ], 200);
    }

    public function detail($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Comment not found'
                ]
            ], 404);
        }
        
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $comment
        ], 200);
    }

    public function update(CommentRequest $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Comment not found'
                ]
            ], 404);
        }
        
        $data = $request->validated();
        $comment->update($data);

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $comment
        ], 200);
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Comment not found'
                ]
            ], 404);
        }

        $comment->delete();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => 'Comment deleted successfully'
        ], 200);
    }
}