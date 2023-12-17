<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ↓↓↓ Customized routes

    Route::middleware(['permission:user_management_access'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('user.index');

        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::get('/users/show/{user}', [UserController::class, 'show'])->name('user.show');
        Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
        Route::patch('/users/update/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');

        Route::get('/users/model', [UserController::class, 'downloadModel'])->name('user.import.model');
        Route::post('/users/import', [UserController::class, 'import'])->name('user.import');
    });

    Route::middleware(['permission:role_management_access'])->group(function () {
        Route::get('/roles', [RoleController::class, 'index'])->name('role.index');

        Route::get('/roles/create', [RoleController::class, 'create'])->name('role.create');
        Route::get('/roles/edit/{role}', [RoleController::class, 'edit'])->name('role.edit');
        Route::get('/roles/show/{role}', [RoleController::class, 'show'])->name('role.show');
        Route::post('/roles/store', [RoleController::class, 'store'])->name('role.store');
        Route::patch('/roles/update/{role}', [RoleController::class, 'user'])->name('role.update');
        Route::delete('/roles/delete/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
    });

    Route::middleware(['permission:permission_management_access'])->group(function () {
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permission.index');
        
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::get('/permissions/edit/{permission}', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::get('/permissions/show/{permission}', [PermissionController::class, 'show'])->name('permission.show');
        Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permission.store');
        Route::patch('/permissions/update/{permission}', [PermissionController::class, 'permission'])->name('permission.update');
        Route::delete('/permissions/delete/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');
    });
});

require __DIR__.'/auth.php';
