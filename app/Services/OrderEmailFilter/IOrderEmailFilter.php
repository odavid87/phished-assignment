<?php

namespace App\Services\OrderEmailFilter;

use Webklex\PHPIMAP\Message;

interface IOrderEmailFilter
{
    public function filter(Message $emailMessage) : bool;
}
