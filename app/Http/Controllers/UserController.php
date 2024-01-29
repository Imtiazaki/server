<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $users
        ], 200);
    }

    public function create(UserRequest $request)
    {
        $data = $request->validated();
        $user = new User($data);
        $user->save();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $user
        ], 200);
    }

    public function detail($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'User not found'
                ]
            ], 404);
        }
        
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $user
        ], 200);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'User not found'
                ]
            ], 404);
        }
        
        $data = $request->validated();
        $user->update($data);

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $user
        ], 200);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'User not found'
                ]
            ], 404);
        }

        $user->delete();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => 'User deleted successfully'
        ], 200);
    }
}