<div class="form-group card-footer text-muted text-center">
    @if (isset($todoxxxx['botoform']))
        @foreach ($todoxxxx['botoform'] as $botoform)
            @if ($botoform['mostrars'])
                @switch($botoform['formhref'])
                    @case(0)
                    @break
                    @case(1)
                        {{ Form::submit($botoform['accionxx'], ['class' => $botoform['clasexxx']]) }}
                    @break
                    @case(2)
                        <a href="{{ route($botoform['routingx'][0], $botoform['routingx'][1]) }}"
                            class="{{ $botoform['clasexxx'] }}">{{ $botoform['tituloxx'] }}</a>
                    @break
                @endswitch
            @endif
        @endforeach
    @else
        @if ($todoxxxx['accionxx'] == 'Crear' || $todoxxxx['accionxx'] == 'Editar')
            {{ Form::submit($todoxxxx['accionxx'], ['class' => 'btn btn-sm btn-primary']) }}
        @endif
        {{-- @if ($todoxxxx['accionxx'] != 'Crear')
            <a href="{{route($todoxxxx['routnuev'].'.nuevo',$todoxxxx['nnajregi'])}}" 
            class="btn btn-sm btn-primary" role="button">Nuev{{ $todoxxxx['nuevoxxx']  }}</a>
        @endif --}}
        @if (!isset($todoxxxx['mostrarx']))
            <a href="{{ route($todoxxxx['routinde']) }}" class="btn btn-sm btn-primary" role="button">Volver a
                {{ $todoxxxx['volverax'] }}</a>
        @endif
    @endif

</div>
