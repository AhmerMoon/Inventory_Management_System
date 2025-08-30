<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with('customer')->get();
        return view('bills.index', compact('bills'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('bills.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        $bill = Bill::create([
            'customer_id' => $request->customer_id,
            'date' => $request->date, // Laravel will automatically cast this to a Carbon instance
            'total' => 0
        ]);

        $total = 0;
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $price = $product->price;
            $quantity = $item['quantity'];

            $bill->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price
            ]);

            $total += $price * $quantity;
            $product->decrement('quantity', $quantity);
        }

        $bill->update(['total' => $total]);
        return redirect()->route('bills.index')->with('success', 'Bill created successfully!');
    }

    public function show(Bill $bill)
    {
        $bill->load('customer', 'items.product');
        return view('bills.show', compact('bill'));
    }
}