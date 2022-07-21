@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12 h1">
            Order - #{{$order->id}}
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center">#id</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Reply sent</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">{{$order->id}}</td>
                        <td>{{$order->customer_name}}</td>
                        <td>{{$order->customer_email}}</td>
                        <td>
                            @if($order->is_replied)
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            @else
                                <i class="fas fa-times-circle fa-2x text-danger"></i>
                            @endif
                        </td>
                        <td>{{$order->created_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card m-0">
                <div class="card-header card-header-success">
                    <h4 class="card-title">HTML</h4>
                </div>
                <div class="card-body">
                    {!! clean($order->order_details['html']) !!}
{{-- I was experimenting with an iframe solution to avoid styling conflicts between the templates css and email's style. I did not like it. --}}
{{--                    <iframe src="{!! route('order.html', $order) !!}" frameborder="0" style="width: 100%; min-height: 300px;"></iframe>--}}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card m-0">
                <div class="card-header card-header-info">
                    <h4 class="card-title">Text</h4>
                </div>
                <div class="card-body">
                    <textarea class="form-control">{{$order->order_details['text']}}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3>Reply</h3>
        </div>
    </div>

</div>
@endsection
