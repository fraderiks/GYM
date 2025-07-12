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
    Route::get('/register', 'registerForm')->name('register');           // Show registration form
    Route::post('/register', 'register')->name('register.submit');       // Process registration
});

// 🔒 Admin-only routes (requires authentication)
Route::middleware('auth')->group(function () {
    adminRoutes(); // Register all admin routes

    // ⭐ Added a basic 'home' route for redirection after login
    Route::get('/home', function () {
        return view('dashboard'); // Assuming you have a 'dashboard.blade.php' view
    })->name('home');
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

// 📂 Category management under /admin/category
function categoryAdminRoutes(): RouteRegistrar
{
    return Route::controller(CategoryController::class)
        ->prefix('category')
        ->name('category.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
}
