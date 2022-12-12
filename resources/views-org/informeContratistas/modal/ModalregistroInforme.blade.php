
<script type="text/javascript">
    $('#modal').modal({backdrop: 'static', keyboard: false});
    $('#modal').modal('show');
</script>
@php  $i=0; $j=0;  @endphp
<div class="modal" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header btn-primary">
                <div class="col-md-9">
                    <h5 class="modal-title" id="exampleModalLabel">Creación informe de ejecución</h5>
                </div>
                <div class="col-md-3 text-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
            <div class="modal-body">
                <form name="frmRegistroInforme" id="frmRegistroInforme" method="POST" enctype="multipart/form-data"  onKeyPress="return disableEnterKey(event)" onsubmit="return false;">
                    <br>
                    <!-- INICIA SECCIO DATOS BASICOS CONTRATO-JEFE-FECHAS -->
                    @foreach ($data['contratoActual'] as $info)

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="fechaPresentacion" id="fechaPresentacion" autocomplete="off" value="{{$data['lasDateOfMonth']}}">
                                    <span>1. Fecha de presetación *</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="fechaInicia" id="fechaInicia" autocomplete="off">
                                    <span>2. Fecha de inicio de la cuenta *</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="fechaTerminacion" id="fechaTerminacion" autocomplete="off">
                                    <span>3. Fecha de terminación de la cuenta*</span>
                                </label>
                            </div>
                        </div>
                        <hr width="60%">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="numeroPlanilla" id="numeroPlanilla" autocomplete="off" >
                                    <span>4. Número de planilla  *</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="fechaPagoPlanilla" id="fechaPagoPlanilla" autocomplete="off" >
                                    <span>5. Fecha pago de la planilla   *</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="numContrato" id="numContrato" autocomplete="off" value="{{ $info->num_contrato}}" readonly>
                                    <span>6. Número de contrato   *</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="vigenciaContrato" id="vigenciaContrato" autocomplete="off" value="{{ $info->vigencia}}" readonly>
                                    <span>7. Vigencia   *</span>
                                </label>
                            </div>
                        </div>
                        <hr width="60%">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-group has-float-label">
                                    <select class="form-control form-control-sm custom-select validate[required]" name="jefeId" id="jefeId" onchange="cambioJefe(this.value)">
                                        <option value=" ">- Seleccione una opcion -</option>
                                        <option selected value="{{$data['jefeId']}}">{!! $data['jefeNombre'] !!}</option>
                                        @foreach ($data['funcionariosDep'] as $info2)
                                            <option value="{{$info2->funcionario}}">{!! $info2->nombres_empleado !!}</option>
                                        @endforeach
                                    </select>
                                    <span>8. Seleccione el Supervisor *</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="jefeCargo" id="jefeCargo" autocomplete="off" value="{!! $data['jefeNombreCargo'] !!}" readonly>
                                    <span>9. Cargo Supervisor   *</span>
                                </label>
                            </div>
                        </div>

                        <div class="alert alert-secondary" role="alert">
                            <strong>Objeto del contrato:</strong><br>
                            {!! $info->objeto !!}
                        </div>
                        <input type="hidden" name="jefeGradoCargo" id="jefeGradoCargo" value="{{  $data['jefeGradoCargo']   }}">
                        <input type="hidden" name="jefeEncargo" id="jefeEncargo" value="{{$data['jefeEncargo'] }}">

                    @endforeach
                    <!-- FINALIZA SECCIO DATOS BASICOS CONTRATO-JEFE-FECHAS -->
                    <!-- INICIA SECCION OBLIGACIONES -->
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Obligaciones especificas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Obligaciones generales</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            @foreach ($data['obligacionesEsp'] as $info)
                                @php  $i++;  @endphp
                                <input type="hidden" name="datosActividad_++_{{$info->item}}" value="{{$info->item}}_ROOT_{{$info->secuencia}}_ROOT_{{$info->obligacion_de}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-group has-float-label">
                                            <textarea class="form-control validate[optional]"  rows="2" cols="2" name="obligacion++_{{$info->item}}" readonly> {!! $info->obligacion !!} </textarea>
                                            <span>Obligación  Numero{{ $i }} </span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-group has-float-label">
                                            <textarea class="form-control validate[optional,maxSize[2000]]" name="actividad_++_{{$info->item}}"  rows="2" cols="2"> </textarea>
                                            <span>Actividad * </span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-group has-float-label">
                                            <textarea class="form-control validate[optional,maxSize[2000]]" name="Soporte_++_{{$info->item}}"  rows="2" cols="2"> </textarea>
                                            <span>Soporte *</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            @foreach ($data['obligacionesGen'] as $info)
                                @php  $i++; $j++;  @endphp
                                <input type="hidden" name="datosActividad_++_{{$info->item}}" value="{{$info->item}}_ROOT_{{$info->secuencia}}_ROOT_{{$info->obligacion_de}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-group has-float-label">
                                            <textarea class="form-control validate[optional]" rows="2" cols="2" name="obligacion++_{{$info->item}}" readonly> {!! $info->obligacion !!} </textarea>
                                            <span>Obligación Numero{{ $j }} </span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-group has-float-label">
                                            <textarea class="form-control validate[optional,maxSize[2000]]" name="actividad_++_{{$info->item}}"  rows="2" cols="2"> </textarea>
                                            <span>Actividad * </span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-group has-float-label">
                                            <textarea class="form-control validate[optional,maxSize[2000]]" name="Soporte_++_{{$info->item}}"  rows="2" cols="2"> </textarea>
                                            <span>Soporte *</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="cantidadObligaciones" id="cantidadObligaciones" value="{{ $i }}">
                    <!-- FIN SECCION OBLIGACIONES -->

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-block" type="submit">Registrar la  modificación <i class="fas fa-save"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    function disableEnterKey(e){
        var key;
        if(window.event){ key = window.event.keyCode;  }else{ key = e.which; }
        if(key==13){ return false; }else{ return true; }
    }

    $(document).ready(function(){
        //FUNCION PARA VERIFICACION DE CAMPO DE frmSolicitudPermisos
        $("#frmRegistroInforme").validationEngine('attach',{
            onValidationComplete:function(form, status) {
                if (status === true) {
                    envioDatosRegistroPermisos();
                } else {
                    llamarNotyFaltanDatosFrm();
                    return;
                }
            }
        });
    })

    function envioDatosRegistroPermisos(){
        $.ajax({
            type: "POST",
            url: "/registroInformeEjecucion",
            dataType: 'text',
            data: $("#frmRegistroInforme").serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){llamarNotyCarga();},
            success: function(r){
                var datUsr=r.split("|");
                var valor=datUsr[1];
                var msg=datUsr[2];
                if(valor==0) {
                    var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
                    var layout='topRight';
                    var timeout=2000;
                    var type='error';
                    llamarNotyTime(type,msg,layout,timeout);
                }else{
                    var msg="<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" +msg;
                    new Noty({
                        text: msg,
                        type: 'success',
                        layout: 'center',
                        theme: 'bootstrap-v4',
                        killer:true,
                        progressBar:true,
                        timeout:6000,
                        callbacks: {
                            afterClose: function() {
                                setTimeout("location.reload(true);",1);
                            },
                        }
                    }).show();
                }
            }
        });
    }

    $('#fechaPresentacion').datetimepicker({
        startDate:  '+1970/01/01',
        lang:'es',
        format:'d/m/Y',
        timepickerScrollbar:false,
        timepicker:false,
        scrollMonth:false,
        closeOnDateSelect: true,
    });

    $('#fechaInicia').datetimepicker({
        startDate:  '+1970/01/01',
        lang:'es',
        format:'d/m/Y',
        maxDate:0,
        timepickerScrollbar:false,
        timepicker:false,
        scrollMonth:false,
        closeOnDateSelect: true,
    });

    $('#fechaTerminacion').datetimepicker({
        startDate:'+1970/01/01',
        lang:'es',
        format:'d/m/Y',
        timepickerScrollbar:false,
        timepicker:false,
        scrollMonth:false,
        closeOnDateSelect: true,
    });

    $('#fechaPagoPlanilla').datetimepicker({
        startDate:  '+1970/01/01',
        lang:'es',
        format:'d/m/Y',
        maxDate:0,
        timepickerScrollbar:false,
        timepicker:false,
        scrollMonth:false,
        closeOnDateSelect: true,
    });

    function cambioJefe(dato){
        $.ajax({
            url:"/consultaCargoFuncionario",
            type: "GET",
            data: { idFuncionario: dato },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(r){
                $('#jefeCargo').val(r);
            }
        })
    }
</script>