<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'My Profile';
        $viewData['subtitle'] = 'Profile details';
        $viewData['user'] = Auth::user();
        $viewData['orders'] = Order::where('user_id', Auth::id())->get();

        return view('profile.index')->with('viewData', $viewData);
    }

    public function increaseBalance(Request $request): RedirectResponse
    {

        $user = Auth::user();
        $user->increaseBalance($request->amount);

        return redirect()->route('profile.index')->with('success', 'Balance updated successfully!');
    }
}
