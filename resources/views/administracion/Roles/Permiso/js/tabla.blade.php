<script>
    $(function() {
        @foreach ($todoxxxx['tablasxx'] as $tablasxx)
            {{ $tablasxx["tablaxxx"] }} =  $('#{{ $tablasxx["tablaxxx"] }}').DataTable({
                "serverSide": true,
                "lengthMenu":				[[5, 10, 20, 25, 50], [5, 10, 20, 25, 50]],
                "ajax": {
                    url:"{{ url($tablasxx['urlxxxxx'])  }}",
                    @if(isset($tablasxx['dataxxxx']))
                        data:{
                            @foreach($tablasxx['dataxxxx'] as $dataxxxx)
                            "{{$dataxxxx['campoxxx']}}":"{{$dataxxxx['dataxxxx']}}",
                            @endforeach
                        }
                    @endif
                },
                "columns":[
                    @foreach($tablasxx['columnsx'] as $columnsx)
                        {data:'{{ $columnsx["data"] }}',name:'{{ $columnsx["name"] }}'},
                    @endforeach
                ],
                "language": {
                    "url": "{{ url('/adminlte/plugins/datatables/Spanish.lang') }}"
                },
            });
        @endforeach

        var f_ajax = function(valuexxx, checkedx) {
            $.ajax({
                url: "{{ route($todoxxxx['permisox'].'.editar',$todoxxxx['parametr'])}}",
                type: 'GET',
                data: {
                    'valuexxx': valuexxx,
                    'checkedx': checkedx
                },
                dataType: 'json',
                success: function(json) {

                    if(checkedx==1){
                        toastr.success('Permiso asigndo con éxito');
                        {{ $todoxxxx["tablasxx"][0]["tablaxxx"] }}.ajax.reload();
                        {{ $todoxxxx["tablasxx"][1]["tablaxxx"] }}.ajax.reload();
                    }else{
                        toastr.error('Permiso retirado con éxito');
                        {{ $todoxxxx["tablasxx"][1]["tablaxxx"] }}.ajax.reload();
                        {{ $todoxxxx["tablasxx"][0]["tablaxxx"] }}.ajax.reload();
                    }
                },
                error: function(xhr, status) {
                    alert('Disculpe, existiÃ³ un problema');
                }
            });
        }
        @can('permirol-editar')
            $('#{{ $todoxxxx["tablasxx"][0]["tablaxxx"] }} tbody').on( 'click', 'tr', function () {
                var id= {{ $todoxxxx["tablasxx"][0]["tablaxxx"] }}.row( this ).data();
                if ( !$(this).hasClass('btn-danger') &&  id!=undefined) {
                    $(this).addClass('btn-danger');
                    f_ajax(id.id,0);
                }
                //console.log( {{ $todoxxxx["tablasxx"][0]["tablaxxx"] }}.row( this ).data() );
            } );

            $('#{{ $todoxxxx["tablasxx"][1]["tablaxxx"] }} tbody').on( 'click', 'tr', function () {
                var id= {{ $todoxxxx["tablasxx"][1]["tablaxxx"] }}.row( this ).data();
                if ( !$(this).hasClass('btn-primary' &&  id!=undefined) ) {
                    $(this).addClass('btn-primary');
                    f_ajax(id.id,1);
                }
            } );
        @endcan

    });
</script>
