<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Phished assignment - David Orban</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body style="height: auto;">
    <div class="wrapper">
        @include('partials.menu')
        <div class="main-panel">
            <!-- Main content -->
            <section class="content">
                @foreach (session('flash_notification', collect())->toArray() as $message)
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert {{ $message['level'] == 'danger' ? 'alert-danger' : 'alert-success' }}" role="alert">{!! $message['message'] !!}</div>
                        </div>
                    </div>
                @endforeach
                {{ session()->forget('flash_notification') }}

                @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </section>
        </div>
    </div>

    @yield('scripts')
</body>

</html>
