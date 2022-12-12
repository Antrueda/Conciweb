
<div class="card  m-3">
    <div class="card-header text-center">
        Datos del Contrato
    </div>
    <div class="card-body">
        @foreach ($data['contratoActual'] as $info)
              <div class="row">
                <div class="col-md-5">
                    <label class="form-group has-float-label">
                        <input class="form-control form-control" type="text" readonly value="{!! $info->razon_social !!} ">
                        <span>2) razon_social </span>
                    </label>
                </div>
                <div class="col-md-5">
                    <label class="form-group has-float-label">
                        <input class="form-control form-control" type="text" readonly value="{!! $info->tipo_orden_contrato !!}">
                        <span>3) tipo orden contrato </span>
                    </label>
                </div>
                <div class="col-md-2">
                    <label class="form-group has-float-label">
                        <input class="form-control form-control" type="text" readonly value="{!! $info->cuantia !!}">
                        <span>4) cuantia</span>
                    </label>
                </div>
            </div>
            <hr width="60%">
            <div class="row">
                <div class="col-md-12">
                    <label class="form-group has-float-label">
                        <textarea class="form-control form-control validate[required]" readonly>{!! $info->objeto !!}</textarea>
                        <span>5) objeto</span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-group has-float-label">
                        <input  class="form-control form-control" type="text" readonly value="{{ $info->fecha_inicio }}">
                        <span>6) fecha inicio</span>
                    </label>
                </div>
                <div class="col-md-6">
                    <label class="form-group has-float-label">
                        <input  class="form-control form-control" type="text" readonly value="{{  $info->fecha_final }}">
                        <span>7).fecha final</span>
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="card  m-3">
    <div class="card-header text-center">
        <div class="row">
            <div class="col-md-10">
                Informes del Contrato
            </div>
            <div class="col-md-2"> 
                <button type="button" 
                    class="btn btn-primary" 
                    onclick="registrarInforme('{{  $data['numContrato'] }}','{{  $data['vigenciaContrato'] }}','{{  $data['tipoContrato'] }}')" > 
                    + 
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" width="100%">
            <thead>
            <tr>
                <th># informe</th>
                <th>Contrato</th>
                <th>Vigencia</th>
                <th>Periodo inicial</th>
                <th>Periodo final</th>
                <th>Mes de presentación</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @php
                $numItems = count($data['informesPrevios']); $i = 0;
            @endphp
            @foreach ($data['informesPrevios'] as $info)

                <tr class="text-center">
                    <th scope="row"> {{$info->id_informe}}</th>
                    <td>{{$info->num_contrato}}</td>
                    <td>{{$info->vigencia}}</td>
                    <td>{{$info->per_ini_informe}}</td>
                    <td>{{$info->per_fin_informe}}</td>
                    <td>{{ $info->fechareg}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="editarInforme('{{$info->id_informe}}','{{$info->interno_oc}}','{{  $data['tipoContrato'] }}')"  data-toggle="tooltip" data-html="true" title="" data-original-title="<b><u>Editar Informe</u></b>">
                            <span class="fas fa-edit"> </span>
                        </button>&nbsp;&nbsp;
                        <a href="https://apps.personeriabogota.gov.co/info-actividades/imprimirInforme.php?interno_oc={{$info->interno_oc}}&id={{$info->id_informe}}"  target="_blank">
                            <button type="button" class="btn btn-info" style="color:White" data-toggle="tooltip" data-html="true" title="" data-original-title="<b><u>Imprimir Informe</u></b>">
                                <span class="fas fa-print"></span>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="respuesta"></div>
<div id="responseModal"></div>
<script>
    function editarInforme(idInforme,InternoOc,TipoContrato) {
        let dato = $('#contrato').val();
        $.ajax({
            url:'/ModalEdicionInformeV3',
            type:"POST",
            data: {idInforme:idInforme,InternoOc:InternoOc,codigoTransaccion:dato,TipoContrato:TipoContrato},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){llamarNotyCarga();},
            success:function(respuesta){
                Noty.closeAll();
                $("#responseModal").html(respuesta);
            },
        })
    }
    function registrarInforme(numContrato,vigenciaContrato,TipoContrato) {
        let dato = $('#contrato').val();
        $.ajax({
            url:'/ModalRegistroInformeV3',
            type:"POST",
            data: {numContrato:numContrato,vigenciaContrato:vigenciaContrato,TipoContrato:TipoContrato},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){llamarNotyCarga();},
            success:function(respuesta){
                Noty.closeAll();
                $("#responseModal").html(respuesta);
            },
        })
    }
</script>

