<!doctype html>
<html class="fixed" id="html_id">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{URL::asset('imagen/GESUSR_SOLICITUD_APP
favicon.ico')}}">
    <title>@yield('title','Inicio')</title>
    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Conciweb - Conciliaciones en Línea">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}" />
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Roboto Light', arial;
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(white), to(black));
            background: -webkit-linear-gradient(top, #003E65, white);
            background: -moz-linear-gradient(top, #003E65, white);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        label{
            color: #95999c;
        }

    </style>
    @yield('AddScritpHeader')
</head>
<body>
<br>
<div class="container" style="background-color: white">
    <br>

    <div>
        <div class="row">
            <div class="col-12">
                <section class="content-body">
                    <br>
                    @yield('content')
                    <br>
                </section>
            </div>
        </div>
    </div>

</div>


</body>
<!-- auto complete oof-->
<script src="{{URL::asset('js/jquery.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.js')}}"></script>
<script src="{{URL::asset('js/local.js')}}"></script>

@yield('AddScriptFooter')



</html>