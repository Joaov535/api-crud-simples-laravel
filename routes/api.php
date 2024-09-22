<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/list',  [ProductController::class, 'list'])->name('list');
Route::get('/list/{id}',  [ProductController::class, 'listById'])->name('listById');

Route::post('/create', [ProductController::class, 'create'])->name('create');