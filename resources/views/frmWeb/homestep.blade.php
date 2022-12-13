@extends('../mainUsrWeb')

@section('title','DATOS DEL DE CIUDADANO')

@section('AddScritpHeader')

@endsection

@section('content')

<form name="frmRegistroDatos" enctype="multipart/form-data" id="frmRegistroDatos">

<style>
    .step{
        height: 50px;
        width: 50px;
        line-height: 40px;
        margin: 0 2px;
        color: white;
        background: #0d6efd;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.25;
}
</style>
    <div class="row">
        <center>
        <div class="col-md-6">
            <h5><b class="text-justify">SOLICITUD DE CONCILIACIÓN</b></h5>
        </div>
    </center>
        <div class="col-md-1"> </div>
        {{-- <div class="col-md-4 text-block"><img src="{{URL::asset('imagen/logo-personeria-azul.png')}}" class="rounded mx-auto d-block" width="50%"></div> --}}
    </div>
    <br>
    <div style="text-align:center;">
        <span class="step" id = "step-1"><i class="fas fa-info"></i></span>
        <span class="step" id = "step-2"><i class="fa fa-users nav-icon"></i></span>
        <span class="step" id = "step-3"><i class="fas fa-user-tie"></i></span>
        <span class="step" id = "step-4"><i class="fas fa-clipboard-list"></i></span>
      </div>
      {{-- <div style="text-align:center;">
        <span class="step" id = "step-1"></span>
        <span class="step" id = "step-2"></span>
        <span class="step" id = "step-3"></span>
        <span class="step" id = "step-4"></span>
      </div> --}}
      <br>
 
    <!-- INICIO DATOS DEL SOLICITANTE -->
    <div class="card tab" id="tab-1"">
        <div class="card-header">
            <center>
            <b>DATOS DEL SOLICITANTE</b>
        </center>
        </div>
        <div class="card-body" style="margin-bottom: 40px; height">
            <div class="row g-2">
                <div class="col-md-6">
                    <div class="form-floating">
         
                    {{ Form::select('tipoDocumento', $data['listaTipoDoc'], null, ['class' => $errors->first('tipoDocumento') ? 'form-select form-select-sm is-invalid' : 'form-select form-select-sm validate[required]'.'required','id'=>'tipoDocumento','aria-label'=>"Floating label select example"]) }}
                    @if($errors->has('tipoDocumento'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->first('tipoDocumento') }}
                        </div>
                    @endif
                    <label for="tipoDocumento">1. Tipo Documento *</label>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control form-control-sm validate" id="numeroDocumento" name="numeroDocumento" autocomplete="off" required placeholder="0">
                    <label for="numeroDocumento">2. No. de cédula *</label>
                  </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm validate" name="primerNombre" id="primerNombre" autocomplete="off" placeholder="0">
                        <label for="primerNombre">3. Primer Nombre *</label>
                    </label>
                </div>
                </div>

                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="segundoNombre" id="segundoNombre" autocomplete="off" placeholder="0">
                        <label for="segundoNombre">4. Segundo Nombre</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" name="primerApellido" id="primerApellido" autocomplete="off" placeholder="0">
                        <label for="primerApellido">5. Primer Apellido*</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="segundoApellido" id="segundoApellido" autocomplete="off" placeholder="0">
                        <label for="segundoApellido">6. Segundo Apellido</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" name="primerTelefono" id="primerTelefono" autocomplete="off" placeholder="0"  min="10" max="10">
                        <label for="primerTelefono">7. Teléfono celular *</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" min="7" max="10" name="segundoTelefono" id="segundoTelefono" autocomplete="off" placeholder="0">
                        <label for="segundoTelefono">8. Teléfono fijo</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" name="direccion" id="direccion" autocomplete="off" placeholder="0">
                        <label for="direccion">9. Dirección *</label>
                    </div>
                </div>
                <div class="col-md-3">
    
                        <div class="form-floating mb-3">
      
                    {{ Form::select('localidad', $data['listaLocalidades'], null, ['class' => $errors->first('localidad') ? 'form-select form-select-sm is-invalid' : 'form-select form-select-sm']) }}
                    @if($errors->has('localidad'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->first('localidad') }}
                        </div>
                    @endif
                    <label for="localidad"> 10. Localidad</label>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                    
                        <input type="email" class="form-control form-control-sm validate[required, custom[email]]" name="email" id="email" autocomplete="off" placeholder="0">
                        <label for="email"> 11. Correo electrónico *</label>
                     </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailCon" id="emailCon" autocomplete="off" placeholder="0">
                        <label for="emailCon"> 11.1. Confirme correo electrónico *</label>
                    </div> 
                </div>

            </div>

            <!-- INICIO TIPO DE SOLICITUD -->
            <div class="row">
                <div class="col-md-3">
                    
                    <div class="form-floating mb-3">
                        <select class="form-control form-control-sm custom-select validate[required]" name="tipoSolicitud" id="tipoSolicitud" onchange = 'doc(this.value)' required>
                            <option value=" ">- Seleccione una opcion -</option>
                            <option value="0">Directa</option>
                            <option value="1">Apoderado</option>
                        </select>
                        <label for="tipoSolicitud"> 12. Tipo de Solicitud *</label>
                    </div> 
                </div>
            </div>
            <!-- FIN TIPO SOLICITUD -->
            <center>
                <div class="btn btn-primary" onclick="run(1, 2);" style="width: 120px">Siguiente <i class="fas fa-angle-right"></i></div>
            </center>
            <br>
        </div>

    </div>
    <!-- FIN DATOS DEL SOLICTANTE -->
    <!-- INICIO DATOS DE LOS CONVOCADOS -->
    <div class="card tab" id="tab-2">
        <div class="card-header">
            <center>
            <b>DATOS DEL CONVOCADO/S</b>
        </center>
        </div>
        <div class="card-body">
            <p class="text-justify">Si es un numero plural de convocados indique los correos electrónicos de cada uno de ellos. Se advierte que la invitación a la audiencia de conciliación virtual se realizará por correo electrónico, y por tanto deben ser verídicos. Si no cuenta con ellos, adelante la solicitud de conciliación presencial en la Sedes de Conciliación del Personería de Bogotá D.C. que se encuentra publicadas en la página web de la Entidad.</p>
            <div class="agregar">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm validate" name="nomConvocante[]" id="nomConvocante" autocomplete="off" placeholder="0">
                        <label for="nomConvocante">Nombre completo convocado</label>
                    </label>
                </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                    
                        <input type="email" class="form-control form-control-sm validate[required, custom[email]]" name="emailConvocante[]" id="emailConU" autocomplete="off" placeholder="0">
                        <label for="email"> Correo electronico</label>
                     </div> 
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailCon" id="emailConUC" autocomplete="off" placeholder="0">
                        <label for="emailCon"> Confirme correo electronico</label>
                    </div> 
                </div>
                <div class="col-md-3">
                <button type="button" class="btn btn-primary" id="add_btn" style="height: 50px; width: 120px">Agregar <i class="fas fa-plus"></i></button>
              </div>
            </div>
 
        </div>
            {{-- <table class="table">
                <thead class="thead">
                  <tr>
                    <th scope="col">Nombre completo convocado</th>
                    <th scope="col">Correo electronico</th>
                    <th scope="col">Confirme correo electronico</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" class="form-control form-control-sm validate" name="nomConvocante[]" autocomplete="off"></td>
                    <td><input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailConvocante[]" id="emailConU" autocomplete="off"></td>
                    <td><input type="text" class="form-control form-control-sm validate[required, custom[email]]" id="emailConUC" autocomplete="off"></td>
                    <td><button type="button" class="btn btn-primary" id="add_btn">Agregar</i></button></td>
                  </tr>
                 
                </tbody>
              </table> --}}
           
        </div>
        <div id="apode_id">
        <center>
        <div class="btn btn-primary" onclick="run(2, 1);" style="width: 120px"><i class="fas fa-angle-left"></i> Anterior</div>
        <div class="btn btn-primary" onclick="run(2, 3);" style="width: 120px">Siguiente<i class="fas fa-angle-right"></i></div>
        </center>
        </div>
        <div id="dire_id">

            <center>
            <div class="btn btn-primary" onclick="run(2, 1);" style="width: 120px"><i class="fas fa-angle-left"></i> Anterior</div>
            <div class="btn btn-primary" onclick="run(2, 4);" style="width: 120px">Siguiente<i class="fas fa-angle-right"></i></div>
            </center>
            </div>
        <br>
    </div>

    <!-- FIN DATOS DE LOS CONVOCADOS -->

    <!-- INICIO DATOS DEL APODERADO -->
    <div id="seccionApoderado">

        <div class="card tab" id="tab-3">
            <div class="card-header">
                <center>
                <b>DATOS DEL APODERADO</b>
            </center>
            </div>
            <div class="card-body" >
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            {{ Form::select('tipoDocApoderado', $data['listaTipoDoc'], null, ['class' => $errors->first('tipoDocApoderado') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm']) }}
                        @if($errors->has('tipoDocApoderado'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('tipoDocApoderado') }}
                            </div>
                        @endif
                        <label for="tipoDocApoderado"> 11.1. Tipo Documento *</label>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm validate[required, minSize[4], maxSize[10]]" name="numDocApoderado" id="numDocApoderado" autocomplete="off" placeholder="0">
                            <label for="numDocApoderado"> 11.2. No. de cédula *</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm validate" name="primerNombreApoderado" id="primerNombreApoderado" autocomplete="off" placeholder="0">
                            <label for="primerNombreApoderado"> 11.3. Primer Nombre *</label>
                           
                        </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm" name="segundoNombreApoderado" id="segundoNombreApoderado" autocomplete="off" placeholder="0">
                            <label for="segundoNombreApoderado"> 11.4. Segundo Nombre</label>
                        </label>
                    </div>
                </div>
                    <div class="col-md-3">
                      <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm validate" name="primerApellidoApoderado" id="primerApellidoApoderado" autocomplete="off" placeholder="0">
                            <label for="primerApellidoApoderado"> 11.5. Primer Apellido *</label>

                        </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm" name="segundoApellidoApoderado" id="segundoApellidoApoderado" autocomplete="off" placeholder="0">
                            <label for="segundoApellidoApoderado"> 11.6. Segundo Apellido</label>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                      <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm validate" name="tarjetaProfesional" id="tarjetaProfesional" autocomplete="off" placeholder="0">
                            <label for="tarjetaProfesional"> 11.7. No. tarjeta Profesional *</label>
                
                        </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm" name="direccionApoderado" id="direccionApoderado" autocomplete="off" placeholder="0">
                            <label for="tarjetaProfesional"> 11.8. Dirección *</label>
                           
                        </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm validate[required, minSize[10], maxSize[10]]" name="primerTelefonoApoderado" id="primerTelefonoApoderado" autocomplete="off" placeholder="0">
                            <label for="primerTelefonoApoderado"> 11.9. Teléfono Celular *</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm validate[required minSize[7], maxSize[10]]" name="segundoTelefonoApoderado" id="segundoTelefonoApoderado" autocomplete="off" placeholder="0">
                            <label for="segundoTelefonoApoderado"> 11.10. Teléfono fijo</label>
               
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailApoderado" id="emailApoderado" autocomplete="off" placeholder="0">
                            <label for="emailApoderado"> 11.10. Teléfono fijo</label>
                 
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailApoderadoCon" id="emailApoderadoCon" autocomplete="off" placeholder="0">
                            <label for="emailApoderadoCon"> 11.12. Confirme correo electronico *</label>
                        </div>
                    </div>
                </div>
            </div>
            <center>
            <div class="btn btn-primary" onclick="run(3, 2);" style="width: 120px"><i class="fas fa-angle-left"></i> Anterior</div>
            <div class="btn btn-primary" onclick="run(3, 4);" style="width: 120px">Siguiente <i class="fas fa-angle-right"></i></div>
        </center>
        <br>
        </div>
        <!--
        <div class="form-group row">
            <div class="col-sm-3">
            <img src="{{URL::asset('imagen/lawyer.svg')}}" width="30px" class="img-fluid"> DATOS DEL APODERADO</div>
            <div class="col-sm-9">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    -->
    </div>
    <!-- FIN DATOS DEL APODERADO -->
    <!-- INICIO TIPO DE AUDIENCIA -->
    <div id="askAudienciaPresencial">

        <div class="card tab" id="tab-4">
            <div class="card-header">
                <center>
                <b>DATOS DE LA AUDIENCIA</b>
            </center>
            </div>
            <div class="card-body">

                <div id="tipoAudienciaSeleccion" style="display: none">

                    <div class="alert alert-success" role="alert">
                     
                        <small class="text-justify">{!! $data['mensaje']->texto !!}</small>
                      
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label class="form-group has-float-label">
                                <select class="form-control form-control-sm custom-select validate[required]" name="tipoAudiencia" id="tipoAudiencia">
                                    <option value=" ">- Seleccione una opcion -</option>
                                    <option value="0">Presencial</option>
                                    <option value="1">Virtual</option>
                                </select>
                                <span>13. Tipo de Audiencia *</span>
                            </label>
                        </div>
                        <!-- INICIO SEDES -->
                        <div id="sedesConciliacion" style="display: none">
                            <div class="row">
                                <div class="col-6">
                                    {{ Form::label('sedePrincipal', '13.1. Centro de conciliación principal *', ['class' => 'control-label col-form-label-sm']) }}
                                    {{ Form::select('sedePrincipal', $data['listaSedes'], null, ['class' => $errors->first('sedePrincipal') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm']) }}
                                    @if($errors->has('sedePrincipal'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('sedePrincipal') }}
                                        </div>
                                    @endif
                                  
                                </div>
                                <div class="col-6">
                                    {{ Form::label('sedeSecundaria', '13.2. Centro de conciliación secundaria *', ['class' => 'control-label col-form-label-sm']) }}
                                    {{ Form::select('sedeSecundaria', $data['listaSedes'], null, ['class' => $errors->first('sedeSecundaria') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm']) }}
                                    @if($errors->has('sedeSecundaria'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('sedeSecundaria') }}
                                        </div>
                                    @endif
                                
                                </div>
                            </div>
                        </div>
                        <!-- FIN SEDES -->
                    </div>
                </div>


                <!-- INICIO DATOS AUDIENCIA -->
                <div id="datosConciliacion">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                 
                        {{ Form::select('asunto', $data['listaAsuntos'], null, ['class' => $errors->first('asunto') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm','id'=>'asunto']) }}
                            @if($errors->has('asunto'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('asunto') }}
                                </div>
                            @endif
                            <label for="asunto"> 14. Asunto *</label>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <select class="form-control form-control-sm custom-select validate[required]" name="subAsunto" id="subAsunto">
                                    <option value=" ">- Seleccione una opcion -</option>
                                </select>
                                <label for="subAsunto"> 14.1. Sub Asunto *</label>
                            </div>
                         
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control form-control-sm validate[required, maxSize[1000]]" name="detalle" id="detalle" placeholder="Resumen" ></textarea>
                                <label for="detalle"> 15. Resumen de la pretensión o conflicto (Máximo 1000 caracteres)*</label>
                                <span id="chars"></span>
                                </div>
             
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-justify">
                            <div class="alert alert-success text-justify" role="alert">
                                <small class="text-justify">La pretensión no podrá ser superior a <span style="color: red">100 SMMLV ($100.000.000)</span>, salvo que se trate de solicitudes de conciliación promovida por persona natural deudor hipotecario y por persona natural que reclame ser damnificado o victima el pago de indemnización de seguros de responsabilidad civil.</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input class="form-control form-control-sm validate" type="number" name="cuantia" id="cuantia" autocomplete="off" placeholder="0">
                                <label for="cuantia"> 16. Valor de la Cuantía *</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN DATOS AUDIENCIA -->
                <!-- INICIO ABC ASUNTO -->
                
                <div id="abcContenedor" style="display: none">
                    <div id="abcAsunto"></div>
                </div>
                <!-- FIN ABC ASUNTO -->
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="alert alert-success text-center" role="alert">
                        <small class="text-center" style="font-size: 100%"> <span id="valorCaptcha"></span> </small>
                    </div>
                </div>
                <div class="col-md-1 text-center" style="padding: .75rem 1.25rem;">
                    <span class="badge badge-light"><i class="fas fa-sync fa-2x" onclick="getCapchaValue()"></i></span>
                </div>
                <div class="col-md-3" style="padding: .75rem 1.25rem;">
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control form-control-sm validate" name="captcha" id="captcha" autocomplete="off" placeholder="0">
                        <input type="hidden" name="captchaOrg" id="captchaOrg">
                        <label for="captcha"> Digite los caracteres de la imagen *</label>
     
                    </div>
                </div>
                <center>
                <div class="btn btn-primary" onclick="run(4, 3);" id="full_div" style="width: 120px"><i class="fas fa-angle-left"></i> Anterior</div>
                <div class="btn btn-primary" onclick="run(4, 2);" id="audi_div" style="width: 120px"><i class="fas fa-angle-left"></i> Anterior</div>
                <br>
                <hr>
                <div class="row" id="btnRegistro" style="display:none">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block btn-sm "><span class="fa fa-save pr-4"> </span> Registrar Solicitud </button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                </center>
                <br>
                <div class="col-md-2"></div>
            </div>
        </div>
        <br>
       
    </div>
    <!-- FIN TIPO DE AUDIENCIA -->



    <br>
</form>

<div id="modalRespuesta"></div>

@endsection

@section('AddScriptFooter')

<script>
    //Cargar modal con mensaje de bienvenida
    $(document).ready(function() {
        modalBienvendia();
        getCapchaValue();
        validarEstadoTipoAudiencia();
        validarCcEmail();
        $("#frmRegistroDatos").validationEngine('attach', {
            onValidationComplete: function(form, status) {
                if ($("#captchaOrg").val() !== $("#captcha").val()) {
                    errorCaptcha();
                    return;
                }
                if ($("#email").val() !== $("#emailCon").val()) {
                    errorEmailIgual();
                    return;
                }
                if ($("#emailApoderado").val() !== $("#emailApoderadoCon").val()) {
                    errorEmailIgualApod();
                    return;
                }
                if ($("#emailConU").val() !== $("#emailConUC").val()) {
                    errorEmailICon('primer');
                    return;
                }
                if ($("#emailConD").val() !== $("#emailConDC").val()) {
                    errorEmailICon('segundo');
                    return;
                }
                if ($("#emailConT").val() !== $("#emailConTC").val()) {
                    errorEmailICon('tercer');
                    return;
                }
                if (status === true) {
                    registroDatos();
                } else {
                    llamarNotyFaltanDatosFrm();
                    return;
                }
            }
        });
    });
    //Error en comparacion de email
    function errorEmailIgual() {
        var msg = "Los correos electrónicos del solicitante en el campo 11 y 11.1 no son iguales. Por favor verifíquelos.  ";
        var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }

    function TipoSolicitud() {
        var msg = "12. Seleccione un tipo de solicitud.  ";
        var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }
    //Error en comparacion de email Apoderado
    function errorEmailIgualApod() {
        var msg = "Los correos electrónicos del apoderado en el campo 11.11 y 11.12 no son iguales Por favor verifíquelos.  ";
        var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }
    //Error de email igual para convocados
    function errorEmailICon(dato) {
        var msg = "Los correos electrónicos del " + dato + " convocado no son iguales Por favor verifíquelos.  ";
        var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }
    //Inactivar control c en email 
    function validarCcEmail() {
        $('#emailCon').on("paste", function(e) {
            $("#emailCon").text('Copiar. no esta permitido!');
            e.preventDefault();
        });
        $('#emailApoderadoCon').on("paste", function(e) {
            $("#emailApoderadoCon").text('Copiar. no esta permitido!');
            e.preventDefault();
        });
        $('#emailConUC').on("paste", function(e) {
            $("#emailConUC").text('Copiar. no esta permitido!');
            e.preventDefault();
        });
        $('#emailConDC').on("paste", function(e) {
            $("#emailConDC").text('Copiar. no esta permitido!');
            e.preventDefault();
        });
        $('#emailConTC').on("paste", function(e) {
            $("#emailConTC").text('Copiar. no esta permitido!');
            e.preventDefault();
        });
    }
    //Validar si el estado tipo de audiencia esta o no activo
    function validarEstadoTipoAudiencia() {
        let indicadorTipoAudi = $('#estadoTipoAudi').val();
        if (indicadorTipoAudi == 0) {
            $("#tipoAudienciaSeleccion").show();
        } else {
            $("#tipoAudienciaSeleccion").hide();
        }
        $("#datosConciliacion").show(); //Mostrar campos de la conciliacion 
    }
    //Cambar a obligatorio
    $('#nomCon2').on('keyup', function() {
        $("#emailCon2").prop('required', true);
    });
    $('#nomCon3').on('keyup', function() {
        $("#emailCon3").prop('required', true);
    });
    //Restriccion cantidad de caracteres campo detalle
    $('#detalle').on('keyup', function() {
        limitText(this, 1000)
    });
    //Restriccion cantidad de caracteres campo celular
    $('#primerTelefono').on('keyup', function() {
        limitText(this, 10)
    });
    //Restriccion cantidad de caracteres campo celular APODERADO
    $('#primerTelefonoApoderado').on('keyup', function() {
        limitText(this, 10)
    });
    //Restriccion cantidad de caracteres campo captcha
    $('#captcha').on('keyup', function() {
        limitText(this, 5)
    });
    //Restriccion cantidad de caracteres campo numero documento
    $('#numeroDocumento').on('keyup', function() {
        limitText(this, 10)
    });
    //Restriccion cantidad de caracteres campo numero de documento apoderado
    $('#numDocApoderado').on('keyup', function() {
        limitText(this, 10)
    });
    $('#cuantia').on('keyup', function() {
        cuantiaVerificar(this)
    });

    function cuantiaVerificar(field) {
        var ref = $(field),
            val = ref.val();
        var str = $('#cuantia').val();
        str = str.replace(/\+/gi, ' ');
        $("#cuantia").val(str);
        if (val > 90852600) {
            var msg = "La pretensión no podrá ser superior a 100 SMMLV ($100.000.000), salvo que se trate de solicitudes de conciliación promovida por persona natural deudor hipotecario y por persona natural que reclame ser damnificado o victima el pago de indemnización de seguros de responsabilidad civil";
            var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
            llamarNotyTime('error', msg, 'center', 3000);
        }
    }
    //Funcion que limita la cantidad de caracteres en un campo
    function limitText(field, maxChar) {
        var ref = $(field),
            val = ref.val();
        if (val.length >= maxChar) {
            ref.val(function() {
                return val.substr(0, maxChar);
            });
        }
    }
    $('#add_btn').on('click',function(){
     var html='';
     html+='<br>'
     html+='<div class="row" id="lista">'
     html+='<div class="col-md-3">'
     html+='<div class="form-floating mb-3">'
     html+='<input type="text" class="form-control form-control-sm validate" name="nomConvocante[]" id="nomConvocante" autocomplete="off" placeholder="0">'
     html+='<label for="nomConvocante">Nombre completo convocado</label>'
     html+='</label>'
     html+='</div>'
     html+='</div>'
     html+='<div class="col-md-3">'
     html+='<div class="form-floating mb-3">'
     html+='<input type="email" class="form-control form-control-sm validate[required, custom[email]]" name="emailConvocante[]" id="email" autocomplete="off" placeholder="0">'
     html+='<label for="email"> Correo electronico</label>'
     html+='         </div>' 
     html+='    </div>'
     html+='    <div class="col-md-3">'
     html+='       <div class="form-floating mb-3">'
     html+='           <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailCon" id="emailConUC" autocomplete="off" placeholder="0">'
     html+='           <label for="emailCon"> Confirme correo electronico</label>'
     html+='       </div>' 
     html+='     </div>'
     html+='<div class="col-md-3">'
     html+='<button type="button" class="btn btn-primary" id="remove" style="height: 50px; width: 120px">Eliminar <i class="fas fa-minus"></i></button>'
     html+='   </div>';
     html+='</div>'
     html+='<br>'

     /*

        tbody
     html+='<tr>';
     html+='<td><input type="text" class="form-control form-control-sm validate" name="nomConvocante[]" autocomplete="off"></td>';
     html+='<td><input type="text" class="form-control form-control-sm" name="emailConvocante[]" id="emailConU" autocomplete="off"></td>';
     html+='<td><input type="text" class="form-control form-control-sm" id="emailConUC[]" autocomplete="off"></td>';
     html+='<td><button type="button" class="btn btn-primary" id="remove"><i class="fas fa-minus"></i></button></td>';
     html+='</tr>';
     html+='<br>
     html+='<div class="row">
     html+='<div class="col-md-3">
     html+='<div class="form-floating mb-3">
     html+='<input type="text" class="form-control form-control-sm validate" name="nomConvocante[]" id="primerNombre" autocomplete="off" placeholder="0">
     html+='<label for="nomConvocante">Nombre completo convocado</label>
     html+='</label>
     html+='</div>
     html+='</div>
     html+='<div class="col-md-3">
     html+='<div class="form-floating mb-3">
     html+='<input type="email" class="form-control form-control-sm validate[required, custom[email]]" name="emailConvocante[]" id="email" autocomplete="off" placeholder="0">
     html+='<label for="email"> Correo electronico</label>
     html+='         </div> 
     html+='    </div>
     html+='    <div class="col-md-3">
     html+='       <div class="form-floating mb-3">
     html+='           <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailCon" id="emailConUC" autocomplete="off" placeholder="0">
     html+='           <label for="emailCon"> Confirme correo electronico</label>
     html+='       </div> 
     html+='   </div>
     html+='<br>
     */
     $('.agregar').append(html);
    });
    $(document).on('click','#remove',function(){
            $(this).closest('#lista').remove();
        });

    //Registro de informacion en backend
    function registroDatos() {
        var formData = new FormData(document.getElementById("frmRegistroDatos"));
        formData.append("dato", "valor");
        $.ajax({
            type: "POST",
            url: "registroConciliacionWeb",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                llamarNotyCarga();
                $("#btnRegistro").hide();
            },
            success: function(r) {
                var datUsr = r.split("|");
                var valor = datUsr[1];
                var msg = datUsr[2];
                if (valor == 0) {
                    var msg = "<center><p><i class='fas fa-times fa-3x'></i></p></center>" + msg;
                    llamarNotyTime('error', msg, 'topRight', 3000);
                    $("#btnRegistro").show();
                } else {
                    $("#btnRegistro").hide();
                    var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
                    new Noty({
                        text: msg,
                        type: 'success',
                        layout: 'center',
                        theme: 'bootstrap-v4',
                        killer: true,
                        progressBar: true,
                        timeout: 5000,
                        callbacks: {
                            afterClose: function() {
                                window.location.href = "https://www.personeriabogota.gov.co/";
                            },
                        }
                    }).show();
                }
            },
            error: (err) => {
                var msg = "<center><p><i class='fas fa-times fa-3x'></i></p></center>" + msg;
                llamarNotyTime('error', msg, 'topRight', 3000);
                $("#btnRegistro").show();
            }
        });
    }
    //Abrir modal con mnesaje de bienvenida
    function modalBienvendia() {
        $.ajax({
            url: 'modalMensajeBienvenida',
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(respuesta) {
                $("#modalRespuesta").html(respuesta);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Algo anda mal' + textStatus);
                console.log(XMLHttpRequest);
            }
        })
    }
    //Mostrar segundo convocado
    $("#gridCheck1").change(function() {
        if ($("#gridCheck1").is(':checked')) {
            $("#divConvocante2").slideDown();
        } else {
            $("#divConvocante2").slideUp();
        }
    });
    //Mostrar tercer convocado
    $("#gridCheck2").change(function() {
        if ($("#gridCheck2").is(':checked')) {
            $("#divConvocante3").slideDown();
        } else {
            $("#divConvocante3").slideUp();
        }
    });
    // //Oncahge del select optio tipoSolicitud
    // $("#tipoSolicitud").change(function() {
    //     const tipoSolicitud = parseInt($("#tipoSolicitud").val());
    //     if (tipoSolicitud == 0) {
    //         //Solicitud - Directa
    //         $("#askAudienciaPresencial").slideDown(); //Pregunta Audiencia Presencial
    //         $("#seccionApoderado").slideUp(); //Ocultar seccion para msotrr los datos del apodedaro
    //     } else if (tipoSolicitud == 1) {
    //         //Solicitud - Apoderado
    //         $("#seccionApoderado").slideDown(); //Mostrar seccion para msotrr los datos del apodedaro
    //         $("#askAudienciaPresencial").slideDown(); //Pregunta Audiencia Presencial
    //     } else {
    //         alert('opcion no valida');
    //     }
    //     $.ajax({
    //         url: "solicitud",
    //         type: "POST",
    //         data: {
    //             tipoSolicitud: $("#tipoSolicitud").val()
    //         },
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(respuesta) {
    //             console.log( $("#tipoSolicitud").val());
    //          }
    //     })
    // });
    //Oncahge del select optio tipoAudiencia
    $("#tipoAudiencia").change(function() {
        const tipoAudiencia = parseInt($("#tipoAudiencia").val());
        if (tipoAudiencia == 0) {
            //Si
            $("#sedesConciliacion").show(); //Mostrar campos de sedes
            $("#datosConciliacion").show(); //Mostrar campos de la conciliacion 
        } else if (tipoAudiencia == 1) {
            //NO
            $("#sedesConciliacion").hide(); //OCulat campos de sedes
            $("#datosConciliacion").show(); //Mostrar campos de la conciliacion 
            $("#sedePrincipal").prop('selectedIndex', 0); //Reiniciar select option
            $("#sedeSecundaria").prop('selectedIndex', 0); //Reiniciar select option
        } else {
            alert('opcion o valida');
        }
    });
    //Desplegar combo lista detalle del asunto 
    $("#asunto").change(() => {
        $.ajax({
            url: "consultalistaSubAsuntos",
            type: "POST",
            data: {
                asunto: $("#asunto").val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                new Noty({
                    text: '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Cargando...</span></div></div>',
                    //type: 'info',
                    layout: 'center',
                    theme: 'bootstrap-v4',
                    killer: true,
                    progressBar: true,
                    timeout: 300,
                }).show();
            },
            success: function(opciones) {
                $('#subAsunto')
                    .find('option')
                    .remove()
                    .end()
                    .val('whatever');
                $('#subAsunto')
                    .append($("<option></option>")
                        .attr("value", ' ')
                        .text('- Seleccione una opcion -'));
                opciones.forEach(element => $('#subAsunto').append(new Option(element['nombre'], element['id'])));
            }
        })
    });

    //Extraer infromacion de documentos solicitados

    $("#subAsunto").change(() => {
        $.ajax({
            url: "consultaDocumentosRelacionados",
            type: "POST",
            data: {
                asunto: $("#asunto").val(),
                subAsunto: $("#subAsunto").val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(respuesta) {
                $("#abcAsunto").html(respuesta);
                // $("#abcContenedor").slideDown(); //Mostrar informacion ABC y input para documento adjunto
            }
        })
    });
    //Eliminar opcion preseleccionada en al primer campo
    $("#sedePrincipal").change(function() {
        var idSedeSeleccionada = $('#sedePrincipal').val();
        $("#sedeSecundaria option[value='" + idSedeSeleccionada + "']").each(function() {
            $(this).remove();
        });
    });
    //Funcionalidad de seleccionar o borrar documento
    function bs_input_file() {
        $(".input-file").before(
            function() {
                if (!$(this).prev().hasClass('input-ghost')) {
                    var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0' id='Fichier1'>");
                    element.attr("name", $(this).attr("name"));
                    element.change(function() {
                        element.next(element).find('input').val((element.val()).split('\\').pop());
                        processSelectedFiles(this);
                    });
                    $(this).find("button.btn-choose").click(function() {
                        element.click();
                    });
                    $(this).find("button.btn-danger").click(function() {
                        element.val(null);
                        $(this).parents(".input-file").find('input').val('');
                    });
                    $(this).find('input').css("cursor", "pointer");
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
    //Verificar extencion del documento adjuntado
    // function processSelectedFiles(fileInput) {
    //     var files = fileInput.files;
    //     for (var i = 0; i < files.length; i++) {
    //         var extension = files[i].name.split('.').pop(); // Obtengo la extensión
    //         var peso = (files[i].size) / 1024;
    //         if (peso >= 11001) {
    //             $(".input-file").val(''); //Aquí evluar cual es el input que hay que limpiar
    //             $(".input-file").find('input').val('');
    //             $("#document1").find('input').val('');
    //             var msg = 'El tipo del archivo seleccionado NO es valido.<br>Unicamente pueden adjuntar archivos con un peso menor a 10Mb:';
    //             var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
    //             llamarNotyTime('error', msg, 'topRight', 5000);
    //             $("#btnRegistro").hide();
    //             return;
    //         }
    //         //var nomFile = files[i].name;
    //         //var logitudNombre = nomFile.length - extension.length;
    //         if (extension != "pdf") {
    //             $(".input-file").val(''); //Aquí evluar cual es el input que hay que limpiar
    //             $(".input-file").find('input').val('');
    //             $("#document1").find('input').val('');
    //             var msg = 'El tipo del archivo seleccionado NO es valido.<br>Unicamente pueden adjuntar los siguientes tipos de archivo: ';
    //             msg = msg + ' [.pdf]';
    //             var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
    //             llamarNotyTime('error', msg, 'topRight', 5000);
    //             $("#btnRegistro").hide();
    //             return;
    //         }
    //         $("#btnRegistro").show();
    //     }
    // }

    (function($) {
            $.fn.extend( {
                limiter: function(limit, elem) {
                    $(this).on("keyup focus", function() {
                        setCount(this, elem);
                    });
                    function setCount(src, elem) {
                        var chars = src.value.length;
                        if (chars > limit) {
                            src.value = src.value.substr(0, limit);
                            chars = limit;
                        }
                        elem.html( chars+"/1000" );
                    }
                    setCount($(this)[0], elem);
                }
            });
        })(jQuery);
        var elem = $("#chars");
        $("#detalle").limiter(1000, elem);


    //Generar parametos de captcha
    function getCapchaValue() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789";

        for (var i = 0; i < 5; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        let valorCaptcha = text;
        $("#valorCaptcha").html(valorCaptcha);
        $("#captchaOrg").val(valorCaptcha);
    }
    //funciona con error del captcha
    function errorCaptcha() {
        var msg = 'El código de verificación captcha es invalido.<br>Por favor verifique el valor ingresado';
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'topRight', 5000);
    }

$(".tab").css("display", "none");
$("#tab-1").css("display", "block");
function run(hideTab, showTab){
        if(hideTab < showTab){ // If not press previous button
          // Validation if press next button
          var currentTab = 0;
          x = $('#tab-'+hideTab);
          y = $(x).find(".form-control.form-control-sm.validate");
         console.log(hideTab);
            if (hideTab==1){
                if ($("#email").val() !== $("#emailCon").val()) {
                    errorEmailIgual();
                    return;
                }
                if ($("#tipoSolicitud").val()===' ') {
                    TipoSolicitud();
                    return;
                }
                console.log(tipoDocumento);
                console.log($("#tipoSolicitud").val());

        }
            if (hideTab==2){
                if ($("#emailConU").val() !== $("#emailConUC").val()) {
                    errorEmailICon('primer');
                    return;
                }
            }
                

           for (i = 0; i < y.length; i++){
            if (y[i].value == ""){
              console.log(y[i]);
              $(y[i]).css("background", "#ffdddd");
              return false;
            }
          }
        }

        // Progress bar
        for (i = 1; i < showTab; i++){
          $("#step-"+i).css("opacity", "1");
        }

        // Switch tab
        $("#tab-"+hideTab).css("display", "none");
        $("#tab-"+showTab).css("display", "block");
        $("input").css("background", "#fff");
    
}

function doc(valor){
        if(valor == 1){
            document.getElementById("step-3").hidden=false;
            document.getElementById("full_div").hidden=false;
            document.getElementById("apode_id").hidden=false;
            document.getElementById("audi_div").hidden=true;
            document.getElementById("dire_id").hidden=true;
            
   
            
    }else{
        document.getElementById("step-3").hidden=true;
        document.getElementById("full_div").hidden=true;
        document.getElementById("audi_div").hidden=false;
        document.getElementById("apode_id").hidden=true;
        document.getElementById("dire_id").hidden=false;
     
        }  
    } 

    function carga() {
        doc(document.getElementById('tipoSolicitud').value);

        
    }
    window.onload=carga;


</script>
@endsection