<div class="card card-outline card-secondary">
    <div class="card-header">
        <h3 class="card-title">
            
            @can('parametro-crear')
                <a class="btn btn-sm btn-success ml-2" title="Nuevo" href="{{ route('parametro.nuevo') }}">
                    Nuevo Parametro
                </a>
            @endcan
        </h3>
    </div>
    <div class="card-body">
        @canany(['parametro-leer','parametro-crear','parametro-editar','parametro-borrar'])
            <form class="form-inline pb-3" action="{{ route('parametro') }}" method="get">
                <div class="form-group row d-flex">
                    <div class="col-3 " >
                  
                        <input type="text" class="form-control" name="buscar" value="{{ $buscar }}" placeholder="Buscar">
                    </div>
                    <div class="col-3">
                        
                        <button type="submit" class="btn btn-primary" title="Buscar">Buscar</button>
                </div>
                </div>
      
            </form>
            @if(count($datos)>0)
                    <table class="table table-striped table-bordered" style="--bs-table-striped-bg:#F5F9FC" id="tablita" >
                        <thead>
                            <tr class="text-center">
                                @canany(['parametro-editar','parametro-borrar'])
                                    <th>Acciones</th>
                                @endcan
                                <th>ID</th>
                                <th>Nombre</th> 
                                <th>Estado</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datos as $d)
                                <tr>
                                    @canany(['parametro-editar','parametro-borrar'])
                                        <td class='text-center'>
                                            @can('parametro-editar')
                                                <a class="btn btn-sm btn-success" title="Editar" href="{{ route('parametro.editar', $d->id) }}">
                                                    Editar
                                                </a>
                                            @endcan
                                            @can('parametro-leer')
                                                <a class="btn btn-sm btn-primary" title="Ver" href="{{ route('parametro.ver', $d->id) }}">
                                                    Ver
                                                </a>
                                            @endcan
                                        </td>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->nombre }}</td>
                                        <td class="text-center">
                                            @if($d->sis_esta_id == 1)
                                                <span class="fas fa-check text-success" aria-hidden="true"></span>
                                            @else
                                                <span class="fas fa-times text-danger" aria-hidden="true"></span>
                                            @endif
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
              
                {{-- {{ $datos->appends(['buscar' => $buscar])->links() }} --}}
            @else
                <p>No hay datos</p>
            @endif
        @endcanany
    </div>
</div>
<script>
    var table ='';
    $(document).ready(function() {



 } );
 </script>