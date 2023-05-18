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

        $user = new User;
        if ($request->password != $request->confirm_password) {
            return redirect()->back()->withErrors(['confirm_password' => 'Password confirmation does not match.'])->withInput();
        }
        $user->name = $request->name;
        $user->upid = auth()->user()->id;
        $user->phone = $request->phone;
        $user->role = 'customer';
        $user->password = Hash::make($request->password);
        $user->save();

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
            'serial_no' => 'required|string',
        ]);

        $sales = new Sale;
        $product = Product::where('user_id', auth()->user()->upid)->first();
        $sales->serial_no = $request->serial_no;
        $sales->product_id = $product->id;
        $sales->user_id = auth()->user()->id;
        $sales->save();
        return redirect()->route('customer-manager')
            ->with('success', 'Sales serial attached.');
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

}
