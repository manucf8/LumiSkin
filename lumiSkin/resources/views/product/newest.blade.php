@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')

<div class="container mt-4 text-center">
    <h2 class="text-center">{{ $viewData["title"] }}</h2>
    <p>{{ $viewData["subtitle"] }}</p>
    <p>These are the newest products in our catalog! Stay up to date with the latest trends.</p>
    <div class="row justify-content-center">
        @if(count($viewData["products"]) > 0)
        @foreach ($viewData["products"] as $product)
        <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top img-card">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center text-primary">{{ $product->getName() }}</h5>
                    <p class="card-text text-muted text-center">{{ Str::limit($product->getDescription(), 60) }}</p>
                    <p class="card-text text-center">Added to our catalog on: {{ $product->getCreatedAt() }}</p>
                    <p class="text-center text-success fw-bold">$ {{ number_format($product->getPrice(), 0, ',', '.') }}</p>
                    <form method="POST" action="{{ route('cart.add') }}" class="mt-auto">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary w-100">🛒 Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="col-12 text-center">
            <p class="text-muted">No products found.</p>
        </div>
        @endif
    </div>
</div>

@endsection