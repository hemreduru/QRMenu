<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Menu\CategoryManagementController;
use App\Http\Controllers\Menu\ProductManagementController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QRMenuController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', [QRMenuController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/lang/{lang}', function ($lang) {
        if (in_array($lang, ['en', 'tr'])) {
            Session::put('locale', $lang);
            App::setLocale($lang);
        }
        return redirect()->back();
    })->name('change.language');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [DashboardController::class, 'index']);

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('table', TableController::class)->names('table');
        Route::delete('/table/{table}/clear', [TableController::class, 'clearOrders'])->name('table.clear');


        Route::resource('order', OrderController::class)->only(['update', 'destroy']);


        Route::name('user-management.')->group(function () {
            Route::resource('/user-management/users', UserManagementController::class);
            Route::resource('/user-management/roles', RoleManagementController::class);
            Route::resource('/user-management/permissions', PermissionManagementController::class);
        });

        Route::name('menu-management.')->group(function () {
            Route::resource('/menu-management/categories', CategoryManagementController::class)->name(
                '*',
                'categories'
            );
            Route::get('/menu-management/categories/data', [CategoryManagementController::class, 'show'])->name(
                'categories.data'
            );
            Route::resource('/menu-management/products', ProductManagementController::class)->name('*', 'products');
            Route::get('/menu-management/products/data', [ProductManagementController::class, 'show'])->name(
                'products.data'
            );
        });
    });

    Route::get('/error', function () {
        abort(500);
    });

    Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

    require __DIR__ . '/auth.php';
});

