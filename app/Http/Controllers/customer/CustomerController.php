<?php

namespace App\Http\Controllers\customer;

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

class CustomerController extends Controller
{
    public function index()
    {
        $payment = Payment::where('user_id', auth()->user()->id)->first();
        // dd($payment);
        $sales = Sale::where('user_id', auth()->user()->id)->count();
        $todaySales = Sale::where('user_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::today())
            ->count();
        return view('accounts.customer.index', compact('payment', 'sales', 'todaySales'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.customer.users.create');
    }
    public function customers()
    {
        $users = User::where('upid', auth()->user()->id)
            ->where('role', 'customer')->get();
        return view('accounts.customer.users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ]);

        if ($request->password != $request->confirm_password) {
            return redirect()->back()->withErrors(['confirm_password' => 'Password confirmation does not match.'])->withInput();
        }
        $parentUser = Auth::user();

        // Check if the authenticated user already has child IDs set
        if ($parentUser->left_child_id && $parentUser->middle_child_id && $parentUser->right_child_id) {
            return response()->json(['error' => 'Maximum number of child IDs reached'], 400);
        }

        // Determine the child ID to set based on the available slots (left, middle, right)
        $childId = null;
        if (!$parentUser->left_child_id) {
            $childId = 'left_child_id';
        } elseif (!$parentUser->middle_child_id) {
            $childId = 'middle_child_id';
        } elseif (!$parentUser->right_child_id) {
            $childId = 'right_child_id';
        }

        // Update the parent user with the new child ID

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'upid' => $parentUser->id,
            'role' => 'customer',
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            // Set the child IDs (left_child_id, middle_child_id, right_child_id) as needed based on your logic
        ]);

        $parentUser->$childId = $user->id;
        $parentUser->save();
        return redirect()->route('customer-customer')
            ->with('success', 'Property added successfully.');
    }

    public function attach()
    {
        return view('accounts.customer.payment.membership');
    }
    public function submit(Request $request)
    {
        // dd($request);
        $request->validate([
            'amount' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $payment = new Payment;

        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $image->move('assets/images/payment/', $filename);

        $payment->paymet_img = $filename;
        $payment->amount = $request->amount;
        $payment->user_id = auth()->user()->id;
        $payment->save();
        return redirect()->route('customer-manager')
            ->with('success', 'Payment slip attached successfully.');
    }
    public function messages()
    {
        $messages = Message::where('user_id', auth()->user()->id)->get();
        return view('accounts.customer.messages.index', compact('messages'));
    }
    public function read($id)
    {
        $messages = Message::find($id);
        return view('accounts.customer.messages.show', compact('messages'));
    }
    public function readed(Request $request)
    {
        $messageId = $request->input('msg_id');
        $message = Message::find($messageId);
        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }
        $message->is_read = 1;
        $message->save();
        return response()->json(['message' => 'Message readed successfully'], 200);
    }
    public function serial(Request $request)
    {
        $request->validate([
            'serial_num' => 'required|string',
        ]);

        $sales = new Sale;
        if (Product::where('serial_num', $request->serial_num)->exists()) {
            $prod = Product::where('serial_num', $request->serial_num)->
                where('status', '0')->first();
            $prod->status = 1;
            $prod->save();
            $sales->serial_num = $request->serial_num;
            $sales->product_id = $prod->id;
            $sales->user_id = auth()->user()->id;
            $sales->save();
            return redirect()->route('customer-manager')
                ->with('success', 'Sales serial attached.');
        }
        return redirect()->route('customer-manager')
            ->with('success', 'Invalid Serial attached.');

    }
    public function edit_profile()
    {
        $user = Auth::user();
        return view('accounts.customer.users.profile', compact('user'));
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

        return redirect()->route('customer-manager')
            ->with('success', 'Property added successfully.');
    }
    public function genealogy()
    {
        $user = auth()->user();
        $users = User::where('upid', $user->id)->get();
        return view('accounts.customer.genealogy.index', compact('users', 'user'));
    }
    public function child($id)
    {
        $user = User::where('id', $id)->first();

        if (!$user) {
            // Handle the case where the user does not exist
            // For example, redirect back with an error message
            return redirect()->back()->with('error', 'User not found.');
        }

        $users = User::where('upid', $user->id)->get();
        return view('accounts.customer.genealogy.index', compact('users', 'user'));
    }

}
