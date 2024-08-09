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

        @if (isset($sale))
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Total Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale as $sales)
                        <tr>
                            <td>{{ $sales->user->name }}</td>
                            <td>{{ $sales->total_price }}</td>
                            <td>{{ $sales->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
