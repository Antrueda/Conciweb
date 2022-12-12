
@extends('main')

@section('title','REGISTRO DE CIUDADANO')

@section('AddScritpHeader')

@endsection

@section('content')

    <div class="alert alert-danger text-center" role="alert">
        <b><i class="fas fa-times-circle fa-w-16 fa-3x"></i><br>
            {{$data['error']}}.<br>Por favor comuníquese con la dirección de TIC para poderle dar solución a su inconveniente. </b>
    </div>

@endsection

@section('AddScriptFooter')
@endsection