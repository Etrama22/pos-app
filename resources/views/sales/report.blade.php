@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sales Report</h1>
        <form action="{{ route('sales.report') }}" method="GET">
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate ?? '' }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate ?? '' }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>

        @if (isset($sales))
            <table class="table table-bordered mt-3">
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
        @endif
    </div>
@endsection
