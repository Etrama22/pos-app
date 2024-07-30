<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user')->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $totalPrice = 0;
        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);
            $totalPrice += $product->price * $productData['quantity'];
        }

        $sale = Sale::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
        ]);

        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);
            $product->stock -= $productData['quantity'];
            $product->save();
        }

        return redirect()->route('sales.index')->with('success', 'Sale completed successfully.');
    }

    public function history()
    {
        $sales = Sale::with('user')->where('user_id', Auth::id())->get();
        return view('sales.history', compact('sales'));
    }

    public function show(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $sales = Sale::with('user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        return view('sales.report', compact('sales', 'startDate', 'endDate'));
    }
}
