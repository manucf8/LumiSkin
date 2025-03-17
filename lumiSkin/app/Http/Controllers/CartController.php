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

        // Agregar el producto solo si no está en el carrito
        if (!isset($cart[$product->id])) {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
            ];
        }

        session()->put('cart', $cart);
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
