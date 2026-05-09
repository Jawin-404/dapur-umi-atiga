<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class AdminOrderController extends Controller
{
    public function index()
{
    $orders = Order::latest()->get();
    return view('admin.order.index', compact('orders'));
}
public function konfirmasi($id)
{
    $order = Order::findOrFail($id);
    $order->update(['status' => 'dikonfirmasi']);

    return back();
}
public function tolak($id)
{
    $order = Order::findOrFail($id);
    $order->update(['status' => 'ditolak']);

    return back();
}
}
