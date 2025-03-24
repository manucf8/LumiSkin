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
        My profile
    </div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $viewData['user']->getName() }}</p>
        <p><strong>Email:</strong> {{ $viewData['user']->getEmail() }}</p>
        <p><strong>Balance:</strong> ${{ $viewData['user']->getBalance() }}</p>

        <form method="POST" action="{{ route('profile.increaseBalance') }}">
            @csrf
            <input type="hidden" name="amount" value="50000">
            <button type="submit" class="btn btn-success mt-2">Add $50.000 to Balance</button>
        </form>

        <p><strong>Orders:</strong></p>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['orders'] as $order)
                <tr>
                    <td>{{ $order->getId() }}</td>
                    <td>${{ number_format($order->getTotal(), 2) }}</td>
                    <td>{{ $order->getCreatedAt() }}</td>
                </tr>
                @endforeach
            </tbody>
    </div>
</div>
</table>
</div>
</div>
@endsection