<?php

namespace App\Http\Controllers\AccountManager;

use App\Http\Controllers\Controller;
use auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('accounts.admin.users.index', compact('users'));
    }
    public function sales()
    {
        $users = User::where('role', 'sales')->get();
        return view('accounts.admin.users.index', compact('users'));
    }
    public function create()
    {
        return view('accounts.admin.users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($request);

        $user = new User;
        if ($request->password != $request->confirm_password) {
            return redirect()->back()->withErrors(['confirm_password' => 'Password confirmation does not match.'])->withInput();
        }
        // $path = 'assets/images/users/' . $user->image;
        // store the image file
        // if (File::exists($path)) {
        //     File::delete($path);
        // }
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $image->move('assets/images/users/', $filename);

        $user->image = $filename;
        $user->name = $request->name;
        $user->upid = auth()->user()->id;
        $user->phone = $request->phone;
        $user->role = 'sales';
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users')
            ->with('success', 'Property added successfully.');
    }
    public function activate(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->status = 1;
        $user->save();
        return response()->json(['message' => 'User activated successfully'], 200);
    }
}
