<!doctype html>
<html class="fixed" id="html_id">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="{{URL::asset('imagen/favicon.ico')}}">

        <title>@yield('title','Inicio')</title>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Conciweb - Conciliaciones en Línea">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- <link rel="stylesheet" href="URL::asset('css/bootstrap.css')}}" /> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="URL::asset('css/notyJs.css')}}" >-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" />
        <!-- <link rel="stylesheet" href="URL::asset('css/jquery.datetimepicker.css')}}" /> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.2.5/jquery.datetimepicker.css" />
        <link rel="stylesheet" href="{{URL::asset('css/validationEngine.jquery.css')}}" />
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.2/bootstrap-float-label.min.css"/>
        <link rel="stylesheet" href="{{URL::asset('https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css')}}" />
        <style>


            body {
                font-family: 'Roboto Light', arial;
                background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(white), to(black));
                background: -webkit-linear-gradient(top, #003E65, white);
                background: -moz-linear-gradient(top, #003E65, white);
                background-repeat: no-repeat;
                background-attachment: fixed;
            }
            .btn-primary{
             background-color: #003e65;
                border-color:#003e65;
                color: white;
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
        <div class="card">
            <div class="card-header" id="headingOne">
                <div class="row">
                    <div class="col-md-2 text-right">
                        <img src="{{URL::asset('imagen/iconoSinproc200.png')}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-7 text-center">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" style="color: black;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <b> <img src="{{URL::asset('imagen/unserInfo.svg')}}" width="30px" height="30px">&nbsp;&nbsp; {!! Session::get('nombreUsuario'); !!}</b>
                                </a>
                                <div class="dropdown-menu rounded" aria-labelledby="navbarDropdown">
                                    <small>
                                        <a class="dropdown-item" href="#"><img src="{{URL::asset('imagen/depend2.svg')}}" width="30px" height="30px"> -&nbsp;&nbsp; <strong>{!! Session::get('EntidadUsuario'); !!} - ( {!! Session::get('idEntidadUsuario') !!} )</strong></a>
                                        <a class="dropdown-item" href="#"><img src="{{URL::asset('imagen/email.svg')}}" width="30px" height="30px"> -&nbsp;&nbsp; <strong>{!! Session::get('emailUsuario'); !!}</strong></a>
                                    </small>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h5><span class="badge badge-danger">
                            <a class="nav-link" onClick="salirDelSistema()" style="color: #FFFFff;"><b> <i class="fas fa-running"></i> - Salir del Sistema</b></a>
                            </span></h5>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
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

         <!--<div class="card-footer text-muted">
            <small>
            <ul class="list-group list-group-horizontal-sm">
               
                <li class="list-group-item">UNP <small class="text-muted"> V 1.1 </small></li>
                <li class="list-group-item">Bootstrap <small class="text-muted"> V 4.3 </small></li>
                <li class="list-group-item">Jquery <small class="text-muted"> V 3.4.1 </small></li>
                <li class="list-group-item">Laravel <small class="text-muted"> V 5.8.* </small></li>
                
            </ul></small>
        </div>-->
    </div>

    </body>
    <!-- auto complete oof-->
    <!-- <script src="URL::asset('js/popper.min.js')}}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- <script src="URL::asset('js/jquery.js')}}"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="URL::asset('js/bootstrap.js')}}"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- <script src="URL::asset('js/notyJs.js')}}"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.js"></script>
    <!-- <script src="URL::asset('js/jquery.datetimepicker.js')}}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.2.5/jquery.datetimepicker.js"></script>
    <script src="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery.validationEngine.js')}}"></script>
    <script src="{{URL::asset('js/jquery.validationEngine-es.js')}}"></script>
    <script src="{{URL::asset('js/local.js')}}"></script>
    <script type="text/javascript">
        function salirDelSistema(){
            window.location='{{ url("conciliaciones/exitSystem") }}';
            //location.href ="https://apps.personeriabogota.gov.co/sinproc/config/cerrar_session.php";
        }
    </script>


@yield('AddScriptFooter')



</html>

