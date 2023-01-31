<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\ArtistController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\NewsCategoryController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TypeController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\FilterController;
use App\Http\Controllers\API\HelpController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\RequestController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\ToolController;
use App\Http\Controllers\API\OrderController;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PaymentTypeController;

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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::get('payment_types', [PaymentTypeController::class, 'index']);
Route::get('payment_types/{id}', [PaymentTypeController::class, 'show']);

// News Category
Route::get('/newsCategories', [NewsCategoryController::class, 'index']);

// News
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{slug}', [NewsController::class, 'show']);

// Category
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/popular', [CategoryController::class, 'getPopular']);
Route::get('/categories/{slug}', [CategoryController::class, 'show']);

// Product
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/filter', [ProductController::class, 'filterProduct']);
Route::get('/products/{slug}', [ProductController::class, 'show']);

// Help
Route::get('/helps/create', [HelpController::class, 'store']);

// Types
Route::get('/types', [TypeController::class, 'index']); //------------------------------
Route::get('/types/{slug}', [TypeController::class, 'show']); //------------------------------

// Artist
Route::get('/artists', [ArtistController::class, 'index']);
Route::get('/artists/filter', [ArtistController::class, 'filterArtist']);
Route::get('/artists/popular', [ArtistController::class, 'getPopular']);
Route::get('/artists/{slug}', [ArtistController::class, 'show']);

// Contact
Route::get('/contacts/create', [ContactController::class, 'store']);

// Banner
Route::get('/banners', [BannerController::class, 'index']);

// Request
Route::get('/requests/create', [RequestController::class, 'store']);

// Tool
Route::get('/tools', [ToolController::class, 'index']);

// Order
Route::get('/orders/create', [OrderController::class, 'store']);
Route::get('/orders/{slug}', [OrderController::class, 'show']);

Route::get('/search', [SearchController::class, 'search']);
Route::get('/filter', [FilterController::class, 'filter']);


// ------------- Protected Routes -------------
Route::group([
    'middleware' => 'auth:sanctum',
    'revalidate',
    'isAdmin',
], function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);

    // Help
    Route::delete('/helps/{id}', [HelpController::class, 'destroy']);
    Route::get('/helps', [HelpController::class, 'index']);

    // Category
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // Type
    Route::post('/types', [TypeController::class, 'store']); //------------------------------
    Route::put('/types/{slug}', [TypeController::class, 'update']); //------------------------------
    Route::delete('/types/{slug}', [TypeController::class, 'destroy']); //------------------------------

    // Artist
    Route::post('/artists', [ArtistController::class, 'store']);
    Route::put('/artists/{slug}', [ArtistController::class, 'update']);
    Route::delete('/artists/{slug}', [ArtistController::class, 'destroy']);

    // Tool
    Route::get('/tools/{id}', [ToolController::class, 'show']);
    Route::post('/tools', [ToolController::class, 'store']);
    Route::put('/tools/{id}', [ToolController::class, 'update']);
    Route::delete('/tools/{id}', [ToolController::class, 'destroy']);

    // Contact
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::get('/contacts/{num}', [ContactController::class, 'paginate']);
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);

    // Banner
    Route::get('/banners/{id}', [BannerController::class, 'show']);
    Route::post('/banners', [BannerController::class, 'store']);
    Route::put('/banners/{id}', [BannerController::class, 'update']);
    Route::delete('/banners/{id}', [BannerController::class, 'destroy']);

    // Request
    Route::get('/requests', [RequestController::class, 'index']);
    Route::get('/requests/{id}', [RequestController::class, 'show']);
    Route::delete('/requests/{id}', [RequestController::class, 'destroy']);

    // NewsCategory
    Route::get('/newsCategory/{id}', [NewsCategoryController::class, 'show']);
    Route::post('/newsCategory', [NewsCategoryController::class, 'store']);
    Route::put('/newsCategory/{id}', [NewsCategoryController::class, 'update']);
    Route::delete('/newsCategory/{id}', [NewsCategoryController::class, 'destroy']);

    // News
    Route::post('/news', [NewsController::class, 'store']);
    Route::put('/news/{slug}', [NewsController::class, 'update']);
    Route::delete('/news/{slug}', [NewsController::class, 'destroy']);

    // Product
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{slug}', [ProductController::class, 'update']);
    Route::delete('/products/{slug}', [ProductController::class, 'destroy']);

    // Order
    Route::get('orders', [OrderController::class, 'index']);
    Route::delete('orders/{slug}', [OrderController::class, 'destroy']);


    //Toolable
    // Route::get('/toolables', [ToolableController::class, 'index']);
    // Route::get('/toolables/{id}', [ToolableController::class, 'show']);
    // Route::post('/toolables', [ToolableController::class, 'store']);
    // Route::put('/toolables/{id}', [ToolableController::class, 'update']);
    // Route::delete('/toolables/{id}', [ToolableController::class, 'destroy']);

    // Delete Image
    Route::delete('/image/{id}', [ImageController::class, 'destroy']);
});
