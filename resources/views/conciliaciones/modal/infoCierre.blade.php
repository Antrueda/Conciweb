
<script type="text/javascript">
    $('#modal').modal({backdrop: 'static', keyboard: false});
    $('#modal').modal('show');
</script>

<div class="modal fade bd-example-modal-xl" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form name="frmRegistroDatos" enctype="multipart/form-data" id="frmRegistroDatos">
                <input type="hidden" value="{{$numSinproc=$data['numSolicitud']}}" name="numSolicitud" id="numSolicitud">
                <div class="alert" role="alert" style="background-color: #003E65; color: white;">
                    <div class="row">
                        <div class="col-md-12 text-md-center">
                            <p class="text-xs-center"><strong>CIERRE DE LA CONCILIACIÓN &nbsp;&nbsp; <br><small>Todos los campos con asterisco (*) son obligatorios</small></strong></p>
                        </div>
                    </div>
                </div>

                <div class="modal-body">


                    @empty(!$data['detalleCierre'])
                        <div class="alert alert-info  text-left" role="alert">
                            <strong>Información previa</strong><br>
                            A continuación visualizara los datos ya registrados y actuales con respecto al cierre del caso.<hr>
                            <div class="row">
                                <div class="col-md-6">1) Resultado : <b>{!! $data['resultadoPadre'] !!}</b></div>
                                <div class="col-md-6">2) Tipo Resultado : <b>{!! $data['nombreResultado'] !!}</b></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">3) Fecha del documento: <b>{{$data['fechaCargue']}}</b></div>
                                <div class="col-md-6">4) Soporte del Cierre: <b>{{$data['nombreDoc']}}</b></div>
                            </div>
                        </div>
                        <br>
                    @endempty

                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-group has-float-label">
                                <select class="form-control form-control-sm custom-select validate[optional]" name="tipoResultadoPadre" id="tipoResultadoPadre">
                                    @empty(!$data['detalleCierre'])
                                        <option selected value="1">{!! $data['resultadoPadre'] !!}</option>
                                    @endempty
                                    <option value=" ">- Seleccione una opcion -</option>
                                    <option value="1">ACTA</option>
                                    <option value="2">CONSTANCIA</option>
                                    <option value="6">INASISTENCIA</option>
                                    <option value="3">OTROS</option>
                                </select>
                                <span> 1) Resultado *</span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="form-group has-float-label">
                                <select class="form-control form-control-sm custom-select validate[required]" name="tipoResultadoHijo" id="tipoResultadoHijo">
                                    <option value=" ">- Seleccione una opcion -</option>
                                </select>
                                <span> 2) Tipo Resultado *</span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="form-group has-float-label">
                                <input type="text" class="form-control form-control-sm validate[required]" name="fehcaDocumento" id="fehcaDocumento" autocomplete="off">
                                <span> 3) Fecha del documento *</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-group has-float-label">
                                <div class="input-group input-file" name="document1">
                                    <span class="input-group-btn">
                                        <button class="btn btn-dark btn-choose" type="button">Seleccionar</button>
                                    </span>
                                    <input type="text" class="validate[required] form-control" name="document1" id="document1" placeholder=' 4) Soporte del Cierre *' />
                                    <span class="input-group-btn">
                                        <button class="btn btn-danger btn-reset" type="button">Limpiar</button>
                                    </span>
                                </div>
                                <span style="margin-top: 11px;"> 4) Soporte del Cierre *</span>
                            </label>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4" id="btnRegistrar">
                        <button type="submit" class="btn btn-primary btn-block btn-sm" >&nbsp;<span class="fa fa-save"> </span> ACTUALIZAR</button>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-danger btn-block btn-sm" data-dismiss="modal">&nbsp;<span class="fa fa-window-close"> </span> CERRAR</button>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        $("#frmRegistroDatos").validationEngine('attach',{
            onValidationComplete:function(form, status) {
                if (status === true) {
                    registroDatos();
                } else {
                    llamarNotyFaltanDatosFrm();
                    return;
                }
            }
        });
    });

    function registroDatos(){
        var formData=new FormData(document.getElementById("frmRegistroDatos"));
        formData.append("dato","valor");
        $.ajax({
            type: "POST",
            url: "registroCierreCon",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){llamarNotyCarga();},
            success: function(r){
                cons();
                var datUsr=r.split("|");
                var valor=datUsr[1];
                var msg=datUsr[2];
                if(valor==0) {
                    var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
                    llamarNotyTime('error',msg,'topRight',2000);
                }else{
                    var msg="<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" +msg;
                    new Noty({
                        text: msg,
                        type: 'success',
                        layout: 'center',
                        theme: 'bootstrap-v4',
                        killer:true,
                        progressBar:true,
                        timeout:2000,
                        callbacks: {
                            afterClose: function() {
                                $('#modal').modal('toggle');
                            },
                        }
                    }).show();
                }
            }
        });
    }

    $('#fehcaDocumento').datetimepicker({
        startDate:	'+1970/01/01',
        lang:'es',
        format:'d/m/Y', //format:'d/m/Y H:i',
        maxDate:0, // Bloquea días futuros
        timepickerScrollbar:false,
        timepicker:false,
        closeOnDateSelect: true,
    });

    function bs_input_file() {
        $(".input-file").before(
            function() {
                if ( ! $(this).prev().hasClass('input-ghost') ) {
                    var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                    element.attr("name",$(this).attr("name"));
                    element.change(function(){
                        element.next(element).find('input').val((element.val()).split('\\').pop());
                    });
                    $(this).find("button.btn-choose").click(function(){
                        element.click();
                    });
                    $(this).find("button.btn-reset").click(function(){
                        element.val(null);
                        $(this).parents(".input-file").find('input').val('');
                    });
                    $(this).find('input').css("cursor","pointer");
                    $(this).find('input').mousedown(function() {
                        $(this).parents('.input-file').prev().click();
                        return false;
                    });
                    return element;
                }
            }
        );
    }
    $(function() {
        bs_input_file();
    });

    $("#tipoResultadoPadre").change(function(){
        $.ajax({
            url:"consultalistaResultado",
            type: "POST",
            data: { idResultadoPadre: $("#tipoResultadoPadre").val() },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(opciones){
                $('#tipoCiudad')
                    .find('option')
                    .remove()
                    .end()
                    .val('whatever');
                opciones.forEach(element => $('#tipoResultadoHijo').append(new Option(element['sicnombretiporesultadoconcilia'], element['sicidtiporesultadoconciliacion'])) );
            }
        })
    });

</script>