<?php

/**
 * Author:
 * - Juan Pablo Zuluaga Pelaez
 */

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', __('cart.empty'));
        }

        $total = 0;
        $itemsData = [];

        foreach ($cart as $productId => $quantity) {
            $product = \App\Models\Product::find($productId);

            if (!$product) continue;

            $price = $product->getPrice();
            $subtotal = $price * $quantity;

            $itemsData[] = [
                'product_id' => $productId,
                'price' => $price,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        if ($total === 0) {
            return redirect()->back()->with('error', __('cart.empty_or_invalid'));
        }

        $user = Auth::user();

        if ($user->balance < $total) {
            return redirect()->back()->with('error', __('profile.insufficient_balance'));
        }

        Order::validate($request);

        $order = \App\Models\Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'delivery_date' => $request->delivery_date,
        ]);

        foreach ($itemsData as $item) {
            \App\Models\Item::create([
                'product_id' => $item['product_id'],
                'order_id' => $order->id,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        $user->decreaseBalance($total);

        session()->forget('cart');

        return redirect()->route('order.index', $order->id)
            ->with('success', __('orders.create_success'));
    }


    public function index(int $id): View
    {
        $order = Order::with('items.product')->findOrFail($id);

        $viewData = [];
        $viewData['title'] = __('orders.summary');
        $viewData['subtitle'] = __('orders.completed_purchase');
        $viewData['order'] = $order;

        return view('order.index')->with('viewData', $viewData);
    }

    public function downloadPdf(int $id): Response
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);

        $viewData = [
            'title' => __('orders.summary'),
            'subtitle' => __('orders.success'),
            'order' => $order,
        ];

        $pdf = Pdf::loadView('order.pdf', ['viewData' => $viewData]);

        return $pdf->download('order_' . $order->id . '.pdf');
    }
}
