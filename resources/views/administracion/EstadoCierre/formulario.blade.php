<div class="card card-outline card-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} Estado del Formulario</h3>
    </div>
    <div class="card-body">
        @if($accion == 'Nuevo')
            {!! Form::open(['route' => 'estadoform.nuevo', 'class' => 'form-horizontal']) !!}
                @include('administracion.EstadoCierre.campos')
            {!! Form::close() !!}
        @elseif ($accion == 'Editar')
            {!! Form::model($dato, ['route' => ['estadoform.editar', $dato->id], 'method' => 'PUT']) !!}
                @include('administracion.EstadoCierre.campos')
            {!! Form::close() !!}
         @elseif ($accion == 'Editarcierre')
            {!! Form::open(['route' => ['estadoform.editarcieres',$dato->id],'class' => 'form-horizontal']) !!}
            {{-- {!! Form::model($dato, ['route' => ['estadoform.editarcieres', $dato->id], 'method' => 'PUT']) !!} --}}
                @include('administracion.EstadoCierre.campos')
            {!! Form::close() !!}

        @endif
    </div>
</div>