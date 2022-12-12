
@extends('../mainSinproc')

@section('title','DATOS DEL DE CIUDADANO')

@section('AddScritpHeader')

@endsection

@section('content')

    <center>
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary" onclick="functionOpenModal('nuevaConciliacion','000')">
                    <i class="far fa-address-book" width="30px" height="30px"></i> &nbsp;&nbsp;Registrar una nueva conciliación
                </button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary" onclick="functionOpenModal('tramitesActivos','000')">
                    <i class="fas fa-eye" width="30px" height="30px"></i> &nbsp;&nbsp;Lista de conciliaciones activas en la sede
                </button>
            </div>
        </div>

        <hr class="text-primary">

        <div class="card">
            <div class="card-header">
                CONSULTAR Y COMPLEMENTAR DATOS DE LA CONCILIACIÓN
                <span class="fas fa-info-circle" data-toggle="tooltip"  data-html="true" data-placement="right" title="
                    <p class='text-justify'>
                      1. <u>SINPROC</u> -> Consulta por medio del número generado por el sistema al momento de registrar una nueva conciliación<br>
                      2. <u>NÚMERO CASO</u> -> Consulta por medio del número de folio interno de la sede (No requiere adicionar las iniciales de la sede solo el número interno según secuencia de la sede.)<br>
                      3. <u>NÚMERO SICAAC</u> -> Consulta por medio del número registrado en SICAAC (Este número solo será creado al finalizar y enviar todas las etapas por Ws)</p>">
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <label class="nombre-casilla">SINPROC</label>
                        <input name="numSinproc" id="numSinproc" type="text" class="form-control" autocomplete="off"><br>
                    </div>
                    <div class="col-md-3">
                        <label class="nombre-casilla">NÚMERO CASO</label>
                        <input name="numCaso" id="numCaso" type="text" class="form-control" autocomplete="off"><br>
                        <button class="btn btn-primary btn-block" onclick="cons()"> Consultar trámite</button>
                    </div>
                    <div class="col-md-3">
                        <label class="nombre-casilla">NÚMERO SICAAC</label>
                        <input name="numSicaac" id="numSicaac" type="text" class="form-control" autocomplete="off"><br>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <br>

                <div id="modalRespuesta"></div>
                <div id="respuestaConsulta"></div>

            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header text-left">
                <center>REPORTES DE LA SEDE</center>
            </div>
            <div class="card-body">
                <div class="row" id="contenedorReporte">
                    <div class="col-md-3 container-border">
                        <label class="form-group has-float-label">
                            <input class="form-control form-control-sm validate[required]" type="text" name="fecInicio" id="fecInicio"   autocomplete="off">
                            <span> 1) Fecha inicial *</span>
                        </label>
                    </div>
                    <div class="col-md-3 container-border" >
                        <label class="form-group has-float-label">
                            <input class="form-control form-control-sm validate[required]" type="text" name="fecFin" id="fecFin"   autocomplete="off">
                            <span> 2) Fecha final *</span>
                        </label>
                    </div>
                    <div class="col-md-3 container-border">
                        <label class="form-group has-float-label">
                        <select class="validate[required] form-control" id="tipoReporte" name="tipoReporte"  autocomplete="off">
                            <option value="">SELECCIONE UNA OPCION</option>
                            <option value="0">CONCILIACIONES FINALIZADAS</option>
                            <option value="1">CONCILIACIONES ACTIVAS</option>
                            <option value="2">CONCILIACIONES REGISTRADAS</option>
                        </select>
                            <span> 3) Tipo reporte *</span>
                        </label>
                    </div>
                    <div class="col-md-3 container-border" data-toggle="tooltip" data-html="true" title="ACTA DE CIERRE">
                        <span class="btn btn-primary btn-block" onclick="llamadoReporte()">
                         <i class="far fa-file-pdf fa-1x" ></i> GENERAR REPORTE
                        </span>
                    </div>
                </div>
                <div id="resultadoReporte" style="display: none">
                    <a href="{{URL::asset('reporteConciliaciones.xlsx')}}"><img src="{{URL::asset('imagen/excel.svg')}}" width="5%"></a>
                </div>

            </div>
        </div>

    </center>

@endsection

@section('AddScriptFooter')

<script>

    function functionOpenModal(url,sinproc){
        $.ajax({
            url:url,
            type:"POST",
            data:{sinproc:sinproc},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){
                llamarNotyCarga();
            },
            success:function(respuesta){
                var type='info';
                var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p>Modulo Listo para su uso</center>";
                var layout='topRight';
                llamarNotyTime(type,msg,layout,500);
                $("#modalRespuesta").html(respuesta);
            },
            error: function(jqXHR, textStatus, errorThrown){    alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest); }
        })
    }

    function cons(dato){

        var dato=0;
        var numSinproc=document.getElementById("numSinproc").value;
        var numCaso=document.getElementById("numCaso").value;
        var numSicaac=document.getElementById("numSicaac").value;

        if(numSinproc!=''){
            dato=1;
            var numCaso=document.getElementById("numSinproc").value;
        }else if(numCaso!=''){
            dato=2;
            var numCaso=document.getElementById("numCaso").value;
        }else if(numSicaac!=''){
            dato=3;
            var numCaso=document.getElementById("numSicaac").value;
        }

        $.ajax({
            type: "POST",
            url: "consultaTramite",
            data: {numCaso: numCaso, validador: dato},
            dataType: "text",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function () {
                llamarNotyCarga();
            },
            success: function (respuesta) {
                var type='info';
                var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p>Modulo Listo para su uso</center>";
                var layout='topRight';
                llamarNotyTime(type,msg,layout,500)
                $("#respuestaConsulta").html(respuesta);
            },
            error: function(jqXHR, textStatus, errorThrown){    alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest); }
        });
    }
    $('#fecInicio').datetimepicker({
        startDate:	'+1970/01/01',
        lang:'es',
        format:'d/m/Y', //format:'d/m/Y H:i',
        maxDate:0, // Bloquea días futuros
        timepickerScrollbar:false,
        timepicker:false,
        closeOnDateSelect: true
    });
    $('#fecFin').datetimepicker({
        startDate:	'+1970/01/01',
        lang:'es',
        format:'d/m/Y', //format:'d/m/Y H:i',
        maxDate:0, // Bloquea días futuros
        timepickerScrollbar:false,
        timepicker:false,
        closeOnDateSelect: true,

    });
    function llamadoReporte(){
        var fechaInicial=$("#fecInicio").val();
        var fechaFinal=$("#fecFin").val();
        var tipoReporte=$("#tipoReporte").val();

        if(fechaInicial == '' || fechaFinal== ''|| tipoReporte== ''){
            var msg='<center><i class="fas fa-exclamation-circle fa-w-16 fa-5x"></i><br>Los campos Fecha inicial, Fecha finaly tipo de reporte son obligatorios</center>';
            var type='info';
            var layout='topRight';
            llamarNotyBasic(type,msg,layout);
            return;
        }

        $.ajax({
            type: "POST",
            url: "generarReporte",
            data: {fechaInicial: fechaInicial, fechaFinal: fechaFinal,tipoReporte:tipoReporte },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function () {llamarNotyCarga();  $("#resultadoReporte").hide(); },
            success: function () {
                $("#resultadoReporte").show();
                var type='info';
                var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p>Modulo Listo para su uso</center>";
                var layout='topRight';
                llamarNotyTime(type,msg,layout,500);
            },
            error: function(jqXHR, textStatus, errorThrown){ alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest); }
        });



    }
</script>
@endsection