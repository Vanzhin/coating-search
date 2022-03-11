<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProductController, SearchController};
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\BinderController as AdminBinderController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\CatalogController as AdminCatalogController;
use App\Http\Controllers\Admin\AdditiveController as AdminAdditiveController;
use App\Http\Controllers\Admin\EnvironmentController as AdminEnvironmentController;
use App\Http\Controllers\Admin\NumberController as AdminNumberController;
use App\Http\Controllers\Admin\ResistanceController as AdminResistanceController;
use App\Http\Controllers\Admin\SubstarteController as AdminSubstrateController;






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

//search

Route::resources([
    '/search' => SearchController::class,
]);
Route::get('/search', [SearchController::class, 'index'])
    ->name('search');


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
        '/additives' => AdminAdditiveController::class,
        '/environments' => AdminEnvironmentController::class,
        '/numbers' => AdminNumberController::class,
        '/resistances' => AdminResistanceController::class,
        '/substrates' => AdminSubstrateController::class,

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
    Route::get('/environments', [AdminEnvironmentController::class, 'index'])
        ->name('environments');
    Route::get('/numbers', [AdminNumberController::class, 'index'])
        ->name('numbers');
    Route::get('/resistances', [AdminResistanceController::class, 'index'])
        ->name('resistances');
    Route::get('/substrates', [AdminSubstrateController::class, 'index'])
        ->name('substrates');
});
