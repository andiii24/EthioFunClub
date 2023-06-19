<?php

use App\Http\Controllers\AccountManager\AccountManagerController;
use App\Http\Controllers\AccountManager\UserController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\PDFController;
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
Auth::routes();
Route::post('password-forgot', [AccountManagerController::class, 'forgot']);

Route::get('/', [AccountManagerController::class, 'slash']);

Route::middleware(['auth', 'RoleMiddleware:admin'])->group(function () {
    Route::get('account-manager', [AccountManagerController::class, 'index'])->name('accounts.admin.index');
    Route::get('admin-profile', [AccountManagerController::class, 'edit_profile'])->name('admin-profile');
    Route::put('update-profile-admin/{id}', [AccountManagerController::class, 'update_profile']);
    Route::put('change-password-admin/{id}', [AccountManagerController::class, 'update_password']);
    Route::get('create-user', [UserController::class, 'create'])->name('admin.user.create');
    Route::get('inactive-users', [AccountManagerController::class, 'inactive']);
    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::get('all-sales', [UserController::class, 'sales'])->name('admin.users.sales');
    Route::get('edit-sales/{id}', [UserController::class, 'edit']);
    Route::post('register-sales', [UserController::class, 'store']);
    Route::put('update-sales/{id}', [UserController::class, 'update']);
    Route::post('update-status', [UserController::class, 'activate']);
    // Route::post('diactivate', [UserController::class, 'diactivate']);
    // Route::post('activation', [UserController::class, 'activation']);
    Route::post('level-payment-update', [UserController::class, 'level_update']);
    Route::get('sales-report', [AccountManagerController::class, 'sales_report'])->name('sales-report');
    Route::post('filtering-sales', [AccountManagerController::class, 'filter']);
    Route::post('filtering-customers', [AccountManagerController::class, 'filter_customer']);
    Route::post('filtering-user-sales', [AccountManagerController::class, 'filter_sales']);
    Route::post('filtering-inactive', [AccountManagerController::class, 'filter_inactive']);
    Route::get('admin-message', [AccountManagerController::class, 'message'])->name('admin-message');
    Route::get('send-message', [AccountManagerController::class, 'send']);
    Route::get('send-composed-message', [AccountManagerController::class, 'send_composed']);
    Route::post('message-send', [AccountManagerController::class, 'sent']);
    Route::post('message-composed-send', [AccountManagerController::class, 'sent_compose']);
    Route::get('account-manager-payments', [AccountManagerController::class, 'payments']);
    Route::get('account-manager-payments-history', [AccountManagerController::class, 'allPayments']);
    Route::get('level-based', [AccountManagerController::class, 'level_based']);
    Route::get('show-payment-slip/{id}', [AccountManagerController::class, 'show_payment']);
    Route::post('generate-serial', [AccountManagerController::class, 'serial_store']);
    Route::get('generate', [AccountManagerController::class, 'generate'])->name('generate');
    Route::get('generated', [AccountManagerController::class, 'generated'])->name('generated');
    Route::get('recently-generated', [AccountManagerController::class, 'generate'])->name('recently-generated');
    Route::get('password-request', [AccountManagerController::class, 'password_request']);
    Route::get('reset-password/{id}', [AccountManagerController::class, 'reset_password']);
    Route::delete('delete-user/{id}', [AccountManagerController::class, 'delete']);
    Route::post('change-user-status', [AccountManagerController::class, 'changeUserStatus']);
    Route::get('export-customers', [AccountManagerController::class, 'exportCustomers']);
    Route::get('export-sales', [AccountManagerController::class, 'exportSales']);
    Route::get('export-serial-numbers', [AccountManagerController::class, 'exportSerialNumbers']);
    Route::get('export-payments', [AccountManagerController::class, 'exportPayments']);

});

Route::middleware(['auth', 'RoleMiddleware:sales'])->group(function () {
    Route::get('sales-manager', [SalesPersonController::class, 'index'])->name('sales-manager');
    Route::get('sales-profile', [SalesPersonController::class, 'edit_profile'])->name('admin-profile');
    Route::put('update-profile-sales/{id}', [SalesPersonController::class, 'update_profile']);
    Route::get('sales-create-customer', [SalesPersonController::class, 'create']);
    Route::get('sales-customer', [SalesPersonController::class, 'customers'])->name('sales-customer');
    Route::get('attach-payment-sales', [SalesPersonController::class, 'attach']);
    Route::get('sales-view-message', [SalesPersonController::class, 'messages'])->name('sales-view-message');
    Route::get('sales-read-message/{id}', [SalesPersonController::class, 'read']);
    // Route::get('sales-add-product', [SalesPersonController::class, 'add_product'])->name('sales-add-product');
    // Route::get('sales-product', [SalesPersonController::class, 'products'])->name('sales-product');
    Route::post('register-customer', [SalesPersonController::class, 'store']);
    // Route::put('update-product/{id}', [SalesPersonController::class, 'product_update']);
    // Route::post('register-product', [SalesPersonController::class, 'store_product']);
    Route::post('sales-update-message-status', [SalesPersonController::class, 'readed']);
    Route::post('submit-sales-slip', [SalesPersonController::class, 'submit']);
    Route::post('sales-register-serial', [SalesPersonController::class, 'serial']);
    Route::get('genealogy', [SalesPersonController::class, 'genealogy']);
    Route::get('sales-child/{id}', [SalesPersonController::class, 'child']);
    Route::get('sales-sales', [SalesPersonController::class, 'sales_sales']);
    Route::post('request-level-payment', [SalesPersonController::class, 'request_level']);
    Route::get('sales-payment-history', [SalesPersonController::class, 'payment_history']);
    Route::get('sales-make-payment', [SalesPersonController::class, 'make_payment']);

});
Route::middleware(['auth', 'RoleMiddleware:customer'])->group(function () {
    Route::get('customer-manager', [CustomerController::class, 'index'])->name('customer-manager');
    Route::get('customer-profile', [CustomerController::class, 'edit_profile']);
    Route::put('update-profile-customer/{id}', [CustomerController::class, 'update_profile']);
    Route::get('customer-create-customer', [CustomerController::class, 'create']);
    Route::get('customer-customer', [CustomerController::class, 'customers'])->name('customer-customer');
    Route::get('attach-payment-customer', [CustomerController::class, 'attach']);
    Route::get('customer-view-message', [CustomerController::class, 'messages'])->name('sales-view-message');
    Route::get('read-message/{id}', [CustomerController::class, 'read']);
    Route::post('customer-register-customer', [CustomerController::class, 'store']);
    Route::post('update-message-status', [CustomerController::class, 'readed']);
    Route::post('submit-customer-slip', [CustomerController::class, 'submit']);
    Route::post('customer-register-serial', [CustomerController::class, 'serial']);
    Route::get('customer-genealogy', [CustomerController::class, 'genealogy']);
    Route::get('child/{id}', [CustomerController::class, 'child']);
    Route::get('contact-us', [CustomerController::class, 'contact']);
    Route::get('customer-sales', [CustomerController::class, 'customer_sales']);
    Route::post('customer-request-level-payment', [CustomerController::class, 'request_level']);
    Route::get('customer-payment-history', [CustomerController::class, 'payment_history']);
    Route::get('customer-make-payment', [CustomerController::class, 'make_payment']);

});
Route::get('/export-pdf', [PDFController::class, 'exportToPDF'])->name('export.pdf');

Route::get('/{lang}', [LangController::class, 'setLocale']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
