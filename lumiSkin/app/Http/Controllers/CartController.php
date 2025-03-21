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
            $cart[$product->id]['quantity'] += 1;
        }

        session()->put('cart', $cart);
        session()->put('cart_total', Product::calculateTotal());
        session()->put('cart_quantity', Product::calculateTotalQuantity());

        return back();
    }

    public function updateCart(Request $request, int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int) $request->quantity);
            session()->put('cart', $cart);
        }

        session()->put('cart_total', Product::calculateTotal());
        session()->put('cart_quantity', Product::calculateTotalQuantity());

        return back();
    }

    public function removeFromCart(int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        session()->put('cart_total', Product::calculateTotal());
        session()->put('cart_quantity', Product::calculateTotalQuantity());

        return back();
    }

    public function clearCart(): RedirectResponse
    {
        session()->forget('cart');
        session()->forget('cart_total');
        session()->forget('cart_quantity');

        return back();
    }
}
