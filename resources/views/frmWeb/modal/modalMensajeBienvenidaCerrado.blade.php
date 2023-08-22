
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
                            <div class="col-md-4 text-right"><img src="{{URL::asset('imagen/logoConciweb1.png')}}" class="rounded mx-auto d-block"  style="width: 100%;
                                height: auto;"></div>
                        </div>
                    </div>
                    <div class="card-body  text-justify">
                        {!!$data['mensaje']->texto!!}
                    <hr>
                    <center>
                        <div class="custom-control custom-checkbox">
                            
                            <button id="customCheck1" type="submit" class="btn btn-primary "><span class="fas fa-undo"></span> ACEPTAR</button>
                            @can('administrar-modulo')  
                            <a href="{{ route('estadoform.editar',1)}}" class="btn btn-success">
                                <svg style="margin-right: 5px;
                                margin-bottom: 6px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                                    <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                                </svg>  
                                  Cambiar estado de Formulario</a>
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


</script>