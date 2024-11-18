<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Middleware\CheckUserType;
use App\Models\Category;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'checkType:admin, super-admin, user'])
    ->name('dashboard');

Route::get('/dashboard/categories/trash', [CategoryController::class, 'trash'])
    ->name('dashboard.categories.trash');
Route::put('/dashboard/categories/{category}/restore', [CategoryController::class, 'restore'])
    ->name('dashboard.categories.restore');
Route::delete('/dashboard/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])
    ->name('dashboard.categories.force-delete');

Route::resource('dashboard/categories', CategoryController::class)
    ->middleware(['auth', 'checkType:admin, super-admin, user'])
    ->names('dashboard.categories');

Route::resource('dashboard/products', ProductController::class)
    ->middleware(['auth', 'checkType:admin, super-admin, user'])
    ->names('dashboard.products');

Route::middleware(['auth', 'checkType:admin, super-admin, user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('dashboard.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('dashboard.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('dashboard.profile.destroy');
});
