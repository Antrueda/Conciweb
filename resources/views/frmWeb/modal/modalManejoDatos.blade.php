
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
                            <div class="col-md-6 text-center"><h5><b style="text-justify;color:#0171BD"><br>AUTORIZACIÓN PARA EL TRATAMIENTO DE DATOS PERSONALES</b></h5></div>
                            <div class="col-md-1"> </div>
                            <div class="col-md-4 text-right"><img src="{{URL::asset('imagen/logoConciweb.png')}}" class="rounded mx-auto d-block" style="width: 100%;
                                height: auto;"></div>
                        </div>
                    </div>
                    <div class="card-body  text-justify">
                        <div class="card-text  text-justify">
                        {!!$data['mensaje']->texto!!}
                    </div>
                    
                </div>
                <div class="card-footer">
                    <center>
                  
                        <label>
                            <input type="checkbox" class="form-check-input" id="customCheck1" style="margin-top: 0;color:#0171BD"><span class="px-2"><b style="color:#0171BD"> ACEPTAR TRATAMIENTO DE DATOS</b>  </span>
                
                         </label>
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
    $("#modal").modal('hide');//ocultamos el modal
        $('.modal-backdrop').remove();//eliminamos el backdrop del modal
});

</script>