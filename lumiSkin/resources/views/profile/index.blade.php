{{-- Author: Manuela Castaño Franco --}}

@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-header">
        {{ __('profile.title') }}
    </div>
    <div class="card-body">
        <p><strong>{{ __('profile.name') }}:</strong> {{ $viewData['user']->getName() }}</p>
        <p><strong>{{ __('profile.email') }}:</strong> {{ $viewData['user']->getEmail() }}</p>
        <p><strong>{{ __('profile.balance') }}:</strong> ${{ $viewData['user']->getBalance() }}</p>

        <form method="POST" action="{{ route('profile.increaseBalance') }}">
            @csrf

            <input type="hidden" name="amount" value="50">
            <button type="submit" class="btn btn-success mt-2">{{ __('profile.add_balance') }}</button>

        </form>

        <p><strong>{{ __('orders.orders') }}:</strong></p>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('orders.order_id') }}</th>
                    <th>{{ __('orders.amount') }}</th>
                    <th>{{ __('orders.date') }}</th>
                    <th>{{ __('orders.summary') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['orders'] as $order)
                <tr>
                    <td>{{ $order->getId() }}</td>
                    <td>${{ $order->getTotal() }}</td>
                    <td>{{ $order->getCreatedAt() }}</td>
                    <td class="text-center mt-4">
                        <a href="{{ route('order.index', $order->getId()) }}" class="btn btn-outline-primary">
                            {{ __('orders.summary') }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </div>
</div>
</table>
</div>
</div>
@endsection