@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')

<div class="container mt-4">
    <p>{{ __('products.search_name') }}</p>
    <form method="GET" action="{{ route('product.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="{{ __('products.search_products') }}"
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">{{ __('products.search') }}</button>
        </div>
    </form>

    <p>{{ __('products.search_category') }}</p>
    <form action="{{ route('product.searchByCategory') }}" method="GET">
        <div class="input-group">
            <select name="category_id" class="form-select">
                <option value="">{{ __('categories.select') }}</option>
                @foreach($viewData['categories'] as $category)
                <option value="{{ $category->id }}">{{ $category->getName() }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">{{ __('products.search') }}</button>
        </div>
    </form>
</div>
<div class="container mt-4">
    <div class="row">
        @if(count($viewData["products"]) > 0)
        @foreach ($viewData["products"] as $product)
        <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top img-card">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center text-primary">{{ $product->getName() }}</h5>
                    <p class="card-text text-muted text-center">{{ $product->getDescription() }}</p>
                    <p class="text-center text-muted">Categories: {{ $product->getCategories() }}</p>
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
        @else
        <div class="col-12 text-center">
            <p class="text-muted">{{ __('products.not_found') }}</p>
        </div>
        @endif
    </div>
</div>

@endsection
