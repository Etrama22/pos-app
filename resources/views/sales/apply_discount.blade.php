@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Apply Discount</h1>
        <form action="{{ route('sales.applyDiscount') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="sale_id">Sale ID</label>
                <input type="number" class="form-control" name="sale_id" required>
            </div>
            <div class="form-group">
                <label for="discount">Discount (%)</label>
                <input type="number" class="form-control" name="discount" min="0" max="100" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">Apply Discount</button>
        </form>
    </div>
@endsection
