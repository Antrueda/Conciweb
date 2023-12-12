<!doctype html>
@php header("content-type: text/html; charset=UTF-8");   @endphp
<html class="fixed" id="html_id">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="{{URL::asset('imagen/favicon.ico')}}">

        <title>@yield('title','Conciweb Admin')</title>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Conciweb - Conciliaciones en Línea">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" />

        <!-- <link rel="stylesheet" href="URL::asset('css/jquery.datetimepicker.css')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.2.5/jquery.datetimepicker.css" />
         -->
         {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
  
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <script src="https://kit.fontawesome.com/eb61c99899.js" crossorigin="anonymous"></script>
         <script src="https://unpkg.com/@popperjs/core@2"></script>
         <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css"/>
         <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
         
        <link rel="stylesheet" href="{{ asset ('css/main.css') }}">
        <link rel="stylesheet" type="text/css" 
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
       <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <link rel="stylesheet" href="{{URL::asset('css/validationEngine.jquery.css')}}" />
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.2/bootstrap-float-label.min.css"/>
        <!--
        <link rel="stylesheet" href="{{URL::asset('https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css')}}" />
        -->
        <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
        <link rel="stylesheet" href="{{asset('css/stepper.css')}}">
        <link rel="stylesheet" href="{{asset('css/button-file.css')}}">
        <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
        <link rel="stylesheet" href="{{ asset('css/base.css') }}">
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
        integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
      />
      <script
        src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
      ></script>
        {!! htmlScriptTagJsApi(['lang' => 'es']) !!}
        <style>
            .has-float-label {
                display: block;
                position: relative;
                font-size: larger;
                f
            }
            body {
                /*font-family: Avant Garde,Avantgarde,Century Gothic,CenturyGothic,AppleGothic,sans-serif; */
              /* padding: 30px;
              font-family: Arial; font-weight: regular;
              */
              padding-bottom: 35px;
              padding-top: 35px;
              src: url(/fuentes/PublicSans-VariableFont_wght.ttf);
              font-family: PublicSans-custom;
              background: -webkit-gradient(linear, 0% 5%, 0% 30%, from(#003E65), to(white));
              /* background: -webkit-linear-gradient(top, #0071BC, white); */
              background: -moz-linear-gradient(top, #003E65, white);
              background: -o-linear-background(top, #003E65, white);
              background: -ms-linear-background(top, #003E65, white);
              background: linear-background(top, #003E65, white);
              background-repeat: no-repeat;
              background-attachment: fixed;
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
            padding: 4px
        }
        .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    width: 100%;
    padding-right: 1.75rem;
    padding-left: 0.25rem;
    margin-right: auto;
    margin-left: auto;
}

        .navbar-expand-lg {
    flex-wrap: nowrap;
    border-radius: 0.45rem;
    justify-content: flex-start;
}

        </style>
        
    @yield('AddScritpHeader')
    {{-- @livewireStyles --}}
    </head>
    <body>
      {{-- <div class="container-fluid header">
        <div class="row">
            <div class="col-sm-2">
                <a href="https://www.personeriabogota.gov.co/" data-toggle="tooltip" data-placement="bottom" title="" style="text-decoration: none;" data-bs-original-title="Regresar al portal">
                    <img src="/imagen/Propuesta Conciweb-3 blanco.png" alt="Logo Personería de Bogotá" class="logo">
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
    </div> --}}

   


    <div class="container">
      <nav class="navbar navbar-light bg-white rounded-3 mb-3 shadow pb-3">
        <div class="container-fluid">
            <a class="navbar-brand col-12 col-md-3" href="https://www.personeriabogota.gov.co/" style="padding-left: 17px">
              <div class="row">

              </div>
              <img src="{{URL::asset('imagen/logoConciweb1.png')}}" class="rounded mx-auto d-block"  style="width: 100%; height: auto;">
            </a>
            <div class="col-md-6">
            
              <p class="mt-2" style="text-justify;color:#0171BD;font-weight:800;font-size:1.35rem">SOLICITUD DE CONCILIACIÓN</p>
          </div>
            <a class="navbar-brand" href="#"></a>
            @can('administrar-modulo')  
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown" style="    margin-left: 16px;">
   
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a href="{{ route('consultac.consultanum') }}" class="nav-link">
                    <i class="fas fa-file-excel"></i>Consulta
                </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('reportes.general') }}" class="nav-link">
                    <i class="fas fa-file-excel"></i> Reportes
                </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin') }}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear " viewBox="0 0 16 16">
                      <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"></path>
                      <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"></path>
                  </svg>
                  {{-- <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"> --}}
                     Administración  
                  </a>
  
                </li>
                <li class="nav-item">
                  <a href="{{ route('logout') }}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"></path>
                      <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"></path>
                    </svg>
                  {{-- <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"> --}}
                      Salir de Conciweb  
                  </a>
  
                </li>
              </ul>
            </div>
            @endcan
          </nav>
      
        </div>
  
        <div class="container">
          
      

            <div class="row">
                <div class="col-12">
                    <section class="content-body">
                        <br>
                        <div>
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">             <div class="col-md-4 text-right"></div></h5>
                              @yield('content')
                              
                            </div>
                          </div>
                        </div>
               
                        <br>
                    </section>
                </div>
            </div>
        </div>
 

    {{-- @livewireScripts --}}
    </body>
    <footer style="font-family: PublicSans-custom !important;
   background-color: #003E65 !important; */
    background: rgb(0,40,68);
    background: -moz-linear-gradient(90deg, rgba(0,40,68,1) 0%, rgba(0,45,76,1) 33%, rgba(33,97,140,0.9360119047619048) 50%, rgba(0,45,76,1) 65%, rgba(0,40,68,1) 100%);
    background: -webkit-linear-gradient(90deg, rgba(0,40,68,1) 0%, rgba(0,45,76,1) 33%, rgba(33,97,140,0.9360119047619048) 50%, rgba(0,45,76,1) 65%, rgba(0,40,68,1) 100%);
    background: linear-gradient(90deg, rgba(0,40,68,1) 0%, rgba(0,45,76,1) 33%, rgba(33,97,140,0.9360119047619048) 50%, rgba(0,45,76,1) 65%, rgba(0,40,68,1) 100%);
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 42px;
    color: white;
    /* font-size: 75%; */
    font-size: 0.73rem;
    font-weight: 500;
    display: flex;
    justify-content: center;
    align-items: center;
    letter-spacing: 0.093em;
    word-spacing: 0.12em;
    /* padding-top: 5px; */
    
    /* margin-top: 5px; */}">© 2023 Copyright <img  src="{{asset('imagen/escBta39.png')}}"  style="margin-right:22px; margin-left:22px;"  alt="logo">Personería de Bogotá D.C.</footer>
    {{-- <div class="text-center text-secondary" style="margin-top: -20px; font-size: 80%;">
      © 2022 Copyright:<img style="margin-right: 2px; margin-left: 7px;" src="imagen/escBta.png" alt=""> Personería de Bogotá D.C.
    </div> --}}
    {{-- <div class="container-fluid footer">
      <p>
          <a href="https://www.personeriabogota.gov.co/mecanismos-de-contacto-con-el-sujeto-obligado/proteccion-de-datos-personales/politicas-de-seguridad-de-la-informacion-del-sitio-web" title="Politicas de Seguridad de la información" alt="Link a Politicas de Seguridad de la información" target="_blank">
              Políticas de seguridad de la información del sitio WEB
          </a> --
          <a href="https://www.personeriabogota.gov.co/mecanismos-de-contacto-con-el-sujeto-obligado/proteccion-de-datos-personales/politica-de-proteccion-de-datos-personales" title="Politicas de tratamiento de datos personales" alt="Link a Politicas de tratamiento de datos personales" target="_blank">
              Política de tratamiento de datos personales
          </a>
      </p>
  </div> --}}
    <!-- auto complete oof-->
    <!-- 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="URL::asset('js/jquery.js')}}"></script> 
    -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- <script src="URL::asset('js/bootstrap.js')}}"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    {{-- <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
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
    
{{-- select2 scripts --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{asset('js/popoversController.js')}}"></script>

@yield('AddScriptFooter')



</html>

