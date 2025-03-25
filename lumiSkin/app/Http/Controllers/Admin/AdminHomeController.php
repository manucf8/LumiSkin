<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = __('admin.panel');

        return view('admin.home.index')->with('viewData', $viewData);
    }
}
