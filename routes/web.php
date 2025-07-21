<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProgramController;

// Public routes
Route::get('/', [HomepageController::class, 'index'])->name('homepage.index');
Route::get('/program/{id}', [HomepageController::class, 'program'])->name('homepage.program');

// Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'registerForm')->name('register');
    Route::post('/register', 'register')->name('register.submit');
});

// Admin routes group with middleware, prefix and naming
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin dashboard & other admin routes
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/edit-programs', [AdminController::class, 'editPrograms'])->name('edit_programs');
    Route::get('/programs/recommend', [AdminController::class, 'recommendPrograms'])->name('programs.recommend');

    // User Management routes with modal CRUD
    Route::prefix('users')->name('users.')->controller(MemberController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{user}', 'show')->name('show');
        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::put('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');
    });

    // Programs Management routes with modal CRUD (includes categories and programs)
    Route::prefix('programs')->name('programs.')->controller(ProgramController::class)->group(function () {
        Route::get('/', 'index')->name('index');

        // Category CRUD - Fixed route parameters
        Route::post('/categories', 'storeCategory')->name('categories.store');
        Route::get('/categories/{id}', 'showCategory')->name('categories.show');
        Route::put('/categories/{id}', 'updateCategory')->name('categories.update');
        Route::delete('/categories/{id}', 'destroyCategory')->name('categories.destroy');

        // Program CRUD - Fixed route parameters
        Route::post('/', 'storeProgram')->name('store');
        Route::get('/{id}', 'showProgram')->name('show');
        Route::put('/{id}', 'updateProgram')->name('update');
        Route::delete('/{id}', 'destroyProgram')->name('destroy');
    });

    // Category routes nested inside admin group
    Route::prefix('category')->name('category.')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
});