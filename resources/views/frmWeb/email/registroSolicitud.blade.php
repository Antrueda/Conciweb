<html>
<head>
    <meta charset="utf-8">
    <link href="http://allfont.es/allfont.css?fonts=roboto-light" rel="stylesheet" type="text/css" />
    <style>
        body {
            text-align: center;
            font-family: 'Roboto Light', arial;
        }
        .btn{display:inline-block;font-weight:400;color:#212529;text-align:center;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-color:transparent;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;line-height:1.5;border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out}
        .btn-primary{color:#fff;background-color:#007bff;border-color:#007bff}.btn-primary:hover{color:#fff;background-color:#0069d9;border-color:#0062cc}.btn-primary.focus,.btn-primary:focus{box-shadow:0 0 0 .2rem rgba(38,143,255,.5)}.btn-primary.disabled,.btn-primary:disabled{color:#fff;background-color:#007bff;border-color:#007bff}.btn-primary:not(:disabled):not(.disabled).active,.btn-primary:not(:disabled):not(.disabled):active,.show>.btn-primary.dropdown-toggle{color:#fff;background-color:#0062cc;border-color:#005cbf}.btn-primary:not(:disabled):not(.disabled).active:focus,.btn-primary:not(:disabled):not(.disabled):active:focus,.show>.btn-primary.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(38,143,255,.5)}.btn-secondary{color:#fff;background-color:#6c757d;border-color:#6c757d}
        .container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.container-fluid{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}.row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.no-gutters{margin-right:0;margin-left:0}.no-gutters>.col,.no-gutters>[class*=col-]{padding-right:0;padding-left:0}
        .text-secondary{color:#6c757d!important}
    </style>
</head>
<body>
<div class="container center">

    <h4>Cordial saludo.
        <br><br>
        La Personería de Bogotá informa que usted el día {{$fechaRegistro}}, realizó una solicitud para el trámite de conciliación,  el cual quedo registrado con el número radicado <b style="color: red">{{ $numSolicitud }}</b>
    </h4>
    <hr>
    <span class="text-secondary">El siguiente codigo le servira para ingresar y adjuntar los archivos correspondientes a su solicitud.      {{$llaveingreso}} </span>
    <br>
    <a href="{{ route('search') }} ">Actualizar Datos</a>
    <br>
    <hr>
    <h6 class="text-secondary">Línea de Atención 24 horas Teléfono: 143 o Teléfono: (601) 3820450/80. -
        <a href="https://www.personeriabogota.gov.co">Portal Web</a>  
    </h6>
    <center><img src="{{URL::asset('imagen/logo-personeria-azul.png')}}" class="rounded mx-auto d-block" width="20%"></center>
</div>

</body>
</html>

