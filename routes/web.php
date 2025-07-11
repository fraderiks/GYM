<?php
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController; // Pastikan ini mengacu pada AuthController Anda
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
use App\Http\Controllers\Admin\CategoryController;


Route::get('/', [HomepageController::class, 'index'])->name('homepage.index');
Route::get('/program/{id}', [HomepageController::class, 'program'])->name('homepage.program');

Route::controller(AuthController::class)
    ->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate')->name('authenticate');
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/register', 'registerForm')->name('register'); // Rute untuk menampilkan form registrasi
        Route::post('/register', 'register')->name('register.submit'); // Rute untuk memproses data registrasi
    });

Route::middleware('auth')->group(
    function () {
        adminRoutes();
    }
);

function adminRoutes(): RouteRegistrar
{
    return Route::controller(AdminController::class)
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            categoryAdminRoutes();
        });
}

function categoryAdminRoutes(): RouteRegistrar{
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