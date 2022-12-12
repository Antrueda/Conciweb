<script>
   var table ='';
$(document).ready(function() {

  table =  $('#{{ $tableName }}').DataTable({

      "serverSide": true,
      "lengthMenu":				[[5, 10, 20, 25, 50], [5, 10, 20, 25, 50]],
    	"ajax": {
        url:"{{ url($todoxxxx['urlxxxxx'])  }}",
        @if(isset($todoxxxx['dataxxxx']))
          data:{
            @foreach($todoxxxx['dataxxxx'] as $dataxxxx)
            {{$dataxxxx['campoxxx']}}:"{{$dataxxxx['dataxxxx']}}",
            @endforeach
          }
        @endif
      },
    	"columns":[
			@foreach($todoxxxx['columnsx'] as $columnsx)
			{data:'{{ $columnsx["data"] }}',name:'{{ $columnsx["name"] }}'},
      @endforeach
    ],

    	"language": {
           	"url": "{{ url('/adminlte/plugins/datatables/Spanish.lang') }}"
       	}
    });








} );

$(function(){
  $('#{{ $tableName }} tbody').on( 'click', 'tr', function () {

        if ( $(this).hasClass('btn-success') ) {
            $(this).removeClass('btn-success');
        }
        else {
            table.$('tr.btn-success').removeClass('odd btn-success');
            $(this).addClass('btn-success');
        }
    } );

});
</script>
