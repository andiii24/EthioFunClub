<?php

use App\Http\Controllers\AccountManager\AccountManagerController;
use App\Http\Controllers\AccountManager\UserController;
use App\Http\Controllers\SalesPersonController;
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
Route::get('/', [AccountManagerController::class, 'slash']);
Route::middleware(['auth', 'RoleMiddleware:admin'])->group(function () {

    Route::get('account-manager', [AccountManagerController::class, 'index'])->name('accounts.admin.index');
    Route::get('create-user', [UserController::class, 'create'])->name('admin.user.create');
    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::get('all-sales', [UserController::class, 'sales'])->name('admin.users.sales');
    Route::post('register-sales', [UserController::class, 'store']);
    Route::post('update-status', [UserCrontroller::class, 'activate']);
    Route::get('reports', [AccountManagerController::class, 'reports'])->name('admin.reports');
    Route::get('admin-message', [AccountManagerController::class, 'message'])->name('admin-message');
    Route::get('send-message', [AccountManagerController::class, 'send']);
    Route::post('message-send', [AccountManagerController::class, 'sent']);
});
Route::middleware(['auth', 'RoleMiddleware:sales'])->group(function () {

    Route::get('sales-manager', [SalesPersonController::class, 'index'])->name('accounts.sales.index');
    // Route::get('create-customer', [SalesPersonController::class, 'create']);
    // Route::get('customers', [SalesPersonController::class, 'index']);
    // Route::get('all-sales', [SalesPersonController::class, 'sales']);
    // Route::post('register-sales', [SalesPersonController::class, 'store']);
    // Route::post('update-status', [SalesPersonController::class, 'activate']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
