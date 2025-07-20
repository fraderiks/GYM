<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;

// 🏠 Public homepage routes
Route::get('/', [HomepageController::class, 'index'])->name('homepage.index');
Route::get('/program/{id}', [HomepageController::class, 'program'])->name('homepage.program');

// 🔐 Authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'registerForm')->name('register');      
    Route::post('/register', 'register')->name('register.submit'); 
});

// 🔒 Admin-only routes (requires authentication)
Route::middleware(['auth', 'admin'])->group(function () {
    // Semua rute di dalam grup ini hanya bisa diakses oleh user yang sudah login DAN memiliki role 'admin'
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/edit-programs', [AdminController::class, 'editPrograms'])->name('admin.edit_programs');
    
});

// 🛠️ Admin main route group
function adminRoutes(): RouteRegistrar
{
    return Route::controller(AdminController::class)
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            categoryAdminRoutes(); // Register all category-related admin routes
        });
}

function categoryAdminRoutes(): RouteRegistrar
{
    return Route::controller(CategoryController::class)
        ->prefix('category')
        ->name('category.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            // Add this line for the show route
            Route::get('/{id}', 'show')->name('show'); // <-- Add this line
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
}