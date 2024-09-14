<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Users\PermissionsController;
use App\Http\Controllers\Users\RolesController;
use App\Http\Controllers\Users\UsersController;

use App\Http\Controllers\Products\ProductsController;

Route::get('/', function () {
    return redirect('/login');
});
Auth::routes();
Route::middleware('auth')->group(function () {
// PRODUCTS
Route::prefix('admin/products')->name('products.')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('index');
    Route::post('/store', [ProductsController::class, 'store'])->name('store');
    Route::post('/add', [ProductsController::class, 'add'])->name('add');
    Route::post('/remove', [ProductsController::class, 'remove'])->name('remove');
    Route::get('/edit/{id?}', [ProductsController::class, 'edit'])->name('edit');
    Route::get('/delete/{id?}', [ProductsController::class, 'delete'])->name('delete');
    Route::get('/{id?}', [ProductsController::class, 'product'])->name('product');
});

// USERS
Route::prefix('admin/users')->name('users.')->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('index');
    Route::post('/users', [UsersController::class, 'store'])->name('store');
    Route::get('/users/edit/{id?}', [UsersController::class, 'edit'])->name('edit');
    Route::get('/users/delete/{id?}', [UsersController::class, 'delete'])->name('delete');
    Route::get('/users/destroy/{id?}', [UsersController::class, 'destroy'])->name('destroy');

    // ROLES
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RolesController::class, 'index'])->name('index');
        Route::post('/', [RolesController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [RolesController::class, 'edit'])->name('edit');
        Route::get('/destroy/{id?}', [RolesController::class, 'destroy'])->name('destroy');
        Route::get('/permissions/{id?}', [RolesController::class, 'index_roles_permission'])->name('permissions');
        Route::get('/permissions/store/{id}', [RolesController::class, 'roles_permission_store'])->name('permissions.store');
    });

    // PERMISSIONS
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [PermissionsController::class, 'index'])->name('index');
        Route::post('/', [PermissionsController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [PermissionsController::class, 'edit'])->name('edit');
        Route::get('/destroy/{id?}', [PermissionsController::class, 'destroy'])->name('destroy');
    });
});




    
});
