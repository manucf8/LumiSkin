<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $viewData['title'] }}</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8f9fa;
            color: #333;
            font-size: 12px;
        }

        h1,
        h2 {
            text-align: center;
        }

        .card {
            border-radius: 10px;
            background-color: #c1e1ee;
            padding: 25px;
            margin: 20px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .btn-outline-primary {
            border: 1px solid #5faacb;
            background-color: #5faacb;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            margin-top: 20px;
        }

        .total {
            text-align: right;
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>{{ $viewData['title'] }}</h1>
        <h2>{{ $viewData['subtitle'] }}</h2>

        <p><strong>{{ __('orders.order_date') }}:</strong> {{ $viewData['order']->getCreatedAt() }}</p>
        <p><strong>{{ __('orders.delivery_date') }}:</strong> {{ $viewData['order']->getDeliveryDate() }}</p>
        <p><strong>{{ __('orders.customer') }}:</strong> {{ $viewData['order']->getCustomerName() }}</p>

        <h3 class="mt-4">{{ __('orders.products') }}</h3>

        <table>
            <thead>
                <tr>
                    <th>{{ __('orders.product') }}</th>
                    <th>{{ __('orders.quantity') }}</th>
                    <th>{{ __('orders.unit_price') }}</th>
                    <th>{{ __('orders.subtotal') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData['order']->getItems() as $item)
                <tr>
                    <td>{{ $item->product->getName() }}</td>
                    <td>{{ $item->getQuantity() }}</td>
                    <td>${{ $item->getPrice() }}</td>
                    <td>${{ $item->getSubtotal() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">{{ __('orders.total') }}: ${{ $viewData['order']->getTotal() }}</p>
    </div>
</body>

</html>
