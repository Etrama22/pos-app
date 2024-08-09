@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Receipt</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sale ID: {{ $sale->id }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Cashier: {{ $sale->user->name }}</h6>
                <ul class="list-group list-group-flush">
                    @foreach ($sale->products as $product)
                        <li class="list-group-item">
                            {{ $product->name }} - {{ $product->pivot->quantity }} x {{ $product->pivot->price }}
                        </li>
                    @endforeach
                </ul>
                <p class="card-text mt-3">Total Price: {{ $sale->total_price }}</p>
                <p class="card-text mt-3">Discount: {{ $sale->discount }}%</p>
                <p class="card-text mt-3">Final Price: {{ $sale->final_price }}</p>
            </div>
        </div>
        <a href="{{ route('sales.index') }}" class="btn btn-primary mt-3">Back to Sales</a>
    </div>
@endsection
