
@extends('main')

@section('title','DATOS DEL DE CIUDADANO')

@section('AddScritpHeader')

@endsection

@section('content')

    <?php $i=1; ?>
    <center>
        <div class="card mb-4" style="max-width: 550px;">
            <div class="row no-gutters">
                <div class="col-md-3 center">
                    <i class="fas fa-user-check fa-9x" style="position:relative; top:6px; left:12px"></i>
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        @foreach ($data['datosCiudadano'] as $info)
                        <h5 class="card-title">CC:{!! $info->cedula !!}</h5>
                        <p class="card-text">Nombre del ciudadano:<br>{!! $info->nombre !!} {!! $info->apellido !!}</p>
                        <p class="card-text">Fecha y hora de La Consulta:{!! date('Y-m-d H:i:s'); !!}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </center>

    <a href="system/login/validarLogingeneratePDF"><img src="{{URL::asset('imagen/pdf.svg')}}" width="5%" class="img-fluid" alt=""></a>

    <table class="table table-striped table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="2%">Nº</th>
            <th width="8%">SINPROC</th>
            <th width="10%">FECHA CREACION</th>
            <th width="8%">VIGENCIA</th>
            <th width="25%">TIPO TRAMITE</th>
            <th width="37%">OBJETO / MOTIVO</th>
            <th width="10%">ESTADO</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Nº</th>
            <th>SINPROC</th>
            <th>FECHA CREACION</th>
            <th>VIGENCIA</th>
            <th>TIPO TRAMITE</th>
            <th>OBJETO / MOTIVO</th>
            <th>ESTADO</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach ($data['registrosCiudadano'] as $info)
            <tr class="text-left" >
                <td><?php echo $i; $i++; ?></td>
                <td class="text-justify">{!! $info->num_solicitud !!}</td>
                <td class="text-center">{!! date("d/m/Y", strtotime($info->fec_solicitud_tramite)) !!}</td>
                <td class="text-center">{!! $info->vigencia !!}</td>
                <td>{!! $info->nom_tramite !!}</td>
                <td>{!! $info->texto08 !!}</td>
                <td class="text-center">{!! $info->estado_tramite !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@section('AddScriptFooter')


@endsection