<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\PrivateController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', [PublicController::class, 'index']);

Route::get('/home', [PrivateController::class, 'home'])
    ->name('private.home')->middleware('auth');

Route::post('/store', [PrivateController::class, 'store'])
    ->name('private.ticket.store')->middleware('auth');

Route::get('/admin/categories', [CategoryController::class, 'index'])
    ->name('admin.categories')->middleware('auth');

Route::post('/admin/categories/store', [CategoryController::class, 'store'])
    ->name('admin.categories.store')->middleware('auth');

Route::post('/admin/categories/destroy/{id}', [CategoryController::class, 'destroy'])
    ->name('admin.categories.destroy')->middleware('auth');

Route::post('/admin/categories/enable', [CategoryController::class, 'enable'])
    ->name('admin.categories.enable')->middleware('auth');

Route::post('/admin/categories/disable', [CategoryController::class, 'disable'])
    ->name('admin.categories.disable')->middleware('auth');

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

require __DIR__.'/auth.php';
