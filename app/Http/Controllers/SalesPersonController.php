<?php

namespace App\Http\Controllers;

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

class SalesPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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

        // Get the authenticated user
        $parentUser = Auth::user();

        // Check if the authenticated user already has child IDs set
        if ($parentUser->left_child_id && $parentUser->middle_child_id && $parentUser->right_child_id) {
            return response()->json(['error' => 'Maximum number of child IDs reached'], 400);
        }

        // Determine the child ID to set based on the available slots (left, middle, right)
        $childId = 'null';
        if (!$parentUser->left_child_id) {
            $childId = 'left_child_id';
        } elseif (!$parentUser->middle_child_id) {
            $childId = 'middle_child_id';
        } elseif (!$parentUser->right_child_id) {
            $childId = 'right_child_id';
        }

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->upid = $parentUser->id;
        $user->role = 'customer';
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        // Update the parent user with the new child ID
        $parentUser->$childId = $user->id;
        $parentUser->save();
        $parentUser = Auth::user();
        // Check if the authenticated user has three children
        if (
            $parentUser->left_child_id &&
            $parentUser->middle_child_id &&
            $parentUser->right_child_id
            // $parentUser->leftChild &&
            // $parentUser->middleChild &&
            // $parentUser->rightChild &&
            // $parentUser->leftChild->level == 1 &&
            // $parentUser->middleChild->level == 1 &&
            // $parentUser->rightChild->level == 1
        ) {
            // Increment the level of the authenticated user
            $parentUser->level += $parentUser->minChildLevel();
            $parentUser->save();
            $parentUser->incrementParentLevel(); // Call the method to increment the level for the parent user and its ancestors
        }
        // Redirect or return the response as needed

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

    public function genealogy()
    {
        $user = auth()->user();
        $users = User::where('upid', $user->id)->get();
        return view('accounts.sales.genealogy.index', compact('users', 'user'));
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
        return view('accounts.sales.genealogy.index', compact('users', 'user'));
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
    public function serial(Request $request)
    {
        $request->validate([
            'serial_num' => 'required|string',
        ]);

        $sales = new Sale;
        if (Product::where('serial_num', $request->serial_num)->where('status', '0')->first()) {
            $prod = Product::where('serial_num', $request->serial_num)->
                where('status', '0')->first();
            $prod->status = 1;
            $prod->save();
            $sales->serial_num = $request->serial_num;
            $sales->product_id = $prod->id;
            $sales->user_id = auth()->user()->id;
            $sales->save();
            return redirect()->route('sales-manager')
                ->with('success', 'Sales attached');
        }
        return redirect()->route('sales-manager')
            ->with('error', 'Invalid Serial attached.');
    }
}
