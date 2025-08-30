@extends('layouts.app')

@section('title', 'Create Bill')

@section('content')
    <h1>Create New Bill</h1>

    <form method="POST" action="{{ route('bills.store') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="customer_id" class="form-label">Customer</label>
                <select class="form-select" id="customer_id" name="customer_id" required>
                    <option value="">Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date"
                    value="{{ old('date', now()->format('Y-m-d')) }}" required>
            </div>
        </div>

        <h4>Items</h4>
        <div id="items-container">
            <div class="item row mb-3">
                <div class="col-md-5">
                    <select class="form-select product-select" name="items[0][product_id]" required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                {{ $product->name }} (${{ number_format($product->price, 2) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control quantity" name="items[0][quantity]" min="1" value="1" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control price" readonly>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-item">×</button>
                </div>
            </div>
        </div>

        <button type="button" id="add-item" class="btn btn-secondary mb-3">Add Item</button>

        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Create Bill</button>
            </div>
            <div class="col-md-6 text-end">
                <h5>Total: $<span id="total-amount">0.00</span></h5>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Add new item
                document.getElementById('add-item').addEventListener('click', function () {
                    const container = document.getElementById('items-container');
                    const index = container.querySelectorAll('.item').length;
                    const newItem = document.createElement('div');
                    newItem.className = 'item row mb-3';
                    newItem.innerHTML = `
                            <div class="col-md-5">
                                <select class="form-select product-select" name="items[${index}][product_id]" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                            {{ $product->name }} (${{ number_format($product->price, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control quantity" name="items[${index}][quantity]" min="1" value="1" required>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control price" readonly>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger remove-item">×</button>
                            </div>
                        `;
                    container.appendChild(newItem);
                    addItemEventListeners(newItem);
                });

                // Remove item
                document.addEventListener('click', function (e) {
                    if (e.target.classList.contains('remove-item')) {
                        const item = e.target.closest('.item');
                        if (document.querySelectorAll('.item').length > 1) {
                            item.remove();
                            calculateTotal();
                        }
                    }
                });

                // Add event listeners to initial item
                document.querySelectorAll('.item').forEach(item => {
                    addItemEventListeners(item);
                });

                function addItemEventListeners(item) {
                    const productSelect = item.querySelector('.product-select');
                    const quantityInput = item.querySelector('.quantity');
                    const priceInput = item.querySelector('.price');

                    productSelect.addEventListener('change', function () {
                        const price = this.options[this.selectedIndex]?.dataset.price || 0;
                        priceInput.value = '$' + parseFloat(price).toFixed(2);
                        calculateTotal();
                    });

                    quantityInput.addEventListener('input', calculateTotal);
                }

                function calculateTotal() {
                    let total = 0;
                    document.querySelectorAll('.item').forEach(item => {
                        const productSelect = item.querySelector('.product-select');
                        const quantityInput = item.querySelector('.quantity');
                        const price = productSelect.options[productSelect.selectedIndex]?.dataset.price || 0;
                        const quantity = quantityInput.value || 0;
                        total += parseFloat(price) * parseInt(quantity);
                    });
                    document.getElementById('total-amount').textContent = total.toFixed(2);
                }
            });
        </script>
    @endpush
@endsection