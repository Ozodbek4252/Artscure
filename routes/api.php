<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RequestController;
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
Route::get('/type/{slug}', [TypeController::class, 'show'])->name('type');

// Artist
Route::get('/artist', [ArtistController::class, 'index'])->name('artist');
Route::get('/artist/{slug}', [ArtistController::class, 'show'])->name('artist');

// Contact
Route::post('/contact', [ContactController::class, 'store'])->name('contact');

// Banner
Route::get('/banners/main', [BannerController::class, 'main'])->name('banners');
Route::get('/banners/bottom', [BannerController::class, 'bottom'])->name('banners');

// Request
Route::post('/requests',[RequestController::class, 'store'])->name('requests');


// ------------- Protected Routes -------------
Route::group([
    'middleware' => 'auth:sanctum',
    'isAdmin',
], function () {
    Route::post('/admin', [AuthController::class, 'show'])->name('admin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category');
    Route::post('/category', [CategoryController::class, 'store'])->name('category');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category');
    
    // Type
    Route::post('/type', [TypeController::class, 'store'])->name('type');
    Route::put('/type/{slug}', [TypeController::class, 'update'])->name('type');
    Route::delete('/type/{slug}', [TypeController::class, 'destroy'])->name('type');
    
    // Artist
    Route::post('/artist', [ArtistController::class, 'store'])->name('artist');
    Route::put('/artist/{slug}', [ArtistController::class, 'update'])->name('artist');
    Route::delete('/artist/{slug}', [ArtistController::class, 'destroy'])->name('artist');
    
    // Contact
    Route::get('/contact',[ContactController::class, 'index'])->name('contact');
    Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact');

    // Banner
    Route::get('/banners', [BannerController::class, 'index'])->name('banners');
    Route::get('/banners/{id}', [BannerController::class, 'show'])->name('banners');
    Route::post('/banners', [BannerController::class, 'store'])->name('banners');
    Route::put('/banners/{id}', [BannerController::class, 'update'])->name('banners');
    Route::delete('/banners/{id}', [BannerController::class, 'destroy'])->name('banners');

    // Request
    Route::get('/requests',[RequestController::class, 'index'])->name('requests');
    Route::get('/requests/{id}',[RequestController::class, 'show'])->name('requests');
    Route::delete('/requests/{id}',[RequestController::class, 'destroy'])->name('requests');

});

