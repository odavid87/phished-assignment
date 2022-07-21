<?php

namespace App\Services\OrderEmailFilter;

use Webklex\PHPIMAP\Message;

class FilterChain implements IOrderEmailFilter
{

    public function filter(Message $emailMessage): bool
    {
        $chain = [
            SubjectIsOrder::class,
            IsNotAReRe::class,
            HasNoDangerousUrl::class
        ];
        foreach ($chain as $filterClass) {
            $filter = new $filterClass();
            if (!$filter->filter($emailMessage)) {
                return false;
            }
        }
        return true;
    }
}
