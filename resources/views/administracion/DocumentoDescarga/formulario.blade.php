<div class="card card-outline card-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} Estado del Formulario</h3>
    </div>
    <div class="card-body">
        @if($accion == 'Nuevo')
            {!! Form::open(['route' => 'estadoform.nuevo', 'class' => 'form-horizontal']) !!}
                @include('administracion.EstadoFormulario.campos')
            {!! Form::close() !!}
        @elseif ($accion == 'Editar')
            {!! Form::model($dato, ['route' => ['estadoform.editar', $dato->id], 'method' => 'PUT']) !!}
                @include('administracion.EstadoFormulario.campos')
            {!! Form::close() !!}
        @else
             @include('administracion.estadoform.campos')
        @endif
    </div>
</div>