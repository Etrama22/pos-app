@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-6">
                <h3>Total Sales</h3>
                <p>Today: $1234</p>
                <p>This Week: $5678</p>
            </div>
            <div class="col-md-6">
                <h3>Low Stock Alerts</h3>
                <p>Product A: 5 left</p>
                <p>Product B: 2 left</p>
            </div>
        </div>
    </div>
@endsection
