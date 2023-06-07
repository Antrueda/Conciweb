<div class="form-group card-footer text-muted text-center">
    <div class="row">
    @foreach ($todoxxxx['botoform'] as $botoform)

    <div class="col-5">
        @switch($botoform['formhref'])
            @case(1)
                {{ Form::submit($botoform['tituloxx'], ['class'=>$botoform['clasexxx']]) }}
                @break
            @case(2)
                <a href="{{route($botoform['routingx'][0],$botoform['routingx'][1])}}"
                class="{{ $botoform['clasexxx']}}">{{$botoform['tituloxx']}}</a>
                @break
        @endswitch
    </div><br>
    @endforeach
</div>
</div>
