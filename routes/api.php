<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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
Route::get('/categories/count/{count}', [CategoryController::class, 'index'])->name('category');

// Type
Route::get('/types', [TypeController::class, 'index'])->name('type.index');
Route::get('/types/{slug}', [TypeController::class, 'show'])->name('type.show');

// Artist
Route::get('/artists', [ArtistController::class, 'index'])->name('artist.index');
Route::get('/artists/{slug}', [ArtistController::class, 'show'])->name('artist.show');


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
    Route::post('/types', [TypeController::class, 'store'])->name('type.store');
    Route::put('/types/{slug}', [TypeController::class, 'update'])->name('type.update');
    Route::delete('/types/{slug}', [TypeController::class, 'destroy'])->name('type.delete');

    // Artist
    Route::post('/artists', [ArtistController::class, 'store'])->name('artist.store');
    Route::put('/artists/{slug}', [ArtistController::class, 'update'])->name('artist.update');
    Route::delete('/artists/{slug}', [ArtistController::class, 'destroy'])->name('artist.delete');

    // Tool
    Route::get('/tools', [ToolController::class, 'index'])->name('tool.index');
    Route::post('/tools', [ToolController::class, 'store'])->name('tool.store');
    Route::put('/tools/{id}', [ToolController::class, 'update'])->name('tool.update');
    Route::delete('/tools/{id}', [ToolController::class, 'destroy'])->name('tool.delete');

});

