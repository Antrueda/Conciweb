<div class="card card-outline card-secondary">
    <div class="card-header">
        
    </div>
    <div class="card-body">
        @if($accion == 'Nuevo')
            {!! Form::open(['route' => 'tiempod.nuevo', 'class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) !!}
                @include('administracion.Tiempo.campos')
            {!! Form::close() !!}
        @elseif ($accion == 'Editar')
            {!! Form::model($dato, ['route' => ['tiempod.editar', $dato->id], 'method' => 'PUT','enctype'=>"multipart/form-data"]) !!}
                @include('administracion.Tiempo.campos')
            {!! Form::close() !!}
        @else
             @include('administracion.Tiempo.campos')
        @endif
    </div>
</div>