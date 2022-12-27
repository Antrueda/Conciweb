
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
                            <div class="col-md-6 text-center"><h5><b style="text-justify"><br>MENSAJE PARA LOS USUARIOS</b></h5></div>
                            <div class="col-md-1"> </div>
                            <div class="col-md-4 text-right"><img src="{{URL::asset('imagen/logo-personeria-azul.png')}}" class="rounded mx-auto d-block" width="50%"></div>
                        </div>
                    </div>
                    <div class="card-body  text-justify">
                        Se informa a la ciudadanía que en el periodo comprendido entre el 30 de diciembre de 2022 al 09 de enero de 2023, no estará habilitada la aplicación CONCIWEB enfocada en <b>Solicitudes de Conciliación Virtual.</b> Este servicio se reactivará a partir del 10 de enero de 2023.
                            
                        Agradecemos su comprensión.
                    <hr>
                    <center>
                        <div class="custom-control custom-checkbox">
                            
                            <button id="customCheck1" type="submit" class="btn btn-primary "><span class="fas fa-undo"></span> ACEPTAR</button>
                            
                        </div>
                    </center>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

<script>
$( "#customCheck1" ).click(function() {
    window.location.href = "https://www.personeriabogota.gov.co/";
});

function modalTratamientoDAtos(){
        $.ajax({
            url:'modalTratamientoDatos',
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(respuesta){
                $("#modal").modal('hide');//ocultamos el modal
                $('.modal-backdrop').remove();//eliminamos el backdrop del modal
                $("#modalRespuesta").html(respuesta);
            },
            error: function(jqXHR, textStatus, errorThrown){    alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest); }
        })
    }

</script>