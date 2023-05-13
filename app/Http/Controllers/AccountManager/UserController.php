<?php

namespace App\Http\Controllers\AccountManager;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
    public function edit($id)
    {
        $user = User::find($id);
        return view('accounts.admin.users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'confirm_password' => 'required|min:8|same:password',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('image')) {
            $path = 'assets/images/users/' . $user->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/users'), $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return redirect()->route('admin.users')
            ->with('success', 'Property added successfully.');}
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

        return redirect()->route('admin.users')
            ->with('success', 'Property added successfully.');
    }
    public function activate(Request $request)
    {
        $userId = $request->input('user_id');
        $paymentId = $request->input('payment_id');
        $payment = Payment::find($paymentId);
        $user = User::find($userId);
        if (!$user || !$payment) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->status = 1;
        $payment->status = 1;
        $payment->save();
        $user->save();
        return response()->json(['message' => 'User activated successfully'], 200);
    }
}
