@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Receipt</h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->price }}</td>
                        <td>${{ $item->price * $item->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <p>Discount: {{ $sale->discount }}%</p>
            <p>Total: ${{ $sale->total }}</p>
        </div>
    </div>
@endsection
