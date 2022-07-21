<?php

namespace App\Services\OrderEmailFilter;

use Webklex\PHPIMAP\Message;

class SubjectIsOrder implements IOrderEmailFilter
{

    public function filter(Message $emailMessage): bool
    {
        return $emailMessage->getSubject()->toString() === 'Order details';
    }
}
