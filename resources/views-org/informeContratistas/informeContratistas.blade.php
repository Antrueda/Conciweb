
@extends('mainSinproc')

@section('title','REGISTRO DE CIUDADANO')

@section('AddScritpHeader')

@endsection

@section('content')


    <div style="position:fixed; left:-10px; display:block; z-index:99999;" onClick="irAprincipal()">
        <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Volver a Principal"><span class="fas fa-home fa-lg"></span></button>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" onclick="registroInforme()" data-toggle="tooltip" data-html="true" title="" data-original-title="<b><u>Crear Informe </u></b>">
                CREAR NUEVO INFORME <span class="fas fa-cloud-upload-alt"> </span>
            </button>
        </div>
    </div> <br>
    <table  class="table table-bordered table-striped" width="100%">
        <thead>
        <tr>
            <th># informe</th>
            <th>Contrato</th>
            <th>Vigencia</th>
            <th>Periodo inicial</th>
            <th>Periodo final</th>
            <th>Mes de presentación</th>
            <th>Acciones</th>
        </tr>$contratosPrevios
        </thead>
        <tbody>
        @php
            $numItems = count($data['contratosPrevios']); $i = 0;
        @endphp
        @foreach ($data['contratosPrevios'] as $info)


            <tr class="text-center">
                <th scope="row"> {{$info->id_informe}}</th>
                <td>{{$info->num_contrato}}</td>
                <td>{{$info->vigencia}}</td>
                <td>{{$info->per_ini_informe}}</td>
                <td>{{$info->per_fin_informe}}</td>
                <td>{{ $info->fechareg}}</td>
                <td>
                    @if( $data['mesActual'] === $info->fecharegmes)
                        <!--  //++$i === $numItems -->

                    <button type="button" class="btn btn-primary" onclick="editarInforme('{{$info->id_informe}}','{{$info->interno_oc}}','{{$info->num_contrato}}')"  data-toggle="tooltip" data-html="true" title="" data-original-title="<b><u>Editar Informe</u></b>">
                        <span class="fas fa-edit"> </span>
                    </button>&nbsp;&nbsp;
                    @endif
                    <a href="https://apps.personeriabogota.gov.co/info-actividades/imprimirInforme.php?interno_oc={{$info->interno_oc}}&id={{$info->id_informe}}">
                        <button type="button" class="btn btn-info" style="color:White" data-toggle="tooltip" data-html="true" title="" data-original-title="<b><u>Imprimir Informe</u></b>">
                        <span class="fas fa-print"></span>
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div id="responseModal"></div>


@endsection

@section('AddScriptFooter')
<script>
    function disableEnterKey(e){
        var key;
        if(window.event){ key = window.event.keyCode;  }else{ key = e.which; }
        if(key==13){ return false; }else{ return true; }
    }

    function irAprincipal(){
        location.href ="https://apps.personeriabogota.gov.co/sinproc/menuBootstrap.php";
    }

    function editarInforme(idInforme,InternoOc,numContrato) {
        $.ajax({
            url:'/ModalEdicionInforme',
            type:"POST",
            data: {idInforme:idInforme,InternoOc:InternoOc,numContrato:numContrato},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){llamarNotyCarga();},
            success:function(respuesta){
                Noty.closeAll();
                $("#responseModal").html(respuesta);
            },
        })
    }

    function registroInforme(dato){
        $.ajax({
            url:'/ModalRegistroInforme',
            type:"POST",
            data: {codigoTransaccion:dato},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){llamarNotyCarga();},
            success:function(respuesta){
                Noty.closeAll();
                $("#responseModal").html(respuesta);
            },
        })
    }
</script>

@endsection
