<h6 class="pt-3">Parámetros</h6>
@if(count($dato->parametros)>0)
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead>
                <tr class="text-center">
                    @if($accion=='Editar')
                        @canany(['tema-editar','tema-borrar'])
                            <th>Acciones</th>
                        @endcan
                    @endif
                    <th>Nombre</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($dato->parametros as $d)
                    <tr>
                        @canany(['tema-leer', 'tema-crear', 'tema-editar', 'tema-borrar'])
                            @if($accion=='Editar')
                                <td class='text-center'>
                                    @can('tema-borrar')
                                        {!! Form::open(['route' => ['tema.verParametro', $dato->id, $d->id], 'method' => 'DELETE']) !!}
                                            <button class="btn btn-sm btn-danger">Eliminar</button>
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            @endif
                            <td>{{ $d->nombre }}</td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No hay datos</p>
@endif