<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Laracasts\Flash\Flash;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'orders' => Order::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', [
            'order' => $order
        ]);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (empty($order)) {
            \Flash::error('The order was not found');
            return redirect()->back();
        }
        $order->delete();

        \Flash::success('The order was deleted.');

        return redirect()->back();
    }
}
