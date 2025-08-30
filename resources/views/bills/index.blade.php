@extends('layouts.app')

@section('title', 'Bills')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Bills</h1>
        <a href="{{ route('bills.create') }}" class="btn btn-primary">Create New Bill</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Bill #</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bills as $bill)
                <tr>
                    <td>{{ $bill->id }}</td>
                    <td>{{ $bill->customer->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($bill->date)->format('d/m/Y') }}</td>
                    <td>${{ number_format($bill->total, 2) }}</td>
                    <td>
                        <a href="{{ route('bills.show', $bill) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection