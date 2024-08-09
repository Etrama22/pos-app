@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sales</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary">Create Sale</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->user->name }}</td>
                        <td>{{ $sale->total_price }}</td>
                        <td>
                            {{-- <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-info">View</a> --}}
                            <a href="{{ route('sales.receipt', $sale->id) }}" class="btn btn-secondary">Receipt</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
