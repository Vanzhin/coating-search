<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{Auth\LoginController,
    Auth\UnauthorizedController,
    OAuthController,
    ProductController,
    SearchController,
    HomeController,
    LikeController,
    CommentController,
    CompilationController};
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
use App\Services\CompareService;

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

Route::group(['as' => 'products.', 'prefix' => 'products'], function () {
    // session
    Route::get('/compare/{product}', [CompareService::class, 'add'])
        ->where('product', '\d+');
    Route::get('/', [ProductController::class, 'index'])
        ->name('index');
    Route::get('/{product}', [ProductController::class, 'show'])
        ->where('product', '\d+')
        ->name('show');
    Route::get('/compare', [ProductController::class, 'compare'])
        ->name('compare');
    Route::get('/{param}/{value}', [ProductController::class, 'indexBySlug'])
        ->where('param', '\w+')
        ->name('indexBySlug');
    Route::get('/export/', [ProductController::class, 'export'])
        ->name('export');
    Route::get('/pdf', [ProductController::class, 'createPdf'])
        ->name('pdf');
    Route::get('/pdf-view', [ProductController::class, 'viewPdf'])
        ->name('pdf-view');


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
Route::get('/search/create/{product?}', [SearchController::class, 'create'])
    ->name('search.create');
Route::post('/search/quick', [SearchController::class, 'quickProductSearch'])
//    ->where('content', '\w+')
    ->name('search.quick');

//comments
Route::resources([
    '/comment' => CommentController::class,
]);
Route::group(['as' => 'comment.', 'prefix' => 'comment'], function () {
    Route::get('/', [CommentController::class, 'index'])
        ->name('index');
    Route::get('/{comment}', [CommentController::class, 'show'])
        ->where('comment', '\d+')
        ->middleware('auth')
        ->name('show');

});
//Route::post('/comment/quick', [CommentController::class, 'quickStore'])
//    ->name('comment.quick');

//admin

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

//public
Route::get('/compilations/by/{user}', [CompilationController::class, 'showAllByUser'])
    ->where('user','\d+')
    ->name('compilations.public');
Route::get('/compilations/{compilation}/by/{user}', [CompilationController::class, 'showOneByUser'])
    ->where('user','\d+')
    ->where('compilation', '\d+')
    ->name('compilations.one');

//для авторизованных пользователей
Route::group(['middleware' => ['auth']], function () {
    Route::get('/unauthorized', UnauthorizedController::class)
        ->name('unauthorized');
//todo сделать мидлвару чтобы пользователь мог смотреть только свой контент

//compilations
    Route::resources([
        '/compilations' => CompilationController::class,
    ]);
    Route::group(['as' => 'compilations.', 'prefix' => 'compilations', 'middleware'=> 'ensureUserIsYou'], function () {
            Route::get('/', [CompilationController::class, 'index'])
                ->name('compilations');
            Route::get('/add/product/{product}/to/compilation/{compilation}', [CompilationController::class, 'addProduct'])
                ->where('product','\d+')
                ->where('compilation', '\d+')
                ->name('add');
            Route::get('/delete/product/{product}/from/compilation/{compilation}', [CompilationController::class, 'deleteProduct'])
                ->where('product','\d+')
                ->where('compilation', '\d+')
                ->name('delete');
            Route::get('/move/product/{product}/from/compilation/{compFrom}/to/{compTo}', [CompilationController::class, 'moveProduct'])
                ->where('product','\d+')
                ->where('compFrom', '\d+')
                ->where('compTo', '\d+')
                ->name('move');
            Route::get('/private/{compilation}', [CompilationController::class, 'privateHandle'])
                ->where('compilation', '\d+')
                ->name('private');



    });

    Route::group(['as' => 'account.', 'prefix' => 'my', 'middleware' => 'verified'], function () {
        Route::get('/profile', [AccountController::class, 'index'])
            ->name('profile');
        Route::get('/products', [AccountController::class, 'showFavoriteProducts'])
            ->name('products');
        Route::get('/compilations', [AccountController::class, 'showCompilations'])
            ->name('compilations');

    });

    Route::get('/logout', [LoginController::class, 'logout'])
        ->name('account.logout');

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
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
Route::group(['middleware' => 'guest'], function () {
    Route::get('/auth/{network}/redirect', [OAuthController::class, 'redirect'])
        ->where('network', '\w+')
        ->name('auth.redirect');
    Route::get('/auth/{network}/callback', [OAuthController::class, 'callback'])
        ->where('network', '\w+')
        ->name('auth.callback');
}

);
