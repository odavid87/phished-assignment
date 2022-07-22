<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReply extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'reply_details' => 'required'
    ];

    protected $fillable = [
        'order_id',
        'reply_details',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
