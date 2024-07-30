@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cashier Dashboard</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary">Create Sale</a>
        <a href="{{ route('sales.history') }}" class="btn btn-secondary">View Sales History</a>
        <a href="{{ route('cashier.products') }}" class="btn btn-info">View Products</a> <!-- Tambahkan link ini -->
    </div>
@endsection
