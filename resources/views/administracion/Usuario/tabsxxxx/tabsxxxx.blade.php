@php
$accionUsuario = ($todoxxxx['accionxx']=='Ver') ? 'usuario.ver': 'usuario.editar' ;
@endphp
<div class="card">
    <div class="card-header">
        {{$todoxxxx['tituhead']}}
    </div>
    <div class="card-header p-2">
        <ul class="nav nav-tabs">
            @if($todoxxxx['pestpadr'])
            @canany(['usuario-leer', 'usuario-crear', 'usuario-editar', 'usuario-borrar'])
            <li class="nav-item"><a class="nav-link{{ ($todoxxxx['slotxxxx']=='usuario') ?' active' : '' }}
            text-sm" href="{{ route('usuario') }}">USUARIOS</a></li>
            @endcanany
            @else
            @canany(['usuario-leer', 'usuario-crear', 'usuario-editar', 'usuario-borrar'])
            <li class="nav-item"><a class="nav-link{{ ($todoxxxx['slotxxxx']=='usuario') ?' active' : '' }}
        text-sm text-primary" href="{{ route('usuario') }}">USUARIOS</a></li>
            @endcanany
            @canany(['roleusua-leer', 'roleusua-crear', 'roleusua-editar', 'roleusua-borrar'])
            <li class="nav-item"><a class="nav-link{{ ($todoxxxx['slotxxxx']=='roleusua') ?' active' : '' }}
        text-sm" href="{{ route('roleusua', $todoxxxx['parametr']) }}">ROLES</a></li>
            @endcanany
          


            @endif
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active" id="{{ $todoxxxx['slotxxxx'] }}">

                @if(isset($usuario))
                {{ $usuario }}
                @endif
                @if(isset($areausua))
                {{ $areausua }}
                @endif
                @if(isset($usudepen))
                {{ $usudepen }}
                @endif
                @if(isset($roleusua))
                {{ $roleusua }}
                @endif
                @if(isset($contrase))
                {{ $contrase }}
                @endif
                @if(isset($acuerdo))
                {{ $acuerdo }}
                @endif
            </div>
        </div>
    </div>
</div>
