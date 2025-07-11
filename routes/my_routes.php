<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AdminController;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;

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
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{id}', 'show')->name('show');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
        });
}
