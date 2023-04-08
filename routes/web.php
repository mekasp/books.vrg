<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('layouts/app');
});

Route::get('/book', [BookController::class, 'index'])->name('book');
Route::post('/book', [BookController::class, 'create'])->name('book.create');
Route::get('/book/{id}', [BookController::class, 'edit'])->name('book.edit');
Route::post('/book/update', [BookController::class, 'update'])->name('book.update');
Route::post('/book/{id}/delete', [BookController::class, 'delete'])->name('book.delete');

Route::get('/author', [AuthorController::class, 'index'])->name('author');
Route::post('/author', [AuthorController::class, 'create'])->name('author.create');
Route::get('/author/{id}', [AuthorController::class, 'edit'])->name('author.edit');
Route::post('/author/update', [AuthorController::class, 'update'])->name('author.update');
Route::post('/author/{id}/delete', [AuthorController::class, 'delete'])->name('author.delete');

