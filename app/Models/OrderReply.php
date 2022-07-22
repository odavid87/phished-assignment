<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReply extends Model
{
    protected $fillable = [
        'order_id',
        'reply_details',
    ];
}
