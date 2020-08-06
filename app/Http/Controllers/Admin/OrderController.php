<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 1)->paginate(30);
        return view('admin.orders.index', ['orders'=>$orders]);
    }
    public function show(Order $order)
    {
        $skus = $order->withTrashed()->get();
        return view('admin.orders.show', compact('order', 'skus'));
    }
}
