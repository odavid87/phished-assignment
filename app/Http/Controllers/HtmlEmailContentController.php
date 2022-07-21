<?php

namespace App\Http\Controllers;

use App\Models\Order;

class HtmlEmailContentController extends Controller
{
    public function renderOrder($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.html_content', [
            'order' => $order
        ]);
    }
}
