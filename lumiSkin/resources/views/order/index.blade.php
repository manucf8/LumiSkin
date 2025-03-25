{{-- Author: Juan Pablo Zuluaga Pelaez  --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="text-center mb-3 fw-bold">{{ $viewData['title'] }}</h2>
        <p class="text-center text-muted">{{ $viewData['subtitle'] }}</p>

        <div class="row mb-4">
            <div class="col-md-4">
                <strong>{{ __('orders.order_date') }}:</strong><br>
                {{ $viewData['order']->getCreatedAt() }}
            </div>
            <div class="col-md-4">
                <strong>{{ __('orders.delivery_date') }}:</strong><br>
                {{ $viewData['order']->getDeliveryDate() }}
            </div>
            <div class="col-md-4 text-uppercase">
                <strong>{{ __('orders.total') }}: ${{ $viewData['order']->getTotal() }}</strong>
            </div>
        </div>
        <div class="col-md-4">
            <strong>{{ __('orders.customer') }}:</strong><br>
            {{ $viewData['order']->getCustomerName() }}
        </div>


        <h4 class="mt-4 mb-3 fw-bold">{{ __('orders.products') }}</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th class="text-center">{{ __('orders.quantity') }}</th>
                        <th class="text-center">{{ __('orders.unit_price') }}</th>
                        <th class="text-center">{{ __('orders.subtotal') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewData['order']->getItems() as $item)
                    <tr>
                        <td>{{ $item->product->getName() }}</td>
                        <td class="text-center">{{ $item->getQuantity() }}</td>
                        <td class="text-center">${{ $item->getPrice() }}</td>
                        <td class="text-center">${{ $item->getSubtotal() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('order.pdf', ['id' => $viewData['order']->getId()]) }}" class="btn btn-outline-primary">
                {{ __('orders.pdf') }}
            </a>
            <a href="/" class="btn btn-outline-primary">{{ __('app.back') }}</a>
        </div>
    </div>
</div>
@endsection
