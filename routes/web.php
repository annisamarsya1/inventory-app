<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/insert', [ProductController::class, 'insert']);
Route::get('/update', [ProductController::class, 'update']);
Route::get('/delete', [ProductController::class, 'delete']);