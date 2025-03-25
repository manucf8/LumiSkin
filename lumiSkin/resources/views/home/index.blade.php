@extends('layouts.app')
@section('title', __('home.title'))
@section('content')

<!-- Hero Section -->
<div class="hero text-center py-5">
    <h1 class="fw-bold">{{ __('home.discover') }}</h1>
    <p>{{ __('home.explore_store') }}</p>
    <a href="{{ route('product.index') }}" class="btn btn-outline-primary">{{ __('home.shop_now') }}</a>
</div>

<!-- Featured  -->
<div class="container mt-5">
    <h2 class="text-center">{{ __('home.shop') }}</h2>
    <div class="row mt-4">
        <div class="col-md-4 text-center">
            <div class="card p-3">
                <h4>{{ __('products.search_products') }}</h4>
                <p>{{ __('products.find_product_by') }}</p>
                <a href="{{ route('product.index') }}" class="btn btn-outline-dark">{{ __('home.explore') }}</a>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card p-3">
                <h4>{{ __('categories.catalog') }}</h4>
                <p>{{ __('categories.browse') }}</p>
                <a href="{{ route('category.index') }}" class="btn btn-outline-dark">{{ __('home.explore') }}</a>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card p-3">
                <h4>{{ __('products.new_arrivals') }}</h4>
                <p>{{ __('products.latest') }}</p>
                <a href="{{ route('product.newest') }}" class="btn btn-outline-dark">{{ __('home.explore') }}</a>
            </div>
        </div>
    </div>
</div>

<!-- Skincare Test -->
<div class="test-skincare text-center py-5 mt-5">
    <h2 class="fw-bold">{{ __('skincare_test.find_best') }}</h2>
    <p>{{ __('skincare_test.take_test') }}</p>
    <a href="{{ route('skincare_test.index') }}" class="btn btn-light">{{ __('skincare_test.take_test_now') }}</a>
</div>

<!-- Best Sellers -->
<div class="container mt-5">
    <h2 class="text-center">{{ __('products.best_sellers') }}</h2>
    <div class="row">
        @foreach ($viewData["topProducts"] as $product)
        <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top img-card">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center text-primary">{{ $product->getName() }}</h5>
                    <p class="card-text text-muted text-center">{{ $product->getDescription() }}</p>
                    <p class="text-center text-success fw-bold">
                        $ {{ $product->getPrice() }}</p>
                    <form method="POST" action="{{ route('cart.add') }}" class="mt-auto">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary w-100">{{ __('cart.add') }}</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
