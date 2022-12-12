
<script type="text/javascript">
    $('#modal').modal({backdrop: 'static', keyboard: false});
    $('#modal').modal('show');
</script>

<div class="modal fade bd-example-modal-xl" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form name="frmRegistroDatos" id="frmRegistroDatos">
                <input type="hidden" value="{{$data['numSolicitud']}}" name="numSolicitud" id="numSolicitud">
                <input type="hidden" value="{{$data['rol']}}" name="rol" id="rol">
                <input type="hidden" value="{{$data['tipo']}}" name="tipo" id="tipo">
                <div class="alert" role="alert" style="background-color: #003E65; color: white;">
                    <div class="row">
                        <div class="col-md-12 text-md-center">
                            <p class="text-xs-center"><strong>{{$data['tipo']}} DE LA CONCILIACIÓN {{$data['numSolicitud']}} PARA EL {{$data['rol']}}<br><small>Todos los campos con asterisco (*) son obligatorios</small></strong></p>
                        </div>
                    </div>
                </div>

                <div class="modal-body">

                    @empty($data['datosApoderado'])
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <select class="form-control form-control-sm custom-select validate[required]" name="tipoDocumento" id="tipoDocumento" onchange="anonimo(this.value)" >
                                        <option value=" ">- Seleccione una opcion -</option>
                                        @foreach ($data['listaTiposDoc'] as $info)
                                            <option value="{{$info->sicidtipodocumentoidentidad}}">{!! $info->sictipodocumentoidentidad !!}</option>
                                        @endforeach
                                    </select>
                                    <span> 1) Tipo de Documento *</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control form-control-sm validate[required]" name="numeroDocuemnto" id="numeroDocuemnto" autocomplete="off">
                                    <span> 2) Numero de Documento *</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control form-control-sm validate[required]" name="ciudadExpedicion" id="ciudadExpedicion" autocomplete="off">
                                    <span> 3) Ciudad de Expedicion *</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <select class="form-control form-control-sm custom-select validate[required]" name="tipoPersona" id="tipoPersona">
                                        <option selected value="">-Seleccione Dato-</option>
                                        <option value="NATURAL">PERSONA NATURAL</option>
                                        <option value="JÚRIDICA">PERSONA JURÍDICA</option>
                                        <option value="NO INFORMA">NO INFORMA</option>
                                    </select>
                                    <span> 4) Tipo Persona *</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control form-control-sm validate[required]" name="primerNombre" id="primerNombre" autocomplete="off">
                                    <span> 5) Primer Nombre *</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control form-control-sm validate[optional]" name="segundoNombre" id="segundoNombre" autocomplete="off">
                                    <span> 6) Segundo Nombre</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control form-control-sm validate[required]" name="primerApellido" id="primerApellido" autocomplete="off">
                                    <span> 7) Primer Apellido *</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control form-control-sm validate[optional]" name="segundoApellido" id="segundoApellido" autocomplete="off">
                                    <span> 8) Segundo Apellido </span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control form-control-sm validate[optional]" name="direccion" id="direccion" autocomplete="off">
                                    <span> 9) Dirección </span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control form-control-sm validate[optional]" name="telefono" id="telefono" autocomplete="off">
                                    <span> 10) Telefono </span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control form-control-sm validate[optional]" name="email" id="email" autocomplete="off">
                                    <span> 11) Email </span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control form-control-sm validate[optional]" name="webPage" id="webPage" autocomplete="off">
                                    <span> 12) Pagina Web </span>
                                </label>
                            </div>
                        </div>
                    @endempty
                    @empty(!$data['datosApoderado'])
                            @foreach ($data['datosApoderado'] as $info)
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-group has-float-label">
                                        <input type="text" class="form-control form-control-sm validate[required]" name="numeroDocuemnto" id="numeroDocuemnto" value="{{$info->sicidentificacion}}" readonly>
                                        <span> 1) Numero de Documento *</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-group has-float-label">
                                        <input type="text" class="form-control form-control-sm validate[required]" name="primerNombre" id="primerNombre" value="{{$info->sicprimernombre}}" autocomplete="off">
                                        <span> 5) Primer Nombre *</span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-group has-float-label">
                                        <input type="text" class="form-control form-control-sm validate[optional]" name="segundoNombre" id="segundoNombre" value="{{$info->sicsegundonombre}}" autocomplete="off">
                                        <span> 6) Segundo Nombre</span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-group has-float-label">
                                        <input type="text" class="form-control form-control-sm validate[required]" name="primerApellido" id="primerApellido" value="{{$info->sicprimerapellido}}" autocomplete="off">
                                        <span> 7) Primer Apellido *</span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-group has-float-label">
                                        <input type="text" class="form-control form-control-sm validate[optional]" name="segundoApellido" id="segundoApellido" value="{{$info->sicsegundoapellido}}" autocomplete="off">
                                        <span> 8) Segundo Apellido </span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-group has-float-label">
                                        <input type="text" class="form-control form-control-sm validate[optional]" name="direccion" id="direccion" value="{{$info->sicdireccion}}" autocomplete="off">
                                        <span> 9) Dirección </span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-group has-float-label">
                                        <input type="text" class="form-control form-control-sm validate[optional]" name="telefono" id="telefono" value="{{$info->sictelefono}}" autocomplete="off">
                                        <span> 10) Telefono </span>
                                    </label>
                                </div>

                                <input type="hidden" name="email" id="email" value="{{$info->sicdireccion}}" autocomplete="off">
                                <input type="hidden" name="webPage" id="webPage" value="{{$info->sicpaginaweb}}" autocomplete="off">

                            </div>
                            @endforeach
                    @endempty
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
        $.ajax({
            type: "POST",
            url: "registroApoderadoRepLEgal",
            dataType: 'text',
            data: $("#frmRegistroDatos").serialize(),
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

    $('#fechaIntervencion').datetimepicker({
        startDate:  '+1970/01/01',
        lang:'es',
        format:'d/m/Y', //format:'d/m/Y H:i',
        maxDate:0, // Bloquea días futuros
        timepickerScrollbar:false,
        timepicker:false,
        scrollMonth:false,
        closeOnDateSelect: true,
    });

</script>