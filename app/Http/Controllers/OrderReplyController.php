<?php

namespace App\Http\Controllers;

use App\Jobs\SendReplyEmail;
use App\Models\Order;

class OrderReplyController extends Controller
{
    public function sendReply($id)
    {
        $orderReply = Order::findOrFail($id)->replies()->create([
            'reply_details' => clean(request('reply_html'))
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
