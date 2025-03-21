<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'El carrito está vacío');
        }

        // Calcular total
        $total = Product::calculateTotal($cart);

        // Validar fecha de entrega
        Order::validate($request);

        // Crear orden SIN user_id
        $order = Order::create([
            'total' => $total,
            'delivery_date' => $request->delivery_date,
            // 'user_id' => null // opcional si quieres dejarlo explícito
        ]);

        // Agregar los ítems del carrito a la orden
        foreach ($cart as $productId => $details) {
            Item::create([
                'product_id' => $productId,
                'order_id' => $order->id,
                'price' => $details['price'],
                'quantity' => $details['quantity'],
                'subtotal' => $details['price'] * $details['quantity'],
            ]);
        }

        session()->forget('cart');
        session()->forget('cart_total');
        session()->forget('cart_quantity');

        return redirect()->route('orders.show', $order->id)
            ->with('success', '¡Orden creada con éxito!');
    }


    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('orders.show', compact('order'));
    }
}
