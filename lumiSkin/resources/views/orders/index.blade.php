@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
    <h1>{{ $viewData['title'] }}</h1>
    <p>{{ $viewData['subtitle'] }}</p>

    <p><strong>Order Date:</strong> {{ $viewData['order']->getCreatedAt()->format('M d, Y H:i') }}</p>
    <p><strong>Delivery Date:</strong> {{ $viewData['order']->getDeliveryDate()->format('M d, Y') }}</p>
    <p><strong>Total:</strong> ${{ number_format($viewData['order']->getTotal(), 0, ',', '.') }}</p>

    <h3 class="mt-4">Purchased Products</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viewData['order']->getItems() as $item)
            <tr>
                <td>{{ $item->product->getName() }}</td>
                <td>{{ $item->getQuantity() }}</td>
                <td>${{ number_format($item->getPrice(), 0, ',', '.') }}</td>
                <td>${{ number_format($item->getSubtotal(), 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('home.index') }}" class="btn btn-primary mt-3">Back to Store</a>
</div>
@endsection
