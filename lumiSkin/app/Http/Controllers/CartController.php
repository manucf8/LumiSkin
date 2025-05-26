<?php

/**
 * Author:
 * - Juan Pablo Zuluaga Pelaez
 */

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request): RedirectResponse
    {
        $productId = $request->id;
        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            $cart[$productId] = 1;
        } else {
            $cart[$productId]++;
        }

        session()->put('cart', $cart);

        return back();
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id] = max(1, (int) $request->quantity);
            session()->put('cart', $cart);
        }

        return back();
    }

    public function remove(int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back();
    }

    public function clear(): RedirectResponse
    {
        session()->forget('cart'); // ← único dato que necesitas eliminar

        return back();
    }
}
