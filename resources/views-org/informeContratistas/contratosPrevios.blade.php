
@extends('mainSinproc')

@section('title','REGISTRO DE CIUDADANO')

@section('AddScritpHeader')

@endsection

@section('content')
    <label>1) Seleccione el contrato y vigencia a diligenciar</label>
    <select class="form-control" name="contrato" id="contrato">
        <option value=" " >Selecione una opcion</option>
        @foreach ($data['contratosPrevios'] as $info)
            <option value="{{$info->num_contrato}}_@@_{{$info->vigencia}}_@@_{{$info->tipo}}">Contrato: {{$info->num_contrato}} del {{$info->vigencia}}</option>
        @endforeach
    </select>

    <div id="respuesta"></div>

@endsection

@section('AddScriptFooter')
    <script>
    $("#contrato").change(function() {

        $.ajax({
            type: "POST",
            url: "/datosContratoSeleccionado",
            data:{ contrato: $(this).val() },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){llamarNotyCarga();},
            success: function(r){
                llamarNotyTime('succes',' ','topRight',2000);
                $("#respuesta").html(r);
            }
        });
    });
    </script>
@endsection
