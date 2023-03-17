<div class="card card-outline card-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} Salario Minimo</h3>
    </div>
    <div class="card-body">
        @if($accion == 'Nuevo')
            {!! Form::open(['route' => 'salario.nuevo', 'class' => 'form-horizontal']) !!}
                @include('administracion.salario.campos')
            {!! Form::close() !!}
        @elseif ($accion == 'Editar')
            {!! Form::model($dato, ['route' => ['salario.editar', $dato->id], 'method' => 'PUT']) !!}
                @include('administracion.salario.campos')
            {!! Form::close() !!}
        @else
             @include('administracion.salario.campos')
        @endif
    </div>
</div>