@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12 h1">
            Orders
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
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
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
                        <td class="td-actions text-right">
                            {!! Form::open(['route' => ['order.destroy', $order->id + 1], 'method' => 'delete']) !!}
                                <a href="{!! route('order.show', [$order->id]) !!}" class='btn btn-info'><i class="material-icons">person</i></a>
                                {!! Form::button('<i class="material-icons">delete</i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("'.__('Are you sure?').'")']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
