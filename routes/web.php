<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/list',  [ProductController::class, 'list'])->name('list');
Route::get('/list/{id}',  [ProductController::class, 'listById'])->name('listById');

Route::post('/create', [ProductController::class, 'create'])->name('create');