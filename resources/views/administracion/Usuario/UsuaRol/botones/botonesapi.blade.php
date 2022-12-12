@if($requestx->pueditar)
<a class="btn btn-sm btn-warning" href="{{ route($requestx->routexxx.'.editar', $queryxxx->id) }}">EDITAR</a>
@endif
@if($requestx->puedever)
<a class="btn btn-sm btn-primary" href="{{ route($requestx->routexxx.'.ver', $queryxxx->id) }}">VER</a>
@endif
@if($requestx->puedinac)
<button class="btn btn-sm btn-danger dttservicios" id="{{$queryxxx->id}}">INACTIVAR</button>
@endif
