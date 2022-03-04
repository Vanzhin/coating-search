<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProductController};

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
Route::get('/home', function () {
    return view('home');
})->name('home');

//products

Route::group(['as' => 'products.', 'prefix' => 'products'], function(){
    Route::get('/', [ProductController::class, 'index'])
    ->name('index');
    Route::get('/{product}', [ProductController::class, 'show'])
    ->where('product', '\d+')
    ->name('show');
    Route::get('/brand/{brand}', [ProductController::class, 'brand'])
        ->where('brand', '\d+')
        ->name('brand');
    Route::get('/environment/{environment}', [ProductController::class, 'environment'])
        ->where('environment', '\d+')
        ->name('environment');
    });
