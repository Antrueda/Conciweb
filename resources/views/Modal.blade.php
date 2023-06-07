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
                font-family: 'Roboto Light', arial;
                background-repeat: no-repeat;
                background-attachment: fixed;
                width: 100%;
            }
            /* .btn-primary{
             background-color: #003e65;
                border-color:#003e65;
                color: white;
            } */

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
     <footer style="font-family: PublicSans-custom !important;
    position:fixed;
    z-index: 10;
    bottom: 0;
    width: 100%;
    background: #003E65;	
    color: #fff;
    font-weight: normal;
    font-size: 14px;
    text-align: center;
    line-height: 30px;	
    margin-left: auto;
    margin-right: auto;">© 2023 Copyright <img  src="{{asset('imagen/escBta.png')}}" alt="logo">Personería de Bogotá D.C.</footer>
 
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{asset('js/popoversController.js')}}"></script>
    


@yield('AddScriptFooter')



</html>

