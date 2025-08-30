@extends('layouts.app')

@section('title', 'Bill Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Bill #{{ $bill->id }}</h1>
        <a href="{{ route('bills.index') }}" class="btn btn-secondary">Back to Bills</a>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Customer Information</h5>
            <p><strong>Name:</strong> {{ $bill->customer->name }}</p>
            <p><strong>Email:</strong> {{ $bill->customer->email }}</p>
            <p><strong>Phone:</strong> {{ $bill->customer->phone }}</p>
        </div>
        <div class="col-md-6 text-end">
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($bill->date)->format('d/m/Y') }}</p>
            <p><strong>Bill Total:</strong> ${{ number_format($bill->total, 2) }}</p>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bill->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total:</th>
                <th>${{ number_format($bill->total, 2) }}</th>
            </tr>
        </tfoot>
    </table>
@endsection