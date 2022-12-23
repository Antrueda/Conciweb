
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
                            <div class="col-md-6 text-center"><h5><b style="text-justify">Mensaje para los usuarios</b></h5></div>
                            <div class="col-md-1"> </div>
                            <div class="col-md-4 text-right"><img src="{{URL::asset('imagen/logo-personeria-azul.png')}}" class="rounded mx-auto d-block" width="50%"></div>
                        </div>
                    </div>
                    <div class="card-body text-justify">
                        <div class="card-body  text-justify">
                            Se informa a la ciudadanía que en el periodo comprendido entre el 30 de diciembre de 2022 al 09 de enero de 2023, no estará habilitada la aplicación CONCIWEB enfocada en <b>Solicitudes de Conciliación Virtual.</b> Este servicio se reactivará a partir del 10 de enero de 2023.
                            
                            Agradecemos su comprensión.
                        <hr>
                    <hr>
                    <center>
                        <div class="row" id="btnRegistro">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <a type="submit" class="btn btn-primary btn-block btn-sm " href="https://www.personeriabogota.gov.co"><i class="fas fa-chevron-circle-left"></i> </span> ACEPTAR </a>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
$( "#customCheck1" ).click(function() {
    window.location.href = "https://www.personeriabogota.gov.co/";
});



</script>