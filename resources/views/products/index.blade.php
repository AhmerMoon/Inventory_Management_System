@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th class="px-4">Name</th>
                    <th class="px-4">Description</th>
                    <th class="px-4 text-end">Price</th>
                    <th class="px-4 text-end">Stock</th>
                    <th class="px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="px-4 align-middle">{{ $product->name }}</td>
                    <td class="px-4 align-middle">{{ Str::limit($product->description, 50) }}</td>
                    <td class="px-4 align-middle text-end">${{ number_format($product->price, 2) }}</td>
                    <td class="px-4 align-middle text-end">{{ $product->quantity }}</td>
                    <td class="px-4 align-middle text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        
        .table th, .table td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        
        .table thead th {
            background-color: #343a40;
            color: white;
            font-weight: 600;
        }
        
        .table tbody tr {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
@endsection