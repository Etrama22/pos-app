@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cashier Dashboard</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary">Create Sale</a>
    </div>
@endsection
