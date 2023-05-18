<?php

namespace App\Http\Controllers\AccountManager;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AccountManagerController extends Controller
{
    public function slash()
    {
        if (auth()->check()) {
            if (auth()->user()->role == 'admin') {
                return view('accounts.admin.index');
            } elseif (auth()->user()->role == 'sales') {
                $payment = Payment::where('user_id', auth()->user()->id)->first();
                return view('accounts.sales.index', compact('payment'));
            } elseif (auth()->user()->role == 'customer') {
                return view('accounts.customer.index');
            }

        } else {
            return view('auth.login');
        }
    }
    public function index()
    {
        // dd(auth()->user()->role);
        // $user = auth()->user();
        return view('accounts.admin.index');
    }
    public function reports()
    {
        return view('accounts.admin.reports.index');
    }
    public function message()
    {
        $messages = Message::all();
        return view('accounts.admin.messages.index', compact('messages'));
    }
    public function send()
    {
        $users = User::where('role', 'customer')
            ->orWhere('role', 'sales')
            ->where('status', 1)
            ->get();
        // dd($users);
        return view('accounts.admin.messages.send', compact('users'));
    }
    public function sent(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'subject' => 'required|max:255',
            'message' => 'required|string',
        ]);
        // dd($request);
        $message = new Message;
        $message->user_id = $request->user_id;
        $message->subject = $request->subject;
        $message->message_body = $request->message;
        $message->is_read = 0;
        $message->save();
        return redirect()->route('admin-message')
            ->with('success', 'Message sent successfully.');
    }
    public function payments()
    {
        $payments = Payment::all();
        return view('accounts.admin.payments.index', compact('payments'));
    }
    public function show_payment($id)
    {
        $payments = Payment::find($id);
        return view('accounts.admin.payments.show', compact('payments'));
    }
    public function edit_profile()
    {
        $user = Auth::user();
        return view('accounts.admin.users.profile', compact('user'));
    }
    public function update_profile(Request $request, $id)
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

        return redirect()->route('admin-manager')
            ->with('success', 'Property added successfully.');
    }
}
