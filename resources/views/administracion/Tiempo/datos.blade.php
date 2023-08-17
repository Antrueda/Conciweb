<div class="card card-outline card-secondary">
    <div class="card-header">
        <h3 class="card-title">
            Formatos Subidos
            
                <a class="btn btn-sm btn-primary ml-2" title="Nuevo" href="{{ route('documentd.nuevo') }}">
                    Nuevo
                </a>
            
        </h3>
    </div>
    <div class="card-body">

            <form class="form-inline pb-3" action="{{ route('documentd') }}" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" name="buscar" value="{{ $buscar }}" placeholder="Texto a buscar">
                </div>
                <button type="submit" class="btn btn-primary ml-2" title="Buscar">Buscar</button>
            </form>
            @if(count($datos)>0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr class="text-center">
            
                                    <th>Acciones</th>
            
                                <th>ID</th>
                                <th>Nombre</th> 
                                <th>Ruta de Archivo</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datos as $d)
                                <tr>
                       
                                        <td class='text-center'>
                                        
                                                <a class="btn btn-sm btn-primary" title="Editar" href="{{ route('tiempod.editar', $d->id) }}">
                                                    Editar
                                                </a>
                              
                                                <a class="btn btn-sm btn-primary" title="Ver" href="{{ route('tiempod.ver', $d->id) }}">
                                                    Ver
                                                </a>
                                 
                                        </td>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->nombreoriginalfile }}</td>
                                        <td>{{ $d->rutafinalfile }}</td>
                                          
                                     
                     
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $datos->appends(['buscar' => $buscar])->links() }}
            @else
                <p>No hay datos</p>
            @endif

    </div>
</div>