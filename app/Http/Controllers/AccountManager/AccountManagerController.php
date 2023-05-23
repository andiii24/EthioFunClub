<?php

namespace App\Http\Controllers\AccountManager;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AccountManagerController extends Controller
{
    public function slash()
    {
        if (auth()->check()) {
            if (auth()->user()->role == 'admin') {
                $users = User::all()->count();
                $today = Carbon::today();
                // Count sales made by the user today
                $userSalesCountToday = Sale::whereDate('created_at', $today)
                    ->count();
                $newUsers = User::whereDate('created_at', $today)->count();
                $sales = Sale::all()->count();
                return view('accounts.admin.index', compact('users', 'userSalesCountToday', 'newUsers', 'sales'));
            } elseif (auth()->user()->role == 'sales') {
                $payment = Payment::where('user_id', auth()->user()->id)->first();
                $userId = auth()->user()->id;

                // Count sales made by the user
                $userSalesCount = Sale::where('user_id', $userId)->count();

                // Get the IDs of the user's children
                $userChildrenIds = User::where('upid', $userId)->pluck('id');

                // Count sales made by the user's children
                $childrenSalesCount = Sale::whereIn('user_id', $userChildrenIds)->count();

                // Total sales count (user and their children)
                $totalSalesCount = $userSalesCount + $childrenSalesCount;

                $today = Carbon::today();

// Count sales made by the user today
                $userSalesCountToday = Sale::where('user_id', $userId)
                    ->whereDate('created_at', $today)
                    ->count();

// Count sales made by the user's children today
                $childrenSalesCountToday = Sale::whereIn('user_id', $userChildrenIds)
                    ->whereDate('created_at', $today)
                    ->count();

// Total sales count today (user and their children)
                $totalSalesCountToday = $userSalesCountToday + $childrenSalesCountToday;

                return view('accounts.sales.index', compact('payment', 'totalSalesCount', 'totalSalesCountToday'));
            } elseif (auth()->user()->role == 'customer') {
                return view('accounts.customer.index');
            }

        } else {
            return view('auth.login');
        }
    }
    public function index()
    {
        $users = User::all()->count();
        $today = Carbon::today();

        // Count sales made by the user today
        $userSalesCountToday = Sale::whereDate('created_at', $today)
            ->count();
        $newUsers = User::whereDate('created_at', $today)->count();
        $sales = Sale::all()->count();
        return view('accounts.admin.index', compact('users', 'userSalesCountToday', 'newUsers', 'sales'));
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
    public function generate()
    {
        return view('accounts.admin.serial.create');
    }
    public function generated()
    {
        $products = Product::all();
        return view('accounts.admin.serial.index', compact('products'));
    }
    public function serial_store(Request $request)
    {
        $request->validate([
            'count' => 'required|numeric',
        ]);

        $count = $request->input('count');

        for ($i = 1; $i <= $count; $i++) {
            $serialNumber = date('Ymd') . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4);
            $serial = new Product();
            $serial->serial_num = $serialNumber;
            $serial->save();
        }
        $products = Product::orderBy('created_at', 'desc')->take($count)->get();
        return view('accounts.admin.serial.instance', compact('products'))->with('success', 'Serial numbers saved successfully.');
    }
}
