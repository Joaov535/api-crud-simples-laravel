<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::get('/products',  [ProductController::class, 'list']);
Route::get('/products/{id}',  [ProductController::class, 'listById']);
Route::post('/products', [ProductController::class, 'create']);
Route::put('/products', [ProductController::class, 'edit']);
Route::delete('/products/{id}', [ProductController::class, 'delete']);