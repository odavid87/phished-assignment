<?php

namespace App\Http\Requests;

use App\Models\OrderReply;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderReply extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return OrderReply::$rules;
    }
}
