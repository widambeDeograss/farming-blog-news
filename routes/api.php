<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\SubscriptionController;


Route::get('/social-media', [SocialMediaController::class, 'index']);
Route::post('/social-media',[SocialMediaController::class, 'store']);
Route::put('/social-media/{id}', [SocialMediaController::class, 'update']);
Route::delete('/social-media/{id}',[SocialMediaController::class, 'destroy']);
Route::get('/tags', [TagController::class, 'index']);
Route::post('/tags',[TagController::class, 'store']);
Route::put('/tags/{id}', [TagController::class, 'update']);
Route::delete('/tags/{id}',[TagController::class, 'destroy']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories',[CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}',[CategoryController::class, 'destroy']);
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts',[PostController::class, 'store']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::delete('/posts/{id}',[PostController::class, 'destroy']);
Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments',[CommentController::class, 'store']);
Route::put('/comments/{id}', [CommentController::class, 'update']);
Route::get('/comments/{id}', [CommentController::class, 'show']);
Route::delete('/comments/{id}',[CommentController::class, 'destroy']);

Route::get('/subscriptions', [SubscriptionController::class, 'index']);
Route::post('/subscriptions',[SubscriptionController::class, 'store']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
