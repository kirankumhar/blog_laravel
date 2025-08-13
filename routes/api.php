<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Blog;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
use App\Http\Controllers\BlogController;

Route::get('/blogs', [BlogController::class, 'apiIndex']);
Route::get('/blogs/{id}', function ($id) {
    return Blog::findOrFail($id);
});