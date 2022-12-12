
<script type="text/javascript">
    $('#modal').modal({backdrop: 'static', keyboard: false});
    $('#modal').modal('show');
</script>

<div class="modal fade bd-example-modal-xl" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-6 text-center"><h5><b style="text-justify">AUTORIZACIÓN PARA EL TRATAMIENTO DE DATOS PERSONALES</b></h5></div>
                            <div class="col-md-1"> </div>
                            <div class="col-md-4 text-right"><img src="{{URL::asset('imagen/logo-personeria-azul.png')}}" class="rounded mx-auto d-block" width="50%"></div>
                        </div>
                    </div>
                    <div class="card-body text-justify">
                        <div class="card-body  text-justify">
                            {!!$data['mensaje']->texto!!}
                        <hr>
                    <hr>
                    <center>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1"><b  style="color: black">ACEPTAR TRATAMIENTO DE DATOS</b></label>
                        </div>
                    </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$( "#customCheck1" ).click(function() {
    $("#modal").modal('hide');//ocultamos el modal
        $('.modal-backdrop').remove();//eliminamos el backdrop del modal
});

</script>