<?php

use App\Http\Controllers\Dashboard\ArtistController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\TypeController;
use App\Http\Controllers\Dashboard\ToolController;

use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\HelpController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\RequestController;

// DashboardController
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

// Route::get('/', function(){
//     return view('dashboard');
// });

Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register.page');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware([
    'auth',
    'revalidate',
    'isAdmin',
])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::get('/types', [TypeController::class, 'index'])->name('types.index');
    Route::get('/types/create', [TypeController::class, 'create'])->name('types.create');
    Route::post('/types', [TypeController::class, 'store'])->name('types.store');
    Route::get('/types/{Type:slug}/edit', [TypeController::class, 'edit'])->name('types.edit');
    Route::put('/types/{Type:slug}', [TypeController::class, 'update'])->name('types.update');
    Route::delete('/types/{Type:slug}', [TypeController::class, 'destroy'])->name('types.destroy');

    Route::resource('tools', ToolController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('helps', HelpController::class);
    Route::resource('requests', RequestController::class);

    Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');
    Route::get('/artists/{artist:slug}', [ArtistController::class, 'show'])->name('artists.show');
    Route::get('/artists/create', [ArtistController::class, 'create'])->name('artists.create');

    Route::get('/artists/{artist:slug}/edit', [ArtistController::class, 'edit'])->name('artists.edit');
    Route::delete('/artists/{artist:slug}/destroy', [ArtistController::class, 'destroy'])->name('artists.destroy');


    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/artists/{artist:slug}/products', [ArtistController::class, 'getArtistProducts'])->name('artists.destroy');


});
