<?php

namespace App\Jobs;

use App\Models\OrderReply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendReplyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private OrderReply $orderReply;

    public function __construct(OrderReply $orderReply)
    {
        $this->orderReply = $orderReply;
    }

    public function handle()
    {
        \Mail::to($this->orderReply->order->customer_email)->send(new \App\Mail\OrderReply($this->orderReply));
        \Log::info('Reply email was sent.', [
            'order_reply_id' => $this->orderReply->id,
            'order_id' => $this->orderReply->order_id,
        ]);
    }
}
