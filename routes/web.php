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
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\OrderController;
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
    Route::resource('tools', ToolController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('helps', HelpController::class);
    Route::resource('requests', RequestController::class);
    Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug', ]);
    Route::resource('artists', ArtistController::class)->parameters(['artists' => 'artist:slug', ]);
    Route::resource('products', ProductController::class)->parameters(['products' => 'product:slug', ]);
    Route::resource('orders', OrderController::class)->parameters(['orders' => 'order:slug', ]);

    Route::get('/images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');
});
