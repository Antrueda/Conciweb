<div class="card card-outline card-secondary">
    <style>
       .selected{
        background-color: coral;
       }
    </style>
    <div class="card-header">
        <h3 class="card-title">
            {{ $todoxxxx['titulist'] }}
            @if($todoxxxx['vercrear'])
                @can($todoxxxx['permisox'].'-crear')
                    <a class="btn btn-sm btn-primary ml-2" title="{{ $todoxxxx['titunuev'] }}" href="{{ route($todoxxxx['routxxxx'].'.nuevo',$todoxxxx['parametr']) }}">
                        CREAR {{ $todoxxxx['titunuev'] }}
                    </a>
                @endcan
            @endif
        </h3>
    </div>
    <div class="card-body">
        @canany([$todoxxxx['permisox'].'-leer',$todoxxxx['permisox'].'-crear',$todoxxxx['permisox'].'-editar',$todoxxxx['permisox'].'-borrar'])
            <div class="table-responsive">
                <table id="{{ $todoxxxx['tablaxxx'] }}" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr class="text-center">
                            @if ($todoxxxx['accitabl'])
                                <th width="200">ACCIONES</th>
                            @endif



                            @foreach( $todoxxxx['cabecera'] as $cabecera )
                                <th> {{  $cabecera['td']   }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tfoot>
                        <tr class="text-center">
                            @if ($todoxxxx['accitabl'])
                                <th width="150">ACCIONES</th>
                            @endif



                            @foreach( $todoxxxx['cabecera'] as $cabecera )
                                <th> {{  $cabecera['td']   }}</th>
                            @endforeach
                        </tr>
                    </tfoot>
                </table>
            </div>
        @endcanany
    </div>
</div>
