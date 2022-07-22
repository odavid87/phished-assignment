<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderReply;
use App\Jobs\SendReplyEmail;
use App\Models\Order;

class OrderReplyController extends Controller
{
    public function sendReply(CreateOrderReply $request, $id)
    {
        $orderReply = Order::findOrFail($id)->replies()->create([
            'reply_details' => clean(request('reply_details'))
        ]);
        SendReplyEmail::dispatch($orderReply);

        \Flash::success('Your reply will be sent soon.');
        return redirect()->back();
    }

    public function preview($id)
    {
        return new \App\Mail\OrderReply(\App\Models\OrderReply::findOrFail($id));
    }
}
