<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function salesReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Validate the dates
        // $request->validate([
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date|after_or_equal:start_date',
        // ]);

        // Query sales within the date range
        $sales = Sale::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('reports.sales', compact('sales', 'startDate', 'endDate'));
    }

    public function inventoryReport()
    {
        $products = Product::all();

        return view('reports.inventory', compact('products'));
    }
}
