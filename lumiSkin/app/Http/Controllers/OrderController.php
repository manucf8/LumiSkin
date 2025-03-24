<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;


class OrderController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', __('cart.empty'));
        }

        $total = Product::calculateTotal($cart);

        Order::validate($request);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'delivery_date' => $request->delivery_date,
        ]);

        foreach ($cart as $productId => $details) {
            Item::create([
                'product_id' => $productId,
                'order_id' => $order->id,
                'price' => $details['price'],
                'quantity' => $details['quantity'],
                'subtotal' => $details['price'] * $details['quantity'],
            ]);
        }

        $user = Auth::user();

        if ($user->balance < $total) {
            return redirect()->back()->with('error', __('profile.insufficient_balance'));
        }

        $user->decreaseBalance($total);

        session()->forget('cart');
        session()->forget('cart_total');
        session()->forget('cart_quantity');

        return redirect()->route('order.index', $order->id)
            ->with('success', __('orders.create_success'));
    }

    public function index($id): View
    {
        $order = Order::with('items.product')->findOrFail($id);

        $viewData = [];
        $viewData['title'] = __('orders.summary');
        $viewData['subtitle'] = __('orders.completed_purchase');
        $viewData['order'] = $order;

        return view('order.index')->with('viewData', $viewData);
    }

    public function downloadPdf($id): Response
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
