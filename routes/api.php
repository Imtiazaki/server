<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('forum', [ForumController::class, 'index']);
Route::post('forum', [ForumController::class, 'create']);
Route::get('forum/{id}', [ForumController::class, 'detail']);
Route::put('forum/{id}', [ForumController::class, 'update']);
Route::delete('forum/{id}', [ForumController::class, 'delete']);

Route::get('comment', [CommentController::class, 'index']);
Route::post('comment', [CommentController::class, 'create']);
Route::get('comment/{id}', [CommentController::class, 'detail']);
Route::put('comment/{id}', [CommentController::class, 'update']);
Route::delete('comment/{id}', [CommentController::class, 'delete']);

Route::get('user', [UserController::class, 'index']);
Route::post('user', [UserController::class, 'create']);
Route::get('user/{id}', [UserController::class, 'detail']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'delete']);

Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');
