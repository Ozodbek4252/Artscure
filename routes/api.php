<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
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

// Category
Route::get('/category/count/{count}', [CategoryController::class, 'index'])->name('category');

// Type
Route::get('/type', [TypeController::class, 'index'])->name('type');
Route::get('/type/{slug}', [TypeController::class, 'show'])->name('type.show');

// Artist
Route::get('/artist', [ArtistController::class, 'index'])->name('artist');
Route::get('/artist/{slug}', [ArtistController::class, 'show'])->name('artist.show');

// News Category
Route::get('/newsCategory', [NewsCategoryController::class, 'index'])->name('newsCategory');

//news
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

//Product
Route::get('/products', [ProductController::class, 'index'])->name('product');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('product.show');


// ------------- Protected Routes -------------
Route::group([
    'middleware' => 'auth:sanctum',
    'isAdmin',
], function () {
    Route::post('/admin', [AuthController::class, 'show'])->name('admin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    
    // Type
    Route::post('/type', [TypeController::class, 'store'])->name('type.store');
    Route::put('/type/{slug}', [TypeController::class, 'update'])->name('type.update');
    Route::delete('/type/{slug}', [TypeController::class, 'destroy'])->name('type.destroy');

    // Artist
    Route::post('/artist', [ArtistController::class, 'store'])->name('artist.store');
    Route::put('/artist/{slug}', [ArtistController::class, 'update'])->name('artist.update');
    Route::delete('/artist/{slug}', [ArtistController::class, 'destroy'])->name('artist.destroy');

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
});

