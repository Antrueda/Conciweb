<center>
    <div class="container">
        <div class="row justify-content-md-center">
        @foreach ($todoxxxx['botoform'] as $botoform)
        <div class="col-md-2">
            @switch($botoform['formhref'])
                @case(1)
                    {{ Form::submit($botoform['tituloxx'], ['class'=>$botoform['clasexxx']]) }}
                    @break
                @case(2)
                    <a href="{{route($botoform['routingx'][0],$botoform['routingx'][1])}}"
                    class="{{ $botoform['clasexxx']}}">{{$botoform['tituloxx']}}</a>
                    @break
            @endswitch
        </div>
        @endforeach
        </div>
    </div>
    </center>