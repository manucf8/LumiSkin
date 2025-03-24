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

        <p><strong>Order Date:</strong> {{ $viewData['order']->getCreatedAt()->format('M d, Y H:i') }}</p>
        <p><strong>Delivery Date:</strong> {{ $viewData['order']->getDeliveryDate()->format('M d, Y') }}</p>
        <p><strong>Customer:</strong> {{ $viewData['order']->user->name }}</p>

        <h3 class="mt-4">Products</h3>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
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

        <p class="total">Total: ${{ number_format($viewData['order']->getTotal(), 0, ',', '.') }}</p>
    </div>
</body>

</html>