<div class="card">
    <div class="card-header">
        {{$todoxxxx['tituhead']}}
    </div>
    <div class="card-header p-2">
        <ul class="nav nav-tabs">
            @if($todoxxxx['pestpadr']==1)
            @canany(['rolesxxx-leer', 'rolesxxx-crear', 'rolesxxx-editar', 'rolesxxx-borrar'])
            <li class="nav-item"><a class="nav-link{{ ($todoxxxx['slotxxxx']=='rolesxxx') ?' active' : '' }}
        text-sm" href="{{ route('rolesxxx') }}">ROLES</a></li>
            @endcanany
            @endif
            @if($todoxxxx['pestpadr']==2)
            @canany(['rolesxxx-leer', 'rolesxxx-crear', 'rolesxxx-editar', 'rolesxxx-borrar'])
            <li class="nav-item"><a class="nav-link{{ ($todoxxxx['slotxxxx']=='rolesxxx') ?' active' : '' }}
        text-sm" href="{{ route('rolesxxx') }}">ROL</a></li>
            @endcanany
            @canany(['permirol-leer', 'permirol-crear', 'permirol-editar', 'permirol-borrar'])
            <li class="nav-item" readonly><a class="nav-link{{ ($todoxxxx['slotxxxx']=='permirol') ?' active' : '' }}
        text-sm" href="{{ route('permirol', $todoxxxx['parametr']) }}">PERMISOS</a></li>
            @endcanany
            @endif
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active" id="{{ $todoxxxx['slotxxxx'] }}">
                @if(isset($rolesxxx))
                {{ $rolesxxx }}
                @endif
                @if(isset($permirol))
                {{ $permirol }}
                @endif
            </div>
        </div>
    </div>
</div>
