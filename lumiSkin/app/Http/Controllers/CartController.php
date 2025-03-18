<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request): RedirectResponse
    {
        $product = Product::findOrFail($request->id);
        $cart = session()->get('cart', []);

        if (!isset($cart[$product->id])) {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        } else {
            $cart[$product->id]['quantity'] += 1; // Incrementa la cantidad si ya está en el carrito
        }

        session()->put('cart', $cart);
        return back();
    }

    public function updateCart(Request $request, int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int) $request->quantity); // Asegura que la cantidad sea al menos 1
            session()->put('cart', $cart);
        }

        return back();
    }

    public function removeFromCart(int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back();
    }

    public function clearCart(): RedirectResponse
    {
        session()->forget('cart');
        return back();
    }
}
