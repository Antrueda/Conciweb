
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
                            <div class="col-md-4 text-right"><img src="{{URL::asset('imagen/Propuesta logo Conciweb-2.png')}}" class="rounded mx-auto d-block"  style="width: 100%;
                                height: auto;"></div>
                        </div>
                    </div>
                    <div class="card-body  text-justify">
                        {!!$data['mensaje']->texto!!}
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


</script>