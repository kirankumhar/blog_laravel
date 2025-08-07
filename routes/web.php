<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

//show all posts
Route::get('/',[PostController::class, 'index'])->name('posts.index');

// Show create post form
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

//Handle form submit and save post
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Show sigle post
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

//show edit form
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit'); 

//Handle form update and save
Route::put('/post/{id}', [PostController::class, 'update'])->name('posts.update');


//
Route::delete('/posts/{id}',[PostController::class, 'destroy'])->name('posts.destroy');