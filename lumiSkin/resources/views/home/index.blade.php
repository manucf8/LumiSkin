@extends('layouts.app')
@section('title', 'Home Page - Online Store')
@section('content')

<!-- Hero Section -->
<div class="hero text-center py-5">
    <h1 class="fw-bold">Discover Natural Beauty with LumiSkin</h1>
    <p>Explore our store and find the best products for your skin.</p>
    <a href="#" class="btn btn-outline-primary">Shop Now</a>
</div>

<!-- Featured Categories -->
<div class="container mt-5">
    <h2 class="text-center">Shop by Categories</h2>
    <div class="row mt-4">
        <div class="col-md-4 text-center">
            <div class="card p-3">
                <h4>Makeup</h4>
                <p>Find the best products to enhance your beauty.</p>
                <a href="#" class="btn btn-outline-dark">Explore</a>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card p-3">
                <h4>Skincare</h4>
                <p>Specialized products for every skin type.</p>
                <a href="#" class="btn btn-outline-dark">Explore</a>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card p-3">
                <h4>New Arrivals</h4>
                <p>Check out the latest products added to our collection.</p>
                <a href="{{ route('product.newest') }}" class="btn btn-outline-dark">Explore</a>
            </div>
        </div>
    </div>
</div>

<!-- Skincare Test -->
<div class="test-skincare text-center py-5 mt-5">
    <h2 class="fw-bold">Find the Perfect Products for You</h2>
    <p>Take our skincare test and get personalized recommendations.</p>
    <a href="#" class="btn btn-light">Take the Test</a>
</div>

<!-- Best Sellers -->
<div class="container mt-5">
    <h2 class="text-center">Best Sellers</h2>
    <div class="row mt-4">
        <div class="col-md-3 text-center">
            <div class="card p-3">
                <img src="#" class="card-img-top" alt="Product 1">
                <h5 class="mt-2">Product 1</h5>
                <p>$20.00</p>
                <a href="#" class="btn btn-outline-primary">View More</a>
            </div>
        </div>
        <div class="col-md-3 text-center">
            <div class="card p-3">
                <img src="#" class="card-img-top" alt="Product 2">
                <h5 class="mt-2">Product 2</h5>
                <p>$25.00</p>
                <a href="#" class="btn btn-outline-primary">View More</a>
            </div>
        </div>
        <div class="col-md-3 text-center">
            <div class="card p-3">
                <img src="#" class="card-img-top" alt="Product 3">
                <h5 class="mt-2">Product 3</h5>
                <p>$30.00</p>
                <a href="#" class="btn btn-outline-primary">View More</a>
            </div>
        </div>
        <div class="col-md-3 text-center">
            <div class="card p-3">
                <img src="#" class="card-img-top" alt="Product 4">
                <h5 class="mt-2">Product 4</h5>
                <p>$35.00</p>
                <a href="#" class="btn btn-outline-primary">View More</a>
            </div>
        </div>
    </div>
</div>
@endsection
