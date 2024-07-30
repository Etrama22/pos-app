@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sales Management</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Create Sale</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Total Price</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->user->name }}</td>
                        <td>{{ $sale->total_price }}</td>
                        <td>{{ $sale->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
