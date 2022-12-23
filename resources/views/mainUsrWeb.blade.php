<!doctype html>
@php header("content-type: text/html; charset=UTF-8");   @endphp
<html class="fixed" id="html_id">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="{{URL::asset('imagen/favicon.ico')}}">

        <title>@yield('title','Inicio')</title>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Porto Admin - Responsive HTML5 Template">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- <link rel="stylesheet" href="URL::asset('css/bootstrap.css')}}" /> -->
        <!-- <link rel="stylesheet" href="URL::asset('css/bootstrap.css')}}" /> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" />

        <!-- <link rel="stylesheet" href="URL::asset('css/jquery.datetimepicker.css')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.2.5/jquery.datetimepicker.css" />
         -->
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
         <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
         <script src="https://unpkg.com/@popperjs/core@2"></script>
         <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
         
        <link rel="stylesheet" href="{{ asset ('css/main.css') }}">
        <link rel="stylesheet" type="text/css" 
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
       <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <link rel="stylesheet" href="{{URL::asset('css/validationEngine.jquery.css')}}" />
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.2/bootstrap-float-label.min.css"/>
        <!--
        <link rel="stylesheet" href="{{URL::asset('https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css')}}" />
        -->
        <style>
            .has-float-label {
                display: block;
                position: relative;
                font-size: larger;
                f
            }
            body {
                /*font-family: Avant Garde,Avantgarde,Century Gothic,CenturyGothic,AppleGothic,sans-serif; */
                font-family: Arial; font-weight: regular;
                background-repeat: no-repeat;
                background-attachment: fixed;
                width: 100%;
            }
            .btn-perso{
             background-color: #003e65;
                border-color:#003e65;
                color: white;
            }
            .form-label {
             margin-bottom: 1.5rem;
            }

            element.style {
              margin-bottom: 40px;
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0,0,0,.125);
            border-radius: 0.45rem;
        }
          

        </style>
    @yield('AddScritpHeader')

    </head>
    <body>
      <div class="container-fluid header">
        <div class="row">
            <div class="col-sm-2">
                <a href="https://www.personeriabogota.gov.co/" data-toggle="tooltip" data-placement="bottom" title="" style="text-decoration: none;" data-bs-original-title="Regresar al portal">
                    <img src="/imagen/logo5.png" alt="Logo Personería de Bogotá" class="logo">
                </a>
            </div>
            <div class="col-sm-5">
            </div>
            <div class="col-sm-5 text-end align-middle">
                <a href="https://www.personeriabogota.gov.co/" data-toggle="tooltip" data-placement="bottom" title="" class="regreso-portal" data-bs-original-title="Regresar al portal">
                    Regresar al portal
                </a>
            </div>
        </div>
        <img src="/imagen/menu-after-05.png" alt="Colores bandera Bogotá" class="bandera">
    </div>

        @can('administrar-modulo')
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a href="{{ route('gestion') }}" class="nav-link">
                    <p>Gestión</p>
                </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Administración
                  </a>
                  <div class="dropdown-menu">
                    @can('tema-leer')
                    <a href="{{ route('tema') }}" class="nav-link">
                        <p>Tema</p>
                    </a>
                    @endcan
                    @can('parametro-leer')
                    <a href="{{ route('parametro') }}" class="nav-link">
                           <p>Par&aacute;metro</p>
                    </a>
                    @endcan
                    @can('textosadmin-modulo')
                    <a href="{{ route('textos') }}" class="nav-link">
                        <p>Textos</p>
                      @endcan
                  </a>

                  @can('asuntomodulo-modulo')
                  <a href="{{ route('asuntomodulo') }}" class="nav-link">
 
                      <p>Asuntos</p>
                  </a>
                  @endcan
                  @can('rolesxxx-leer')
                    <a href="{{ route('rolesxxx')}}" class="nav-link">
                          <i class="fas fa-user-lock nav-icon"></i>
                          <p>Roles</p>
                      </a>
                    @endcan
                    @can('usuario-leer')
                    <a href="{{ route('usuario')}}" class="nav-link">
                            <i class="fa fa-users nav-icon"></i>
                            <p>Usuarios</p>
                    </a>

                    @endcan
           
                    
                  </div>
                </li>
              </ul>
            </div>
          </nav>
          @endcan
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
    <div class="container-fluid footer">
      <p>
          <a href="https://www.personeriabogota.gov.co/mecanismos-de-contacto-con-el-sujeto-obligado/proteccion-de-datos-personales/politicas-de-seguridad-de-la-informacion-del-sitio-web" title="Politicas de Seguridad de la información" alt="Link a Politicas de Seguridad de la información" target="_blank">
              Políticas de seguridad de la información del sitio WEB
          </a> --
          <a href="https://www.personeriabogota.gov.co/mecanismos-de-contacto-con-el-sujeto-obligado/proteccion-de-datos-personales/politica-de-proteccion-de-datos-personales" title="Politicas de tratamiento de datos personales" alt="Link a Politicas de tratamiento de datos personales" target="_blank">
              Política de tratamiento de datos personales
          </a>
      </p>
  </div>
    <!-- auto complete oof-->
    <!-- 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="URL::asset('js/jquery.js')}}"></script> 
    -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <!-- <script src="URL::asset('js/bootstrap.js')}}"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- <script src="URL::asset('js/notyJs.js')}}"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.js"></script>
    <!-- <script src="URL::asset('js/jquery.datetimepicker.js')}}"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.2.5/jquery.datetimepicker.js"></script>
    <script src="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js')}}"></script>
    -->
    <script src="{{URL::asset('js/jquery.validationEngine.js')}}"></script>
    <script src="{{URL::asset('js/jquery.validationEngine-es.js')}}"></script>

    <script src="{{URL::asset('https://unpkg.com/@popperjs/core@2')}}"></script>
    <script src="{{URL::asset('js/local.js')}}"></script>
    {{-- <script src="{{URL::asset('js/jquery.validate.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    


@yield('AddScriptFooter')
<script>
    @if(Session::has('message'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
          toastr.success("{{ session('message') }}");
    @endif
  
    @if(Session::has('error'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
          toastr.error("{{ session('error') }}");
    @endif
  
    @if(Session::has('info'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
          toastr.info("{{ session('info') }}");
    @endif
  
    @if(Session::has('warning'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
          toastr.warning("{{ session('warning') }}");
    @endif
  </script>


</html>

