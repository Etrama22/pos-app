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
        $totalPrice = 0;
        $products = $request->input('products', []);

        foreach ($products as $product) {
            $productModel = Product::find($product['id']);
            $totalPrice += $productModel->price * $product['quantity'];

            // Reduce stock
            $productModel->stock -= $product['quantity'];
            $productModel->save();
        }

        $discount = $request->input('discount', 0);
        $finalPrice = $totalPrice * (1 - $discount / 100);

        $sale = Sale::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'discount' => $discount,
            'final_price' => $finalPrice,
        ]);

        foreach ($products as $product) {
            $sale->products()->attach($product['id'], [
                'quantity' => $product['quantity'],
                'price' => Product::find($product['id'])->price,
            ]);
        }

        // Redirect to the receipt view
        return redirect()->route('sales.receipt', $sale->id)->with('success', 'Sale completed successfully!');
    }

    public function receipt($id)
    {
        $sale = Sale::with('products')->find($id);
        return view('sales.receipt', compact('sale'));
    }

    public function applyDiscount(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $sale = Sale::find($request->sale_id);
        $sale->total_price -= ($sale->total_price * ($request->discount / 100));
        $sale->discount = $request->discount;
        $sale->save();

        return redirect()->route('sales.receipt', $sale->id);
    }

    public function show($id)
    {
        $sale = Sale::with('products.product')->find($id);
        return view('sales.report', compact('sale'));
    }
}
