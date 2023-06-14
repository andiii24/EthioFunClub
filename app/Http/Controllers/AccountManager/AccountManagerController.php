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

                $requestCount = User::where('password_reset', 1)->count();
                $users = User::all()->count();
                $today = Carbon::today();
                // Count sales made by the user today
                $userSalesCountToday = Sale::whereDate('created_at', $today)
                    ->count();
                $newUsers = User::whereDate('created_at', $today)->count();
                $sales = Sale::all()->count();
                return view('accounts.admin.index', compact('users', 'userSalesCountToday', 'newUsers', 'sales', 'requestCount'));
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
                $payment = Payment::where('user_id', auth()->user()->id)->first();
                // dd($payment);
                $sales = Sale::where('user_id', auth()->user()->id)->count();
                $todaySales = Sale::where('user_id', auth()->user()->id)
                    ->whereDate('created_at', Carbon::today())
                    ->count();
                return view('accounts.customer.index', compact('payment', 'sales', 'todaySales'));
            }

        } else {
            return view('auth.login');
        }
    }
    public function index()
    {
        $users = User::all()->count();
        $requestCount = User::where('password_reset', 1)->count();
        $today = Carbon::today();

        // Count sales made by the user today
        $userSalesCountToday = Sale::whereDate('created_at', $today)
            ->count();
        $newUsers = User::whereDate('created_at', $today)->count();
        $sales = Sale::all()->count();
        return view('accounts.admin.index', compact('users', 'userSalesCountToday', 'newUsers', 'sales', 'requestCount'));
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
    public function send_composed()
    {
        // dd($users);
        return view('accounts.admin.messages.compose');
    }
    public function sent(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'subject' => 'required|max:255',
            'subject_am' => 'required|max:255',
            'message' => 'required|string',
            'message_am' => 'required|string',
        ]);
        // dd($request);
        $message = new Message;
        $message->user_id = $request->user_id;
        $message->subject = $request->subject;
        $message->subject_am = $request->subject_am;
        $message->message_body = $request->message;
        $message->message_body_am = $request->message_am;
        $message->is_read = 0;
        $message->save();
        return redirect()->route('admin-message')
            ->with('success', 'Message sent successfully.');
    }
    public function sent_compose(Request $request)
    {
        $request->validate([
            'send_to' => 'required',
            'subject' => 'required|max:255',
            'subject_am' => 'required|max:255',
            'message' => 'required|string',
            'message_am' => 'required|string',
        ]);
        // dd($request);
        $all = User::all();
        $sales = User::where('role', 'sales')->get();
        $customer = User::where('role', 'customer')->get();
        $level0 = User::where('level', '0')->get();
        $level1 = User::where('level', '1')->get();
        $level2 = User::where('level', '2')->get();
        $level3 = User::where('level', '3')->get();
        $level4 = User::where('level', '4')->get();
        $level5 = User::where('level', '5')->get();
        if ($request->send_to == "all") {
            foreach ($all as $item) {
                # code...
                $message = new Message;
                $message->user_id = $item->id;
                $message->subject = $request->subject;
                $message->subject_am = $request->subject_am;
                $message->message_body = $request->message;
                $message->message_body_am = $request->message_am;
                $message->is_read = 0;
                $message->save();
            }
        }
        if ($request->send_to == "sales") {
            foreach ($sales as $item) {
                # code...
                $message = new Message;
                $message->user_id = $item->id;
                $message->subject = $request->subject;
                $message->subject_am = $request->subject_am;
                $message->message_body = $request->message;
                $message->message_body_am = $request->message_am;
                $message->is_read = 0;
                $message->save();
            }
        }
        if ($request->send_to == "customer") {
            foreach ($customer as $item) {
                # code...
                $message = new Message;
                $message->user_id = $item->id;
                $message->subject = $request->subject;
                $message->subject_am = $request->subject_am;
                $message->message_body = $request->message;
                $message->message_body_am = $request->message_am;
                $message->is_read = 0;
                $message->save();
            }
        }
        if ($request->send_to == "level0") {
            foreach ($level0 as $item) {
                # code...
                $message = new Message;
                $message->user_id = $item->id;
                $message->subject = $request->subject;
                $message->subject_am = $request->subject_am;
                $message->message_body = $request->message;
                $message->message_body_am = $request->message_am;
                $message->is_read = 0;
                $message->save();
            }
        }
        if ($request->send_to == "level1") {
            foreach ($level1 as $item) {
                # code...
                $message = new Message;
                $message->user_id = $item->id;
                $message->subject = $request->subject;
                $message->subject_am = $request->subject_am;
                $message->message_body = $request->message;
                $message->message_body_am = $request->message_am;
                $message->is_read = 0;
                $message->save();
            }
        }
        if ($request->send_to == "level2") {
            foreach ($level2 as $item) {
                # code...
                $message = new Message;
                $message->user_id = $item->id;
                $message->subject = $request->subject;
                $message->subject_am = $request->subject_am;
                $message->message_body = $request->message;
                $message->message_body_am = $request->message_am;
                $message->is_read = 0;
                $message->save();
            }
        }
        if ($request->send_to == "level3") {
            foreach ($level3 as $item) {
                # code...
                $message = new Message;
                $message->user_id = $item->id;
                $message->subject = $request->subject;
                $message->subject_am = $request->subject_am;
                $message->message_body = $request->message;
                $message->message_body_am = $request->message_am;
                $message->is_read = 0;
                $message->save();
            }
        }
        if ($request->send_to == "level4") {
            foreach ($level4 as $item) {
                # code...
                $message = new Message;
                $message->user_id = $item->id;
                $message->subject = $request->subject;
                $message->subject_am = $request->subject_am;
                $message->message_body = $request->message;
                $message->message_body_am = $request->message_am;
                $message->is_read = 0;
                $message->save();
            }
        }
        if ($request->send_to == "level5") {
            foreach ($level5 as $item) {
                # code..
                $message = new Message;
                $message->user_id = $item->id;
                $message->subject = $request->subject;
                $message->subject_am = $request->subject_am;
                $message->message_body = $request->message;
                $message->message_body_am = $request->message_am;
                $message->is_read = 0;
                $message->save();
            }
        }
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
            'password' => 'nullable|string|min:8|',
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

        return redirect()->route('accounts.admin.index')
            ->with('success', 'Profile Updated successfully.');
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
    public function sales_report()
    {
        $today = Carbon::today();
        // Count sales made by the user today
        $SalesCountToday = Sale::whereDate('created_at', $today)
            ->count();
        $sales = Sale::all()->count();
        $sale = Sale::all();
        $title = "Sales Report";
        return view('accounts.admin.reports.sales', compact('sales', 'SalesCountToday', 'sale', 'title'));
    }
    public function filter(Request $request)
    {
        $filter = $request->input('filter');
        $today = Carbon::today();

        if ($filter == 2) {
            // Filter for today's sales
            $title = "Today's Sales Report";
            $sale = Sale::whereDate('created_at', $today)->get();
        } elseif ($filter == 3) {
            // Filter for this week's sales
            $title = "This Week's Sales Report";
            $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
            $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY)->endOfDay();
            $sale = Sale::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
        } elseif ($filter == 4) {
            // Filter for this month's sales
            $title = "This Month's Sales Report";
            $startOfMonth = $today->copy()->startOfMonth();
            $endOfMonth = $today->copy()->endOfMonth()->endOfDay();
            $sale = Sale::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();
        } else {
            // Default case: show all sales
            $title = "Sales Report";
            $sale = Sale::all();
        }
        $today = Carbon::today();
        // Count sales made by the user today
        $SalesCountToday = Sale::whereDate('created_at', $today)
            ->count();
        $sales = Sale::all()->count();
        return view('accounts.admin.reports.sales', compact('sales', 'SalesCountToday', 'sale', 'title'));

    }
    public function level_based()
    {
        $users = User::where('level_payment', 1)->get();
        return view('accounts.admin.payments.level', compact('users'));
    }
    public function forgot(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric',
            'name' => 'required|max:255',
        ]);
        $userName = User::where('name', $request->name)->first();
        $userPhone = User::where('phone', $request->phone)->first();

        // dd($userPhone);
        if ($userName && $userPhone) {
            // dd($userName);
            $userName->password_reset = 1;
            $userName->save();
            return redirect()->route('login')
                ->with('success', 'Password Reset Requested.');}
    }
    public function password_request()
    {
        $users = User::where('password_reset', 1)->get();
        return view('accounts.admin.password.index', compact('users'));
    }
    public function reset_password($id)
    {
        $user = User::where('id', $id)->first();
        return view('accounts.admin.password.show', compact('user'));
    }
    public function update_password(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ]);

        $user = User::findOrFail($id);

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->password_reset = 0;
        $user->save();

        return redirect()->route('accounts.admin.index')
            ->with('success', 'Password Updated successfully.');
    }
    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
