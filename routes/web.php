<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{Auth\LoginController,
    OAuthController,
    ProductController,
    SearchController,
    HomeController,
    LikeController,
    CommentController};
use App\Http\Controllers\Account\AccountController as AccountController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BinderController as AdminBinderController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\CatalogController as AdminCatalogController;
use App\Http\Controllers\Admin\AdditiveController as AdminAdditiveController;
use App\Http\Controllers\Admin\EnvironmentController as AdminEnvironmentController;
use App\Http\Controllers\Admin\NumberController as AdminNumberController;
use App\Http\Controllers\Admin\ResistanceController as AdminResistanceController;
use App\Http\Controllers\Admin\SubstarteController as AdminSubstrateController;
use App\Http\Controllers\Admin\SearchController as AdminSearchController;






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
//welcome
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/info', function () {
    return view('info');
})->name('info');
//products

Route::group(['as' => 'products.', 'prefix' => 'products'], function(){
    Route::get('/', [ProductController::class, 'index'])
    ->name('index');
    Route::get('/{product}', [ProductController::class, 'show'])
    ->where('product', '\d+')
    ->name('show');
    Route::get('/compare', [ProductController::class, 'compare'])
        ->name('compare');
    Route::get('/by/{param}/{slug}', [ProductController::class, 'indexBySlug'])
        ->where('param', '\w+')
        ->name('indexBySlug');
    Route::get('/for/{param}/{value}', [ProductController::class, 'indexByParam'])
        ->where('param', '\w+')
        ->name('indexByParam');
    });
//likes
Route::get('/like/{product}', [LikeController::class, 'likeHandling'])
    ->where('product', '\d+')
    ->name('like');

//search

Route::resources([
    '/search' => SearchController::class,
]);
Route::get('/search', [SearchController::class, 'index'])
    ->name('search');
Route::post('/search/quick', [SearchController::class, 'quickProductSearch'])
//    ->where('content', '\w+')
    ->name('search.quick');

//comments
Route::resources([
    '/comment' => CommentController::class,
]);
Route::group(['as' => 'comment.', 'prefix' => 'comment'], function(){
    Route::get('/', [CommentController::class, 'index'])
        ->name('index');
    Route::get('/{comment}', [CommentController::class, 'show'])
        ->where('comment', '\d+')
        ->middleware('auth')
        ->name('show');

});
//Route::post('/comment/quick', [CommentController::class, 'quickStore'])
//    ->name('comment.quick');

// session
Route::get('/products/compare/{product}', [ProductController::class, 'addToCompare'])
    ->where('product', '\d+');

//admin

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function (){
    Route::group(['as' => 'account.', 'prefix' => 'account'], function (){
        Route::get('/', [AccountController::class, 'index'])
        ->middleware('verified')
            ->name('index');
        Route::get('/my/products', [AccountController::class, 'showFavoriteProducts'])
        ->middleware('verified')
            ->name('my');
    });

    Route::get('/logout', [LoginController::class, 'logout'])
    ->name('account.logout');

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function() {
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
            '/users' => AdminUserController::class,
            '/searches' => AdminSearchController::class,

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
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users');
        Route::get('/searches', [AdminSearchController::class, 'index'])
            ->name('searches');
    });
});
Route::group(['middleware' => 'guest'], function(){
    Route::get('/auth/{network}/redirect', [OAuthController::class, 'redirect'])
        ->where('network', '\w+')
        ->name('auth.redirect');
    Route::get('/auth/{network}/callback', [OAuthController::class, 'callback'])
        ->where('network', '\w+')
        ->name('auth.callback');
}

);
