<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\ShortenerController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('/dashboard', [App\Http\Controllers\ShortenerController::class, 'store'])->middleware(['auth'])->name('url.shorten');
Route::post('/dashboard/{id}', [App\Http\Controllers\ShortenerController::class, 'update'])->middleware(['auth'])->name('update');
Route::get('/delete_url/{id}', [App\Http\Controllers\ShortenerController::class, 'destroy'])->middleware(['auth'])->name('url.delete');

require __DIR__.'/auth.php';
