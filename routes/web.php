<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
    return view('index');
});

Route::get('/about', [AboutController::class, 'index'])->name('about');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'is_admin']], function () {
    Route::resource('products', ProductController::class, [
        'except' => ['index', 'show']
    ]);
});
Route::resource('products', ProductController::class, [
    'only' => ['index', 'show']
]);

Route::group(['middleware' => 'auth'], function() {
    Route::get('profile/me', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/me/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/me/update', [ProfileController::class, 'update'])->name('profile.update');
});
