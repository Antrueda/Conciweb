
<script type="text/javascript">
    $('#modal').modal({backdrop: 'static', keyboard: false});
    $('#modal').modal('show');
</script>

<div class="modal fade bd-example-modal-xl" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form name="frmRegistroDatos" id="frmRegistroDatos">
                <div class="alert" role="alert" style="background-color: #003E65; color: white;">
                    <div class="row">
                        <div class="col-md-12 text-md-center">
                            <p class="text-xs-center"><strong>REGISTRO INICIAL DE LA CONCILIACIÓN &nbsp;&nbsp; <br><small>Todos los campos con asterisco (*) son obligatorios</small></strong></p>
                        </div>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-group has-float-label">
                                <input class="form-control form-control-sm validate[required]" type="text" name="numeroDelCaso" id="numeroDelCaso" value="{{Session::get('siglaSede')}}">
                                <span> 1) Número del Caso *</span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="form-group has-float-label">
                                <select class="form-control form-control-sm custom-select validate[required]" name="solicitanteServicio" id="solicitanteServicio">
                                    <option value=" ">- Seleccione una opcion -</option>
                                    @foreach ($data['solicitantesServicio'] as $info)
                                        <option value="{{$info->sicidsolicitanteservicio}}">{!! $info->sicnombresolicitanteservicio !!}</option>
                                    @endforeach
                                </select>
                                <span> 2) Solicitante del servicio *</span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="form-group has-float-label">
                                <input class="form-control form-control-sm validate[required]" type="text" name="fecSolicitud" id="fecSolicitud"  autocomplete="off">
                                <span> 3) Fecha de solicitud *</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-group has-float-label">
                                <select class="form-control form-control-sm custom-select validate[required]" name="finalidad" id="finalidad">
                                    <option value=" ">- Seleccione una opcion -</option>
                                    @foreach ($data['finalidadAdquicision'] as $info)
                                        <option value="{{$info->sicidtipofinalidadministerio}}">{!! $info->sicnombretipofinalidadminister !!}</option>
                                    @endforeach
                                </select>
                                <span> 4) Finalidad de adquisición del servicio *</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-group has-float-label">
                                <select class="form-control form-control-sm custom-select validate[required]" name="tiempoConflicto" id="tiempoConflicto">
                                    <option value=" ">- Seleccione una opcion -</option>
                                    @foreach ($data['tiempoConflicto'] as $info)
                                        <option value="{{$info->sicidtiempoconflicto}}">{!! $info->sictiempoconflicto !!}</option>
                                    @endforeach
                                </select>
                                <span> 5) Cuanto hace que se inició el conflicto? *</span>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span><h6> 6) Existe definición de asunto jurídico? *</h6></span>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" onclick="busquedaArea('SI')">
                                <label class="custom-control-label" for="customRadioInline1">SI</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" onclick="busquedaArea('NO')">
                                <label class="custom-control-label" for="customRadioInline2">NO</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6" id="area">
                            <!-- AREA -->
                        </div>
                        <div class="col-md-6" id="tema">
                            <!-- TEMA -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="subTema">
                        <!-- SUB TEMA -->
                        </div>
                    </div>


                </div>
                <hr>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4" id="btnRegistrar">
                        <button type="submit" class="btn btn-primary btn-block btn-sm" >&nbsp;<span class="fa fa-save"> </span> REGISTRAR</button>
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
        $.ajax({
            type: "POST",
            url: "registroConciliacion",
            dataType: 'text',
            data: $("#frmRegistroDatos").serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){llamarNotyCarga();},
            success: function(r){
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
                        timeout:5000,
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

    $('#fecSolicitud').datetimepicker({
        startDate:	'+1970/01/01',
        lang:'es',
        format:'d/m/Y', //format:'d/m/Y H:i',
        maxDate:0, // Bloquea días futuros
        timepickerScrollbar:false,
        timepicker:false,
        scrollMonth:false,
        closeOnDateSelect: true,
    });

    function busquedaArea(dato){
        $.ajax({
            url:'comboAreaAsuntoJuridico',
            type:"POST",
            data:{dato:dato},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(respuesta){
                $("#area").html(respuesta);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest);
            }
        })
    }

    function busquedaTema(dato){
        $.ajax({
            url:'comboTemaAsuntoJuridico',
            type:"POST",
            data:{dato:dato},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(respuesta){
                $("#tema").html(respuesta);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest);
            }
        })
    }

    function busquedaSubTema(dato){
        $.ajax({
            url:'comboSubTemaAsuntoJuridico',
            type:"POST",
            data:{dato:dato},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(respuesta){
                if(respuesta!=0){
                    $('#subTema').show();
                    $("#subTema").html(respuesta);
                }else{
                    $('#subTema').hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest);
            }
        })
    }
</script>