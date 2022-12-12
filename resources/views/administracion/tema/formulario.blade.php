<div class="card card-outline card-secondary">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} tema</h3>
    </div>
    <div class="card-body">
        @if($accion == 'Nuevo')
            {!! Form::open(['route' => 'tema.nuevo', 'class' => 'form-horizontal']) !!}
                @include('administracion.tema.campos')
            {!! Form::close() !!}
        @elseif ($accion == 'Editar')
            {!! Form::model($dato, ['route' => ['tema.editar', $dato->id], 'method' => 'PUT']) !!}
                @include('administracion.tema.campos')
            {!! Form::close() !!}
            @include('administracion.tema.datosParametros')
        @else
             @include('administracion.tema.campos')
             @include('administracion.tema.datosParametros')
        @endif
    </div>
</div>
@if($accion == 'Editar')
    @canany(['tema-crear','tema-editar'])
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">Adicionar parámetro</h3>
            </div>
            <div class="card-body">
                <form class="form-inline pb-3" action="{{ route('tema.editar', $dato->id) }}" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" name="buscar" value="{{ $buscar }}" placeholder="Texto a buscar">
                    </div>
                    <button type="submit" class="btn btn-primary ml-2" title="Buscar">Buscar</button>
                </form>
                @if(count($parametros)>0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th>Acciones</th>
                                    <th>Nombre</th> 
                                    <th>Estado</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parametros as $d)
                                    <tr>
                                        <td class='text-center'>
                                            {!! Form::open(['route' => ['tema.editarParametro', $dato->id, $d->id], 'method' => 'PUT']) !!}
                                                <button class="btn btn-sm btn-primary">Agregar</button>
                                            {!! Form::close() !!}
                                            {{-- <a class="btn btn-sm btn-primary" title="Editar" href="{{ route('tema.editarParametro', $dato->id, $d->id) }}">
                                                Editar
                                            </a> --}}
                                        </td>
                                        <td>{{ $d->nombre }}</td>
                                        <td class="text-center">
                                            @if($d->sis_esta_id == 1)
                                                <span class="fas fa-check text-success" aria-hidden="true"></span>
                                            @else
                                                <span class="fas fa-times text-danger" aria-hidden="true"></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $parametros->appends(['buscar' => $buscar])->links() }}
                @else
                    <p>No hay datos</p>
                @endif
            </div>
        </div>
    @endcanany
@endif