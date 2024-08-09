@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Manage Products</a>
        <a href="{{ route('users.index') }}" class="btn btn-success">Manage Users</a>
    </div>
@endsection
