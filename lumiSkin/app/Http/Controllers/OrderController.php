<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        // Calculate total
        $total = Product::calculateTotal($cart);

        // Validate delivery date
        Order::validate($request);

        // Create order with user_id
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'delivery_date' => $request->delivery_date,
        ]);


        // Add items to the order
        foreach ($cart as $productId => $details) {
            Item::create([
                'product_id' => $productId,
                'order_id' => $order->id,
                'price' => $details['price'],
                'quantity' => $details['quantity'],
                'subtotal' => $details['price'] * $details['quantity'],
            ]);
        }

        // Clear cart
        session()->forget('cart');
        session()->forget('cart_total');
        session()->forget('cart_quantity');

        return redirect()->route('orders.index', $order->id)
            ->with('success', 'Order created successfully!');
    }

    public function index($id): View
    {
        $order = Order::with('items.product')->findOrFail($id);

        $viewData = [];
        $viewData['title'] = 'Order Summary';
        $viewData['subtitle'] = 'Your completed purchase';
        $viewData['order'] = $order;

        return view('orders.index')->with('viewData', $viewData);
    }
}
