<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\TypeController;
use App\Http\Controllers\Dashboard\ToolController;

use App\Http\Controllers\Dashboard\BannerController;

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
});
