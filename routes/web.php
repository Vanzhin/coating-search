<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProductController};
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\BinderController as AdminBinderController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\CatalogController as AdminCatalogController;
use App\Http\Controllers\Admin\AdditiveController as AdminAdditiveController;





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

//admin
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function() {
    Route::get('/index', function () {
        return view('admin.index');
    })->name('index');
    Route::resources([
        '/products' => AdminProductController::class,
        '/binders' => AdminBinderController::class,
        '/brands' => AdminBrandController::class,
        '/catalogs' => AdminCatalogController::class,
        '/additives' => AdminAdditiveController::class




    ]);
    Route::get('/products', [AdminProductController::class, 'index'])
        ->name('products');
    Route::get('/binders', [AdminBinderController::class, 'index'])
        ->name('binders');
    Route::get('/brands', [AdminBrandController::class, 'index'])
        ->name('brands');
    Route::get('/catalogs', [AdminCatalogController::class, 'index'])
        ->name('catalogs');
    Route::get('/additives', [AdminAdditiveController::class, 'index'])
        ->name('additives');
});
