@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sales Report</h1>
        <form method="GET" action="{{ route('reports.sales') }}">
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" name="start_date" value="{{ $startDate ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" name="end_date" value="{{ $endDate ?? '' }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
        @if (isset($sales))
            <div class="mt-4">
                <h2>Sales Report from {{ $startDate }} to {{ $endDate }}</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sale ID</th>
                            <th>Products</th>
                            <th>Total Price</th>
                            <th>Discount</th>
                            <th>Final Price</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>
                                    <ul>
                                        @foreach ($sale->products as $product)
                                            <li>{{ $product->name }} - Quantity: {{ $product->pivot->quantity }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>${{ number_format($sale->total_price, 2) }}</td>
                                <td>{{ $sale->discount }}%</td>
                                <td>${{ number_format($sale->final_price, 2) }}</td>
                                <td>{{ $sale->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
