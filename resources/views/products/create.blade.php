@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')

<div class="container mt-5">
    <h2 class="mb-4"> Create Products </h2>

    <form class="mt-4" id="productForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Please enter product name"name="name" value="{{ old('name', $product->name ?? '') }}">
        </div>
    
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
            @if (!empty($product->image))
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $product->image) }}" width="100" class="img-thumbnail">
                </div>
            @endif
        </div>
    
        <div class="mb-3">
            <label for="short_description" class="form-label">Short Description</label>
            <textarea class="form-control" id="short_description" placeholder="Please enter product description"name="short_description" rows="3">{{ old('short_description', $product->short_description ?? '') }}</textarea>
        </div>
    
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" step="0.01" class="form-control" id="price" placeholder="Please enter product price in dollar($)"name="pvalue="{{ old('price', $product->price ?? '') }}">
        </div>
    
        <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" placeholder="Please enter product sku"value="{{ old('sku', $product->sku ?? '') }}">
        </div>
    
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    
</div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('#productForm').on('submit', function (e) {
        e.preventDefault();
        let form = $(this)[0];
        let formData = new FormData(form);

        $.ajax({
            url: "{{ route('products.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                
            },
            success: function (response) {
                alert(response.message);
                form.reset();
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    });
});
</script>
@endpush