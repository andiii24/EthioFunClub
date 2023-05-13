<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SalesPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::where('user_id', auth()->user()->id)->first();
        $payment = Payment::where('user_id', auth()->user()->id)->first();
        return view('accounts.sales.index', compact('payment', 'product'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.sales.users.create');
    }
    public function customers()
    {
        $users = User::where('upid', auth()->user()->id)
            ->where('role', 'customer')->get();
        return view('accounts.sales.users.index', compact('users'));
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

        return redirect()->route('sales-customer')
            ->with('success', 'Property added successfully.');
    }

    public function attach()
    {
        return view('accounts.sales.payment.membership');
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
        return redirect()->route('sales-manager')
            ->with('success', 'Payment slip attached successfully.');
    }
    public function messages()
    {
        $messages = Message::where('user_id', auth()->user()->id)->get();
        return view('accounts.sales.messages.index', compact('messages'));
    }
    public function read($id)
    {
        $messages = Message::find($id);
        return view('accounts.sales.messages.show', compact('messages'));
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
    public function products()
    {
        $product = Product::where('user_id', auth()->user()->id)->first();
        return view('accounts.sales.products.index', compact('product'));
    }
    public function add_product()
    {
        return view('accounts.sales.products.create');
    }
    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'amount' => 'required|numeric',
        ]);
        if (!Product::where('user_id', auth()->user()->id)->first()) {
            $product = new Product;
            $serial = substr($request->name, 0, 4); // Get the first four characters from the product name
            $serial .= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2); // Generate two random characters
            $serial_exists = true;
            while ($serial_exists) {
                $existing_product = Product::where('serial_num', $serial)->first();
                if ($existing_product) {
                    // If the serial number already exists, generate a new one
                    $serial = substr($request->name, 0, 4); // Get the first four characters from the product name
                    $serial .= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2); // Generate two random characters
                } else {
                    // If the serial number is unique, set the flag to exit the loop
                    $serial_exists = false;
                }
            }
            // dd($serial);
            $product->name = $request->name;
            $product->serial_num = $serial;
            $product->price = $request->amount;
            $product->save();
            return redirect()->route('sales-product')
                ->with('success', 'Product slip attached successfully.');
        }
        return redirect()->route('sales-product')
            ->with('success', 'you cannot register a new product');
    }
    public function edit_product($id)
    {
        $product = Product::find($id);
        return view('accounts.sales.products.edit', compact('product'));
    }
    public function product_update(Request $request, $id)
    {
        $product = Product::find($id);
        $request->validate([
            'name' => 'required|max:255',
            'amount' => 'required|numeric',
        ]);
        $product->name = $request->name;
        $product->price = $request->amount;
        $product->save();
        return redirect()->route('sales-product')
            ->with('success', 'Product Update');
    }
}
