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
            {{$order}}
        </div>
    </div>
</div>
@endsection
