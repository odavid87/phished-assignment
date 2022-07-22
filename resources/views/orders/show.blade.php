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
    @if($order->is_replied)
    <div class="card">
        <div class="card-body">
            <a id="reply"></a>
            <h3 class="mb-3">Your previous replies</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>#id</th>
                        <th>Email</th>
                        <th>Reply sent at</th>
                        <th>Preview</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->replies as $orderReply)
                        <tr>
                            <td>{{$orderReply->id}}</td>
                            <td>{{$order->customer_email}}</td>
                            <td>{{$orderReply->created_at}}</td>
                            <td>
                                <a href="{!! route('order.reply.preview', $orderReply) !!}" target="_blank">Preview</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <a id="reply"></a>
            <h3 class="mb-3">Reply</h3>
            {!! Form::open(['route' => ['order.reply', $order->id], 'method' => 'post']) !!}
                <div id="editor"></div>
                <input type="hidden" name="reply_html" id="reply_html">
                <button class="btn btn-success mt-4">Send</button>
            {!! Form::close() !!}
        </div>
    </div>

</div>
@endsection
@section('styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-editor{
            min-height:200px;
        }
    </style>
@append
@section('scripts')
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            var quill = new Quill('#editor', {
                theme: 'snow'
            });

            var form = document.querySelector("form");
            var hiddenInput = document.querySelector('#reply_html');

            form.addEventListener('submit', function(e){
                hiddenInput.value = quill.root.innerHTML;
            });
        });
    </script>
@append
