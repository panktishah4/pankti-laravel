@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Products')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Products')

{{-- Content body: main page content --}}

@section('content_body')


<div class="container mt-5">
    <h2 class="mb-4"> Popular Products </h2>
    <div class="d-flex justify-content-end">
        <div class="m-2">
            <a class="btn btn-info" href="{{ route('products.create')}}">Create Product</a>
        </div>
    </div>
    <div class="row g-4">
        
        @include('view-cart')

        <div id="cd-cart">
            <h2>Cart</h2>
            <ul class="cd-cart-items">
                @forelse (session('cart') as $key=>$cart )
                <li>
                    <span class="cd-qty">1x</span> {{ $cart['name'] }}
                    <div class="cd-price">{{ $cart['price']}}<div>
                    <a href="#0" class="cd-item-remove cd-img-replace" data-id="{{ $key }}">Remove</a>
                </li>
                @empty
                    <div>No items have been added to cart.</div>
                @endforelse
                
            </ul> <!-- cd-cart-items -->
        
            <div class="cd-cart-total">
                <p>Total <span></span></p>
            </div> <!-- cd-cart-total -->
        
            {{-- <a href="#0" class="checkout-btn">Checkout</a> --}}
            
            {{-- <p class="cd-go-to-cart"><a href="#0">Go to cart page</a></p> --}}
        </div> <!-- cd-cart -->
    </div>
    
</div>
@stop

{{-- Push extra CSS --}}

<style>
    
</style>

@push('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="{{ asset('styles/index.css') }}">
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endpush

{{-- Push extra scripts --}}

@push('js')
<script>
    let cart_add = "{{ route('cart.add') }}";
    let cart_remove = "{{ route('cart.remove') }}";
</script>
<script src="{{ asset('scripts/index.js') }}"></script>
    
    
@endpush