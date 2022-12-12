<div class="card card-outline card-secondary">
    <div class="card-header">
        {{$todoxxxx['tituhead']}}
    </div>
    <div class="card-header p-2">
        <ul class="nav nav-tabs">
            @foreach($todoxxxx['pestania'] as $pestania)
                @canany($pestania['cananyxx'])
                <li class="nav-item">
                    <a class="nav-link {{ $pestania['activexx'] }} text-sm" href="{{ $pestania['routexxx'] }}">
                        {{ $pestania['tituloxx'] }}
                    </a>
                </li>
                @endcanany
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active" id="{{ $todoxxxx['slotxxxx'] }}">
                {{ $crudxxxx }} <!-- nombre que se le data en pestanias de la carpeta Acrud -->
            </div>
        </div>
    </div>
</div>
