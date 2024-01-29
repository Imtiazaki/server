<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ForumRequest;
use App\Models\Forum;
use App\Events\ForumCreated;


class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::all();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $forums
        ], 200);
    }

    public function create(ForumRequest $request)
    {
        $data = $request->validated();
        $forum = new Forum($data);
        $forum->save();

        ForumCreated::dispatch($forum);
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $forum
        ], 200);

    }

    public function detail($id)
    {
        $forum = Forum::find($id);
        if (!$forum) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Forum not found'
                ]
            ], 404);
        }
        
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $forum
        ], 200);
    }

    public function update(ForumRequest $request, $id)
    {
        $forum = Forum::find($id);
        if (!$forum) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Forum not found'
                ]
            ], 404);
        }
        
        $data = $request->validated();
        $forum->update($data);

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $forum
        ], 200);
    }

    public function delete($id)
    {
        $forum = Forum::find($id);
        if (!$forum) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Forum not found'
                ]
            ], 404);
        }

        $forum->delete();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => 'Forum deleted successfully'
        ], 200);
    }
}