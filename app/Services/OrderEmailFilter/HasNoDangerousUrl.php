<?php

namespace App\Services\OrderEmailFilter;

use Webklex\PHPIMAP\Message;

class HasNoDangerousUrl implements IOrderEmailFilter
{
    public function filter(Message $emailMessage): bool
    {
        // TODO implement https://developers.google.com/safe-browsing/v4
        return true;
    }
}
