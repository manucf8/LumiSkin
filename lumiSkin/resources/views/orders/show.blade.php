@extends('layouts.app')

@section('title', 'Order Summary')

@section('content')
<div class="container mt-4">
    <h1>Order #{{ $order->getId() }} Summary</h1>

    <p><strong>Order Date:</strong> {{ $order->getCreatedAt()->format('M d, Y H:i') }}</p>
    <p><strong>Delivery Date:</strong> {{ $order->getDeliveryDate()->format('M d, Y') }}</p>
    <p><strong>Total:</strong> ${{ $order->getTotal() }}</p>

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
            @foreach ($order->getItems() as $item)
            <tr>
                <td>{{ $item->product->getName() }}</td>
                <td>{{ $item->getQuantity() }}</td>
                <td>${{ $item->getPrice() }}</td>
                <td>${{ $item->getSubtotal() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="/" class="btn btn-primary mt-3">Back to Store</a>
</div>
@endsection
