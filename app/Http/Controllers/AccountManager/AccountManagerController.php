<?php

namespace App\Http\Controllers\AccountManager;

use App\Http\Controllers\Controller;

class AccountManagerController extends Controller
{
    public function index()
    {
        return view('accounts.admin.index');
    }
}
