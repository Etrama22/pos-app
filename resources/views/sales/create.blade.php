@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Sale</h1>
        <form id="sale-form" action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div id="products-container">
                <div class="product-row">
                    <div class="form-group">
                        <label for="product-0">Product</label>
                        <select class="form-control product-select" id="product-0" name="products[0][id]" data-index="0"
                            required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->name }} (Stock: {{ $product->stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity-0">Quantity</label>
                        <input type="number" class="form-control quantity-input" id="quantity-0"
                            name="products[0][quantity]" data-index="0" min="1" required>
                    </div>
                </div>
            </div>
            <button type="button" id="add-product" class="btn btn-primary mt-3">Add Another Product</button>
            <div class="form-group mt-3">
                <label for="discount">Discount (%)</label>
                <input type="number" class="form-control" id="discount" name="discount" min="0" max="100">
            </div>
            <div class="form-group mt-3">
                <label>Total Price: </label>
                <span id="total-price">0.00</span>
            </div>
            <div class="form-group mt-3">
                <label>Final Price after Discount: </label>
                <span id="final-price">0.00</span>
            </div>
            <button type="submit" class="btn btn-success mt-3">Complete Sale</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var productsContainer = document.getElementById('products-container');
            var addProductButton = document.getElementById('add-product');
            var totalPriceSpan = document.getElementById('total-price');
            var finalPriceSpan = document.getElementById('final-price');
            var discountInput = document.getElementById('discount');

            function updatePrices() {
                var totalPrice = 0;
                document.querySelectorAll('.product-row').forEach(function(row) {
                    var index = row.querySelector('.product-select').dataset.index;
                    var productSelect = document.getElementById('product-' + index);
                    var quantityInput = document.getElementById('quantity-' + index);
                    var price = parseFloat(productSelect.options[productSelect.selectedIndex].dataset
                    .price);
                    var quantity = parseInt(quantityInput.value);
                    if (!isNaN(price) && !isNaN(quantity)) {
                        totalPrice += price * quantity;
                    }
                });

                totalPriceSpan.textContent = totalPrice.toFixed(2);

                var discount = parseFloat(discountInput.value);
                var finalPrice = totalPrice;
                if (!isNaN(discount) && discount > 0 && discount <= 100) {
                    finalPrice = totalPrice * (1 - discount / 100);
                }
                finalPriceSpan.textContent = finalPrice.toFixed(2);
            }

            addProductButton.addEventListener('click', function() {
                var index = productsContainer.children.length;
                var newRow = document.createElement('div');
                newRow.className = 'product-row';
                newRow.innerHTML = `
                    <div class="form-group">
                        <label for="product-${index}">Product</label>
                        <select class="form-control product-select" id="product-${index}" name="products[${index}][id]" data-index="${index}" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity-${index}">Quantity</label>
                        <input type="number" class="form-control quantity-input" id="quantity-${index}" name="products[${index}][quantity]" data-index="${index}" min="1" required>
                    </div>
                `;
                productsContainer.appendChild(newRow);
                document.getElementById('product-' + index).addEventListener('change', updatePrices);
                document.getElementById('quantity-' + index).addEventListener('input', updatePrices);
            });

            document.querySelectorAll('.product-select').forEach(function(select) {
                select.addEventListener('change', updatePrices);
            });

            document.querySelectorAll('.quantity-input').forEach(function(input) {
                input.addEventListener('input', updatePrices);
            });

            discountInput.addEventListener('input', updatePrices);
        });
    </script>
@endsection
