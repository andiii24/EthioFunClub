<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use PDF;

// use PDF;

class PDFController extends Controller
{
    public function exportToPDF()
    {
        $users = User::where('role', 'customer')->get();

        $pdf = PDF::loadView('accounts.admin.users.pdf', compact('users'));

        return $pdf->download('users.pdf');
    }
}
