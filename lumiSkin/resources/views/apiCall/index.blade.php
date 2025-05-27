@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="container">
    <div class="row">
    @foreach($viewData['products'] as $product)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="{{ 'http://tcg-merket.shop/' . $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product['name'] }}</h5>
                <p class="card-text">{{ $product['description'] }}</p>
                <p><strong>Franquicia:</strong> {{ $product['franchise'] }}</p>
                <p><strong>Rareza:</strong> {{ $product['rarity'] }}</p>
                <p><strong>Idioma:</strong> {{ $product['language'] }}</p>
                <p><strong>Stock:</strong> {{ $product['stock'] }}</p>
                <p><strong>PSA Grade:</strong> {{ $product['PSAgrade'] }}</p>
                <p><strong>Fecha de Lanzamiento:</strong> {{ $product['launchDate'] }}</p>
                <p><strong>Pull Rate:</strong> {{ $product['pullRate'] }}</p>
                <strong>${{ number_format($product['price'], 0, ',', '.') }}</strong>
                <br>
                <a href="{{ $product['showLink'] }}" class="btn btn-primary mt-2" target="_blank">Ver Tarjeta</a>
            </div>
        </div>
    </div>
    @endforeach
    </div>
</div>
@endsection
