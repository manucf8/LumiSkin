@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <h1>{{ $viewData['title'] }}</h1>
    <h2>{{ $viewData['subtitle'] }}</h2>

    @if ($viewData['recommendedProducts']->isEmpty())
        <p>{{ $viewData['noProductsMessage'] }}</p>
    @else
        <ul>
            @foreach ($viewData['recommendedProducts'] as $product)
                <li>
                    <strong>{{ $product->name }}</strong> ({{ $product->brand }}) - {{ $product->description }}
                </li>
            @endforeach
        </ul>

        @if (!empty($viewData['explanation']))
            <p>{{ $viewData['explanation'] }}</p>
        @endif
    @endif

    <a href="{{ route('skincare_test.index') }}">Back to the Test</a>
@endsection