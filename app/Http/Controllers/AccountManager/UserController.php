<?php

namespace App\Http\Controllers\AccountManager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('accounts.admin.users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required || max:255',
            'email' => 'required || email||max:255|| unique:users',
            'phone_number' => 'required||numeric||unique:users',
            'role' => 'required',
            'password' => 'required||min:8',
            'confirm-password' => 'required||min:8',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin/users')
            ->with('success', 'Property added successfully.');
    }
}
