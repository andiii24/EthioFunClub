<?php

use App\Http\Controllers\AccountManager\AccountManagerController;
use App\Http\Controllers\AccountManager\UserController;
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
    return view('accounts.admin.index');
});

Route::get('account-manager', [AccountManagerController::class, 'index']);
Route::get('create-user', [UserController::class, 'create'])->name('admin.user.create');
Route::post('register-sales', [UserController::class, 'store']);
