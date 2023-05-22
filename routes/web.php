<?php

use App\Http\Controllers\AccountManager\AccountManagerController;
use App\Http\Controllers\AccountManager\UserController;
use App\Http\Controllers\customer\CustomerController;
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
    Route::get('admin-profile', [AccountManagerController::class, 'edit_profile'])->name('admin-profile');
    Route::put('update-profile-admin/{id}', [AccountManagerController::class, 'update_profile']);
    Route::get('create-user', [UserController::class, 'create'])->name('admin.user.create');
    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::get('all-sales', [UserController::class, 'sales'])->name('admin.users.sales');
    Route::get('edit-sales/{id}', [UserController::class, 'edit']);
    Route::post('register-sales', [UserController::class, 'store']);
    Route::put('update-sales/{id}', [UserController::class, 'update']);
    Route::post('update-status', [UserController::class, 'activate']);
    Route::get('reports', [AccountManagerController::class, 'reports'])->name('admin.reports');
    Route::get('admin-message', [AccountManagerController::class, 'message'])->name('admin-message');
    Route::get('send-message', [AccountManagerController::class, 'send']);
    Route::post('message-send', [AccountManagerController::class, 'sent']);
    Route::get('account-manager-payments', [AccountManagerController::class, 'payments']);
    Route::get('show-payment-slip/{id}', [AccountManagerController::class, 'show_payment']);
    Route::post('generate-serial', [AccountManagerController::class, 'serial_store']);
    Route::get('generate', [AccountManagerController::class, 'generate'])->name('generate');
    Route::get('generated', [AccountManagerController::class, 'generated'])->name('generated');
    Route::get('recently-generated', [AccountManagerController::class, 'generate'])->name('recently-generated');
});

Route::middleware(['auth', 'RoleMiddleware:sales'])->group(function () {
    Route::get('sales-manager', [SalesPersonController::class, 'index'])->name('sales-manager');
    Route::get('sales-profile', [AccountManagerController::class, 'edit_profile'])->name('admin-profile');
    Route::put('update-profile-sales/{id}', [AccountManagerController::class, 'update_profile']);
    Route::get('sales-create-customer', [SalesPersonController::class, 'create']);
    Route::get('sales-customer', [SalesPersonController::class, 'customers'])->name('sales-customer');
    Route::get('attach-payment-sales', [SalesPersonController::class, 'attach']);
    Route::get('sales-view-message', [SalesPersonController::class, 'messages'])->name('sales-view-message');
    Route::get('read-message/{id}', [SalesPersonController::class, 'read']);
    // Route::get('sales-add-product', [SalesPersonController::class, 'add_product'])->name('sales-add-product');
    // Route::get('sales-product', [SalesPersonController::class, 'products'])->name('sales-product');
    Route::get('genealogy', [SalesPersonController::class, 'genealogy']);
    Route::post('register-customer', [SalesPersonController::class, 'store']);
    // Route::put('update-product/{id}', [SalesPersonController::class, 'product_update']);
    // Route::post('register-product', [SalesPersonController::class, 'store_product']);
    Route::post('update-message-status', [SalesPersonController::class, 'readed']);
    Route::post('submit-sales-slip', [SalesPersonController::class, 'submit']);
});
Route::middleware(['auth', 'RoleMiddleware:customer'])->group(function () {
    Route::get('customer-manager', [CustomerController::class, 'index'])->name('customer-manager');
    Route::get('customer-profile', [AccountManagerController::class, 'edit_profile'])->name('admin-profile');
    Route::put('update-profile-customer/{id}', [AccountManagerController::class, 'update_profile']);
    Route::get('customer-create-customer', [CustomerController::class, 'create']);
    Route::get('customer-customer', [CustomerController::class, 'customers'])->name('customer-customer');
    Route::get('attach-payment-customer', [CustomerController::class, 'attach']);
    Route::get('customer-view-message', [CustomerController::class, 'messages'])->name('sales-view-message');
    Route::get('read-message/{id}', [CustomerController::class, 'read']);
    Route::post('customer-register-customer', [CustomerController::class, 'store']);
    Route::post('update-message-status', [CustomerController::class, 'readed']);
    Route::post('submit-customer-slip', [CustomerController::class, 'submit']);
    Route::post('customer-register-serial', [CustomerController::class, 'serial']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
