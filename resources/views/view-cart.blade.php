@foreach($products as $product)
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('uploads/' . $product->image) }}" class="card-img-top" alt="Product Image">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->short_description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="h5 mb-0">${{ number_format($product->price, 2) }}</span>
                </div>
            </div>


            <div class="card-footer d-flex justify-content-between bg-light">
                @php
                    $cart = session('cart', []);
                    $inCart = isset($cart[$product->id]) && $cart[$product->id] > 0;
                @endphp
                <input type="checkbox" class="form-control add_to_cart" data-id="{{ $product->id }}" {{ $inCart ? 'checked disabled' : '' }}>
            </div>
        </div>
    </div>
@endforeach