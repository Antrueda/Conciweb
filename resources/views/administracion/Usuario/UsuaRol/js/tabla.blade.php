<script>
     toastr.options = {
            "positionClass": "toast-top-full-width",
        }

    $(function(){
        $('#{{$todoxxxx["tablaxxx"]}}').on('click','.dttservicios',function(){
            var dataxxxx={
                confirmx:'{{$todoxxxx["confirmx"]}}'+$(this).prop('id')+'?',
                reconfir:'{{$todoxxxx["reconfir"]}}'+$(this).prop('id')+'?',
                datatabl:{{$todoxxxx["tablaxxx"]}},
                urlxxxxx:"{{route($todoxxxx['routxxxx'].'.borrar')}}",
                dataxxxx:{padrexxx:$(this).prop('id')},
                typexxxx:'GET',
                msnxxxxx:'{{$todoxxxx["msnxxxxx"]}}'}
                f_confirm(dataxxxx);
       })
    });
</script>
