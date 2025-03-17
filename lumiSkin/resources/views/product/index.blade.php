@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')

<div class="container mt-4">
    <form method="GET" action="{{ route('product.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search products..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <div class="row">
        @if(count($viewData["products"]) > 0)
        @foreach ($viewData["products"] as $product)
        <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('images/' . 'default.jpg') }}" class="card-img-top" alt="{{ $product['name'] }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center text-primary">{{ $product->getName() }}</h5>
                    <p class="card-text text-muted text-center">{{ Str::limit($product->getDescription(), 60) }}</p>
                    <p class="text-center text-success fw-bold">$ {{ $product->getPrice() }}</p>
                    <a href="#" class="btn btn-primary w-100 mt-auto">
                        Add Cart
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="col-12 text-center">
            <p class="text-muted">No se encontraron productos.</p>
        </div>
        @endif
    </div>
</div>

@endsection