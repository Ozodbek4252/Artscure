<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ToolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ------------- Public Routes -------------

// Auth
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// News Category
Route::get('/newsCategories', [NewsCategoryController::class, 'index'])->name('newsCategory');

// News
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{num}', [NewsController::class, 'paginate'])->name('news.paginate');
Route::get('/new/{slug}', [NewsController::class, 'show'])->name('news.show');

// Product
Route::get('/products', [ProductController::class, 'index'])->name('product');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products/{num}', [ProductController::class, 'paginate'])->name('product.paginate');

// Type
Route::get('/types', [TypeController::class, 'index'])->name('type.index');
Route::get('/type/{slug}', [TypeController::class, 'show'])->name('type.show');

// Artist
Route::get('/artists', [ArtistController::class, 'index'])->name('artist.index');
Route::get('/artists/{num}', [ArtistController::class, 'paginate'])->name('artist.paginate');
Route::get('/artist/{slug}', [ArtistController::class, 'show'])->name('artist.show');

// Contact
Route::post('/contacts', [ContactController::class, 'store'])->name('contact');

// Banner
Route::get('/banners/main', [BannerController::class, 'main'])->name('banners');
Route::get('/banners/bottom', [BannerController::class, 'bottom'])->name('banners');

// Request
Route::post('/requests',[RequestController::class, 'store'])->name('requests.store');

Route::post('/search', [SearchController::class, 'search'])->name('search');
Route::post('/filter', [FilterController::class, 'filter'])->name('filter');

// ------------- Protected Routes -------------
Route::group([
    'middleware' => 'auth:sanctum',
    'isAdmin',
], function () {
    Route::post('/admin', [AuthController::class, 'show'])->name('admin.show');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    
    // Type
    Route::get('/types/{num}', [TypeController::class, 'paginate'])->name('type.paginate');
    Route::post('/types', [TypeController::class, 'store'])->name('type.store');
    Route::put('/types/{slug}', [TypeController::class, 'update'])->name('type.update');
    Route::delete('/types/{slug}', [TypeController::class, 'destroy'])->name('type.delete');

    // Artist
    Route::post('/artists', [ArtistController::class, 'store'])->name('artist.store');
    Route::put('/artists/{slug}', [ArtistController::class, 'update'])->name('artist.update');
    Route::delete('/artists/{slug}', [ArtistController::class, 'destroy'])->name('artist.delete');

    // Tool
    Route::get('/tools', [ToolController::class, 'index'])->name('tool');
    Route::get('/tools/{num}', [ToolController::class, 'paginate'])->name('tool.paginate');
    Route::get('/tool/{id}', [ToolController::class, 'show'])->name('tool.show');
    Route::post('/tools', [ToolController::class, 'store'])->name('tool.store');
    Route::put('/tools/{id}', [ToolController::class, 'update'])->name('tool.update');
    Route::delete('/tools/{id}', [ToolController::class, 'destroy'])->name('tool.delete');

    // Contact
    Route::get('/contacts',[ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{num}',[ContactController::class, 'paginate'])->name('contacts.paginate');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Banner
    Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('/banners/{id}', [BannerController::class, 'show'])->name('banners.show');
    Route::post('/banners', [BannerController::class, 'store'])->name('banners.store');
    Route::put('/banners/{id}', [BannerController::class, 'update'])->name('banners.update');
    Route::delete('/banners/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');

    // Request
    Route::get('/requests',[RequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{num}',[RequestController::class, 'paginate'])->name('requests.paginate');
    Route::get('/request/{id}',[RequestController::class, 'show'])->name('requests.show');
    Route::delete('/requests/{id}',[RequestController::class, 'destroy'])->name('requests.destroy');

    // NewsCategory
    Route::get('/newsCategory/{id}', [NewsCategoryController::class, 'show'])->name('newsCategory.show');
    Route::post('/newsCategory', [NewsCategoryController::class, 'store'])->name('newsCategory.store');
    Route::put('/newsCategory/{id}', [NewsCategoryController::class, 'update'])->name('newsCategory.update');
    Route::delete('/newsCategory/{id}', [NewsCategoryController::class, 'destroy'])->name('newsCategory.destroy');

    // News
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::put('/news/{slug}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{slug}', [NewsController::class, 'destroy'])->name('news.destroy');
    
    // Product
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    Route::put('/products/{slug}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/{slug}', [ProductController::class, 'destroy'])->name('product.destroy');

    //Toolable
    Route::get('/toolables', [ToolableController::class, 'index'])->name('toolable');
    Route::get('/toolables/{id}', [ToolableController::class, 'show'])->name('toolable.show');
    Route::post('/toolables', [ToolableController::class, 'store'])->name('toolable.store');
    Route::put('/toolables/{id}', [ToolableController::class, 'update'])->name('toolable.update');
    Route::delete('/toolables/{id}', [ToolableController::class, 'destroy'])->name('toolable.destroy');
    
});


