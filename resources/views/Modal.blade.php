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
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" />

        <!-- <link rel="stylesheet" href="URL::asset('css/jquery.datetimepicker.css')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.2.5/jquery.datetimepicker.css" />
         -->
         {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
  
         <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
         <script src="https://kit.fontawesome.com/eb61c99899.js" crossorigin="anonymous"></script>
         <script src="https://unpkg.com/@popperjs/core@2"></script>
         <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
         
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

    </head>
    <body>
    
    <br>

    <div class="container" style="background-color: white">
        <br>

        <div>
         
                <div class="col-12">
                    <section class="content-body">
                        <br>
                            @yield('content')
                        <br>
                    </section>
                </div>

        </div>
    </div>

    </body>


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

