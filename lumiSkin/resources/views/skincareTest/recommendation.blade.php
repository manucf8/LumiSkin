{{-- Author: Sara Valentina Cortes Manrique   --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container my-5">
    <div class="card p-5">
        <h1 class="text-center mb-3">{{ $viewData['title'] }}</h1>
        <h2 class="text-center mb-4">{{ $viewData['subtitle'] }}</h2>

        @if ($viewData['recommendedProducts']->isEmpty())
        <p class="text-center">{{ $viewData['noProductsMessage'] }}</p>
        @else
        <div class="mb-4">
            <ul class="list-group">
                @foreach ($viewData['recommendedProducts'] as $product)
                <li class="list-group-item">
                    <strong>{{ $product->name }}</strong> ({{ $product->brand }}) – {{ $product->description }}
                </li>
                @endforeach
            </ul>
        </div>

        @if (!empty($viewData['explanation']))
        <div class="alert alert-info">
            {{ $viewData['explanation'] }}
        </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('skincareTest.routine', ['test' => $viewData['test']->id]) }}"
                class="btn btn-outline-primary">
                {{ __('skincare_test.generate_routine') }}
            </a>
        </div>
        @endif
        <div class="text-center mt-4">
            <a href="{{ route('product.index') }}"
                class="btn btn-outline-primary">
                {{ __('skincare_test.shop_now') }}
            </a>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('skincareTest.index') }}" class="btn btn-link">{{ __('skincare_test.back') }}</a>
        </div>
    </div>
</div>
@endsection