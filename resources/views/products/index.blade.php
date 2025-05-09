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

            @foreach($products as $product)
            <div class="col-md-4">
                <div class="card">
                    <img  src="{{ asset('uploads/' . $product->image) }}" class="card-img-top" alt="Product Image">
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
        
        <div class="cart-items-container" id="cd-shadow-layer">
            @include('partials.view-cart')
        </div>

       
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
    let order_store = "{{ route('checkout.submit') }}";
</script>
<script src="{{ asset('scripts/index.js') }}"></script>
    
    
@endpush