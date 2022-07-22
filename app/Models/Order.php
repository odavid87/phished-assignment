<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'order_details' => 'array'
    ];

    protected $fillable = [
        'customer_name',
        'customer_email',
        'message_id',
        'order_details',
    ];

    public function replies()
    {
        return $this->hasMany(OrderReply::class)->orderByDesc('created_at');
    }

    public function getIsRepliedAttribute() : bool
    {
        return $this->replies()->exists();
    }
}
