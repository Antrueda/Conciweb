<div class="card card-outline card-secondary">
    <div class="card-header">
        
    </div>
    <div class="card-body">
        @if($accion == 'Nuevo')
            {!! Form::open(['route' => 'documentd.nuevo', 'class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) !!}
                @include('administracion.DocumentoDescarga.campos')
            {!! Form::close() !!}
        @elseif ($accion == 'Editar')
            {!! Form::model($dato, ['route' => ['documentd.editar', $dato->id], 'method' => 'PUT','enctype'=>"multipart/form-data"]) !!}
                @include('administracion.DocumentoDescarga.campos')
            {!! Form::close() !!}
        @else
             @include('administracion.DocumentoDescarga.campos')
        @endif
    </div>
</div>