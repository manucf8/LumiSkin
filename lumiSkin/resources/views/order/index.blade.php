@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="text-center mb-3 fw-bold">{{ $viewData['title'] }}</h2>
        <p class="text-center text-muted">{{ $viewData['subtitle'] }}</p>

        <div class="row mb-4">
            <div class="col-md-4">
                <strong>Order Date:</strong><br>
                {{ $viewData['order']->getCreatedAt()->format('M d, Y H:i') }}
            </div>
            <div class="col-md-4">
                <strong>Delivery Date:</strong><br>
                {{ $viewData['order']->getDeliveryDate()->format('M d, Y') }}
            </div>
            <div class="col-md-4 text-uppercase">
                <strong>Total: ${{ number_format($viewData['order']->getTotal(), 0, ',', '.') }}</strong>
            </div>
        </div>
        <div class="col-md-4">
            <strong>Customer:</strong><br>
            {{ $viewData['order']->user->name }}
        </div>


        <h4 class="mt-4 mb-3 fw-bold">Purchased Products</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewData['order']->getItems() as $item)
                    <tr>
                        <td>{{ $item->product->getName() }}</td>
                        <td class="text-center">{{ $item->getQuantity() }}</td>
                        <td class="text-center">${{ number_format($item->getPrice(), 0, ',', '.') }}</td>
                        <td class="text-center">${{ number_format($item->getSubtotal(), 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('order.pdf', ['id' => $viewData['order']->getId()]) }}" class="btn btn-outline-primary">
                Download PDF
            </a>
            <a href="/" class="btn btn-outline-primary">← Back to Store</a>
        </div>
    </div>
</div>
@endsection