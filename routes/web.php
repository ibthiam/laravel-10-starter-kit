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
    });

    Route::middleware(['permission:role_management_access'])->group(function () {
        Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    });

    Route::middleware(['permission:permission_management_access'])->group(function () {
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permission.index');
    });
});

require __DIR__.'/auth.php';
