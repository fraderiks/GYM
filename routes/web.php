<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;


Route::get('/', [HomepageController::class, 'index'])->name('homepage.index');
Route::get('/program/{id}', [HomepageController::class, 'program'])->name('homepage.program');


Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'registerForm')->name('register');
    Route::post('/register', 'register')->name('register.submit');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/edit-programs', [AdminController::class, 'editPrograms'])->name('admin.edit_programs');
    
    Route::get('/admin/programs/recommend', [AdminController::class, 'recommendPrograms'])->name('admin.programs.recommend');
    Route::get('/admin/members', [AdminController::class, 'manageMembers'])->name('admin.members.manage');
});


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

function categoryAdminRoutes(): RouteRegistrar
{
    return Route::controller(CategoryController::class)
        ->prefix('category')
        ->name('category.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{id}', 'show')->name('show');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
}


adminRoutes();
