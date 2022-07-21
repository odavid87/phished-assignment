<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\OrderEmailFilter\IOrderEmailFilter;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Webklex\IMAP\Facades\Client;
use Webklex\PHPIMAP\Message;

class OrderEmailFetcher implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private IOrderEmailFilter $filter;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(IOrderEmailFilter $filter)
    {
        $this->filter = $filter;
        $this->fetchMessagesOfLast24h()
            ->filter(fn(Message $emailMessage) => $this->filter->filter($emailMessage))
            ->each(fn(Message $emailMessage) => $this->createOrderFromEmailMessage($emailMessage));
    }

    private function fetchMessagesOfLast24h()
    {
        $client = Client::account('default');
        $client->connect();
        $since = Carbon::now()->subDays(1);
        return $client->getFolder("INBOX")->messages()->since($since)->get();
    }

    private function createOrderFromEmailMessage(Message $emailMessage)
    {
        $attributes = $emailMessage->getAttributes();
        Order::insertOrIgnore([
            'customer_name' => $attributes['from']->first()->personal,
            'customer_email' => $attributes['from']->first()->mail,
            'message_id' => \Str::limit($attributes['message_id']->first(), 255, ''),
            'order_details' => json_encode([
                'text' => $emailMessage->getTextBody(),
                'html' => $emailMessage->getHTMLBody()
            ]),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
