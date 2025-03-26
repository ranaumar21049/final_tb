<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\PlatformAdminMiddleware;
use App\Http\Middleware\BrandAdminMiddleware;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

// Platform Admin Routes
Route::prefix('platform-admin')->name('platform-admin.')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    
    
    Route::middleware([PlatformAdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/brands', [AdminController::class, 'index'])->name('brands');
        Route::post('/brands/{id}/approve',[AdminController::class, 'approve'])->name('brands.approve');
        Route::post('/brands/{id}/reject', [AdminController::class, 'reject'])->name('brands.reject');
        Route::resource('/categories', CategoryController::class);
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
    });


// Brand Admin Routes
Route::prefix('brand-admin')->name('brand-admin.')->group(function () {
    Route::get('login', [BrandController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    
    
    Route::middleware([BrandAdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [BrandController::class, 'index'])->name('admin.dashboard');
        Route::resource('products', ProductController::class);
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
       
    });
});





// Brand Registration (Public)
Route::get('/brand/register', [BrandController::class, 'showRegistrationForm'])->name('brand.register');
Route::post('/brand/register', [BrandController::class, 'store'])->name('brand.store');





