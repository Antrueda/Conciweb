
<script type="text/javascript">
    $('#modal').modal({backdrop: 'static', keyboard: false});
    $('#modal').modal('show');
</script>

<style type="text/css">
    .uno{ background-color: #72A2CC; font-weight: bold; }
    .cero{ background-color: #C4E7EE; font-weight: bold; }
    tfoot{
        display: table-header-group;
    }
</style>

<div class="modal fade bd-example-modal-xl" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="alert" role="alert" style="background-color: #003E65; color: white;">
                <div class="row">
                    <div class="col-md-10 text-md-center">
                        <p class="text-xs-center"><strong>LISTA DE TRAMITES ACTIVOS EN LA SEDE</strong></p>
                    </div>
                    <div class="col-md-2 text-md-right">
                        <button type="submit" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-window-close"></span></button>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered nowrap" width="100%" id="myTable">
                    <thead>
                    <tr>
                        <th width="10%">SINPROC</th>
                        <th width="10%"># CASO</th>
                        <th width="10%">CONVOCANTE</th>
                        <th width="20%">CONVOCADO</th>
                        <th width="10%">HECHOS</th>
                        <th width="10%">CONCILIADOR</th>
                        <th width="10%">INFO. AUDIENCIA</th>
                        <th width="10%">MANEJO DEL CONFLICTO</th>
                        <th width="10%">CIERRE</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th width="10%">SINPROC</th>
                        <th width="10%"># CASO</th>
                        <th width="10%">CONVOCANTE</th>
                        <th width="20%">CONVOCADO</th>
                        <th width="10%">HECHOS</th>
                        <th width="10%">CONCILIADOR</th>
                        <th width="10%">INFO. AUDIENCIA</th>
                        <th width="10%">MANEJO DEL CONFLICTO</th>
                        <th width="10%">CIERRE</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($data['conciliacionesActivas'] as $info)
                        <tr>
                            <th scope="row">{{$info->num_solicitud}}</th>
                            <td>{{$info->sicnumeroregistroconciliacion}}</td>
                            @if ($info->paso2 == 0 ) @php $clase='cero'; $texto='Faltante'; @endphp @else @php $clase='uno'; $texto='Finalizada'; @endphp @endif
                            <td class="{{ $clase  }}">{{$texto}}</td>
                            @if ($info->paso3 == 0 ) @php $clase='cero'; $texto='Faltante'; @endphp @else @php $clase='uno'; $texto='Finalizada'; @endphp @endif
                            <td class="{{ $clase  }}">{{$texto}}</td>
                            @if ($info->paso4 == 0 ) @php $clase='cero'; $texto='Faltante'; @endphp @else @php $clase='uno'; $texto='Finalizada'; @endphp @endif
                            <td class="{{ $clase  }}">{{$texto}}</td>
                            @if ($info->paso5 == 0 ) @php $clase='cero'; $texto='Faltante'; @endphp @else @php $clase='uno'; $texto='Finalizada'; @endphp @endif
                            <td class="{{ $clase  }}">{{$texto}}</td>
                            @if ($info->paso6 == 0 ) @php $clase='cero'; $texto='Faltante'; @endphp @else @php $clase='uno'; $texto='Finalizada'; @endphp @endif
                            <td class="{{ $clase  }}">{{$texto}}</td>
                            @if ($info->paso7 == 0 ) @php $clase='cero'; $texto='Faltante'; @endphp @else @php $clase='uno'; $texto='Finalizada'; @endphp @endif
                            <td class="{{ $clase  }}">{{$texto}}</td>
                            @if ($info->paso8 == 0 ) @php $clase='cero'; $texto='Faltante'; @endphp @else @php $clase='uno'; $texto='Finalizada'; @endphp @endif
                            <td class="{{ $clase  }}">{{$texto}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                <br>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-danger btn-block btn-sm" data-dismiss="modal">&nbsp;<span class="fa fa-window-close"> </span> CERRAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


    $('#myTable').DataTable( {
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }

        }
    } );


    $('#myTable tfoot th').each( function(){
        // var title=$('#myTable tfoot th').eq($(this).index()).text();
        $(this).html('<input style="color:#000000; text-align: center; width: 80%" type="text" />');
    });

    var table=$('#myTable').DataTable();
    table.columns().every(function(){
        var that=this;
        $('input',this.footer()).on('keyup change',function(){
            that
                .search(this.value)
                .draw();
        });
    });
</script>