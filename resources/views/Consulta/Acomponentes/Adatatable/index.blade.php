
<div class="card card-outline card-secondary">


        @canany($todoxxxx['permtabl'])
        <div class="table-responsive">
            <table id="{{ $tableName }}" class="table table-striped table-bordered" style="--bs-table-striped-bg:#F5F9FC" >
                <thead>

                    @foreach( $todoxxxx['cabecera'] as $cabecera )
                    <tr class="text-center">
                        @foreach( $cabecera as $cabecerx)
                        <th width="{{$cabecerx['widthxxx']}}" rowspan="{{$cabecerx['rowspanx']}}" colspan="{{$cabecerx['colspanx']}}"> {{ $cabecerx['td']   }}</th>
                        @endforeach
                    </tr>
                    @endforeach
                </thead>
            </table>
        </div>
        @endcanany

</div>
