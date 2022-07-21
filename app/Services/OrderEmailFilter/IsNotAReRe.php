<?php

namespace App\Services\OrderEmailFilter;

use Webklex\PHPIMAP\Message;

class IsNotAReRe implements IOrderEmailFilter
{
    public function filter(Message $emailMessage): bool
    {
        return !\Str::contains($emailMessage->getRawBody(), config('reply.reply_mark', '[THIS_IS_OUR_REPLY]'));
    }
}
