@extends('layouts.app')
@section('title', 'Home Page - Online Store')
@section('content')

<!-- Hero Section -->
<div class="hero text-center py-5">
    <h1 class="fw-bold">Discover Natural Beauty with LumiSkin</h1>
    <p>Explore our store and find the best products for your skin.</p>
    <a href="{{ route('product.index') }}" class="btn btn-outline-primary">Shop Now</a>
</div>

<!-- Featured  -->
<div class="container mt-5">
    <h2 class="text-center">Shop</h2>
    <div class="row mt-4">
        <div class="col-md-4 text-center">
            <div class="card p-3">
                <h4>Search products</h4>
                <p>Find a product by its name or category.</p>
                <a href="{{ route('product.index') }}" class="btn btn-outline-dark">Explore</a>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card p-3">
                <h4>Categories Catalog</h4>
                <p>Browse all of our currently available categories.</p>
                <a href="{{ route('category.index') }}" class="btn btn-outline-dark">Explore</a>
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
    <a href="{{ route('skincare_test.index') }}" class="btn btn-light">Take the Test</a>
</div>

<!-- Best Sellers -->
<div class="container mt-5">
    <h2 class="text-center">Best Sellers</h2>
    <div class="row">
        @foreach ($viewData["topProducts"] as $product)
        <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top img-card">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center text-primary">{{ $product->getName() }}</h5>
                    <p class="card-text text-muted text-center">{{ Str::limit($product->getDescription(), 60) }}</p>
                    <p class="text-center text-success fw-bold">
                        $ {{ number_format($product->getPrice(), 0, ',', '.') }}</p>
                    <form method="POST" action="{{ route('cart.add') }}" class="mt-auto">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary w-100">🛒 Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection