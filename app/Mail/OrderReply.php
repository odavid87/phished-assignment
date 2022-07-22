<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderReply extends Mailable
{
    use Queueable, SerializesModels;

    private \App\Models\OrderReply $orderReply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Models\OrderReply $orderReply)
    {
        $this->orderReply = $orderReply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Re: Order details')
            ->view('emails.order_reply', [
                'orderReply' => $this->orderReply
            ])
            ->tag('order_reply')
            ->metadata('order_id', $this->orderReply->order_id);
    }
}
