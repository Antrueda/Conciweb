
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
                    <input type="hidden" name="numContrato" value="{{ $data['num_contrato'] }}">
                    <input type="hidden" name="interno_oc" value="{{ $data['InternoOc'] }}">
                    <input type="hidden" name="id_informe" value="{{ $data['idInforme'] }}">
                    <!-- INICIA SECCIO DATOS BASICOS CONTRATO-JEFE-FECHAS -->
                    @foreach ($data['datosDelInforme'] as $info)
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="fechaPresentacion" id="fechaPresentacion" autocomplete="off" value="{{ date('d/m/Y', strtotime($info->fecha_presentacion)) }}">
                                    <span>1. Fecha de presetación *</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="fechaInicia" id="fechaInicia" autocomplete="off" value="{{ date('d/m/Y', strtotime($info->per_ini_informe)) }}">
                                    <span>2. Fecha de inicio de la cuenta *</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="fechaTerminacion" id="fechaTerminacion" autocomplete="off" value="{{  date('d/m/Y', strtotime($info->per_fin_informe)) }}">
                                    <span>3. Fecha de terminación de la cuenta*</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="numeroPlanilla" id="numeroPlanilla" autocomplete="off" value="{{ $info->num_planilla_pago}}">
                                    <span>4. Número de planilla  *</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="fechaPagoPlanilla" id="fechaPagoPlanilla" autocomplete="off" value="{{  date('d/m/Y', strtotime($info->fecha_pago)) }} " >
                                    <span>5. Fecha pago de la planilla   *</span>
                                </label>
                            </div>
                        </div>
                    @endforeach

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
                                    <span>6. Seleccione el Supervisor *</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-group has-float-label">
                                    <input class="form-control form-control validate[required]" type="text" name="jefeCargo" id="jefeCargo" autocomplete="off" value="{!! $data['jefeNombreCargo'] !!}" >
                                    <span>7. Cargo Supervisor   *</span>
                                </label>
                            </div>
                        </div>

                        <input type="hidden" name="tipoContrato" id="tipoContrato" value="{{ $data['tipoContrato'] }}">
                        <input type="hidden" name="jefeGradoCargo" id="jefeGradoCargo" value="{{  $data['jefeGradoCargo']   }}">
                        <input type="hidden" name="jefeEncargo" id="jefeEncargo" value="{{$data['jefeEncargo'] }}">
                        <input type="hidden" name="vigenciaContrato" id="vigenciaContrato" value="{{$data['vigencia_contrato'] }}">

                        <hr width="60%">
                        <!-- FINALIZA SECCIO DATOS BASICOS CONTRATO-JEFE-FECHAS -->
                        <!-- INICIA SECCION OBLIGACIONES -->

                        @foreach ($data['obligacionesRegistradas'] as $info)
                            @php  $i++;  @endphp @if($info->tipo_oblig=='G') @php $j++ @endphp @endif
                            <input type="hidden" name="datosActividad_++_{{$info->id_obligacion}}" value="{{$info->id_obligacion}}_ROOT_{{$info->secuencia}}_ROOT_{{$info->tipo_oblig}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-group has-float-label">
                                        <textarea class="form-control validate[required, minSize[20]]" rows="2" cols="2" readonly> {!! $info->obligacion_contractual !!} </textarea>
                                        <span> <strong>Obligación  @if($info->tipo_oblig=='C') Especifica numero {{$i}} @else General numero {{$j}} @endif</strong></span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-group has-float-label">
                                        <textarea class="form-control validate[optional,maxSize[2000]]" name="actividad_++_{{$info->id_obligacion}}"  rows="2" cols="2">  {!! $info->actividad_realizada !!}</textarea>
                                        <span>Actividad * </span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-group has-float-label">
                                        <textarea class="form-control validate[optional,maxSize[2000]]" name="Soporte_++_{{$info->id_obligacion}}"  rows="2" cols="2"> {!! $info->soportes !!} </textarea>
                                        <span>Soporte *</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
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
            url: "/registroEdicionInformeEjecucionV3",
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
