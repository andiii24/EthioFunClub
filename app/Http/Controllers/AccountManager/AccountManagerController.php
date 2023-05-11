<?php

namespace App\Http\Controllers\AccountManager;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class AccountManagerController extends Controller
{
    public function slash()
    {
        if (auth()->check()) {
            if (auth()->user()->role == 'admin') {
                return view('accounts.admin.index');
            } elseif (auth()->user()->role == 'sales') {
                $payment = Payment::where('user_id', auth()->user()->id)->first();
                return view('sales-manager', compact('payment'));
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
            'message' => 'required|string|max:255',
        ]);
        // dd($request);
        $message = new Message;
        $message->user_id = $request->user_id;
        $message->subject = $request->subject;
        $message->message_body = $request->message;
        $message->user_id = $request->user_id;
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
}
