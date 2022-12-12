<div class="card card-outline card-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} parámetro</h3>
    </div>
    <div class="card-body">
        @if($accion == 'Nuevo')
            {!! Form::open(['route' => 'parametro.nuevo', 'class' => 'form-horizontal']) !!}
                @include('administracion.parametro.campos')
            {!! Form::close() !!}
        @elseif ($accion == 'Editar')
            {!! Form::model($dato, ['route' => ['parametro.editar', $dato->id], 'method' => 'PUT']) !!}
                @include('administracion.parametro.campos')
            {!! Form::close() !!}
        @else
             @include('administracion.parametro.campos')
        @endif
    </div>
</div>