<div class="card card-outline card-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} Semilla</h3>
    </div>
    <div class="card-body">
        @if($accion == 'Nuevo')
            {!! Form::open(['route' => 'semilla.nuevo', 'class' => 'form-horizontal']) !!}
                @include('administracion.Semilla.campos')
            {!! Form::close() !!}
        @elseif ($accion == 'Editar')
            {!! Form::model($dato, ['route' => ['semilla.editar', $dato->id], 'method' => 'PUT']) !!}
                @include('administracion.Semilla.campos')
            {!! Form::close() !!}
        @else
             @include('administracion.Semilla.campos')
        @endif
    </div>
</div>