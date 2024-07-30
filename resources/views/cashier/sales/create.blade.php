@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Sale</h1>
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="product" class="form-label">Products</label>
                @foreach ($products as $product)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="products[{{ $product->id }}]" value="1">
                        <label class="form-check-label">
                            {{ $product->name }} - ${{ $product->price }} (Stock: {{ $product->stock }})
                        </label>
                        <input type="number" name="quantities[{{ $product->id }}]" class="form-control"
                            placeholder="Quantity">
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Discount (%)</label>
                <input type="number" class="form-control" id="discount" name="discount" value="0">
            </div>
            <button type="submit" class="btn btn-primary">Complete Sale</button>
        </form>
    </div>
@endsection
