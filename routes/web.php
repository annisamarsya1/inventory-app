<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::redirect('/', '/products');
Route::redirect('/projects', '/products');

Route::resource('products', ProductController::class);
Route::get('/create', [ProductController::class, 'create']);
Route::get('/edit/{product}', [ProductController::class, 'edit']);
Route::delete('/delete/{product}', [ProductController::class, 'destroy']);

