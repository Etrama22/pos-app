@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Sale</h1>
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="products" class="form-label">Products</label>
                <select class="form-control" id="products" name="products[0][id]" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                    @endforeach
                </select>
                <input type="number" class="form-control mt-2" name="products[0][quantity]" placeholder="Quantity"
                    required>
            </div>
            <button type="button" class="btn btn-secondary mb-3" id="addProduct">Add Another Product</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('addProduct').addEventListener('click', function() {
            let productSelect = document.getElementById('products').cloneNode(true);
            productSelect.name = `products[${document.getElementsByName('products[]').length}][id]`;
            let quantityInput = document.querySelector('input[name="products[0][quantity]"]').cloneNode(true);
            quantityInput.name = `products[${document.getElementsByName('products[]').length}][quantity]`;
            let newProduct = document.createElement('div');
            newProduct.classList.add('mb-3');
            newProduct.appendChild(productSelect);
            newProduct.appendChild(quantityInput);
            document.querySelector('form').insertBefore(newProduct, document.getElementById('addProduct'));
        });
    </script>
@endsection
