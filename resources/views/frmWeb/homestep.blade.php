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
.col-md-3 {
    flex: 0 0 auto;
    width: 25%;
    padding: 10px;
}
.col-md-4 {
    flex: 0 0 auto;
    width: 25%;
    padding: 10px;
}
.d-flex {
    display: flex!important;
}
.ps-1 {
    padding-left: 0.25rem!important;
}
.align-items-center {
    align-items: center!important;
}

img, svg {
    vertical-align: middle;
}
*, ::after, ::before {
    box-sizing: border-box;
}

.icono
{
    margin-left: 10px;
    float: left;
}

img {
    overflow-clip-margin: content-box;
    overflow: clip;
}

textarea {
    resize: none;
    overflow: hidden;
    min-height: 80px;
    max-height: 210px;
}

.form-floating>.form-control, .form-floating>.form-control-plaintext, .form-floating>.form-select {
    height: calc(3.99rem + calc(var(--bs-border-width) * 2));
    margin: 2px;
    line-height: 1.25;
}

.selectize-input {
    min-height: calc(1.5em + 0.5rem + calc(var(--bs-border-width) * 2));
    padding: -0.25rem 0.5rem;
    padding-top: 2px;
    padding-left: 2px;
    font-size: .875rem;
    color: black;
    max-width: 100%;
    border-radius: 0.25rem;
    appearance: none;
    color: var(--bs-body-color);
        border: 0px solid #d0d0d0;
        background: 0 0!important;
        width: 90%;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

.selectize-control.single .selectize-input.dropdown-active:after {
    margin-top: -38px;
    border-width: 0 5px 5px 5px;
    border-color: transparent transparent grey transparent;
}
.selectize-control.single .selectize-input:after {
    content: " ";
    display: block;
    position: absolute;
    top: 50%;
    right: -18px;
    margin-top: -3px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 5px 5px 0 5px;
    border-color: grey transparent transparent transparent;
}


.selectize-input>input[placeholder] {
    box-sizing: initial;
    color: black;
    font-size: .875rem;
    opacity: 100;
}

.selectize-input>input {
    display: inline-block!important;
    padding: 0!important;
    min-height: 0!important;
    max-height: none!important;
    max-width: 100%!important;
    margin: 0!important;
    text-indent: 0!important;
    border: 0 none!important;
    background: 0 0!important;
    line-height: inherit!important;
    user-select: auto!important;
    box-shadow: none!important;
}

.progress, .progress-stacked {
    --bs-progress-height: 5px;
    --bs-progress-font-size: 0.75rem;
    --bs-progress-bg: var(--bs-secondary-bg);
    --bs-progress-border-radius: var(--bs-border-radius);
    --bs-progress-box-shadow: var(--bs-box-shadow-inset);
    --bs-progress-bar-color: #fff;
    --bs-progress-bar-bg: #0d6efd;
    --bs-progress-bar-transition: width 0.6s ease;
    display: flex;
    height: var(--bs-progress-height);
    overflow: hidden;
    font-size: var(--bs-progress-font-size);
    background-color: var(--bs-progress-bg);
    border-radius: var(--bs-progress-border-radius);
    margin-top: -21px;
}
/* .progress{
        height: 5px;
        margin-top: 2px;
}
.progress-bar{
        height: 25px;
        color: transparent;
        opacity: 0.0;
} */

.select2-container {
    box-sizing: border-box;
    display: contents;
    
    margin-bottom: 222px;
    position: relative;
    vertical-align: middle;
}


.select2 {
width:100%!important;
padding: -0.625rem 0.75rem 0.375rem 2.25rem;
     background-image: ; 
     background-repeat: no-repeat; 
    background-position: right 0.75rem center; 
    background-size: 0px 0px;
	appearance: none;
    font-family: 'Public Sans', sans-serif;
    font-size: .875rem;


}


.select2-container--default .select2-selection--single .select2-selection__arrow b {
  background-image: url(https://cdn4.iconfinder.com/data/icons/user-interface-174/32/UIF-76-512.png);
  background-color: transparent;
  background-size: contain;
  border: none !important;
  height: 20px !important;
  width: 20px !important;
  margin: auto !important;
  top: auto !important;
  left: auto !important;
}


.select2-selection__arrow b{
    display:none !important;
}
.steps-form {
    display: table;
    width: 100%;
    position: relative; }
.steps-form .steps-row {
    display: table-row; }
.steps-form .steps-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc; }
.steps-form .steps-row .steps-step {
    display: table-cell;
    text-align: center;
    position: relative; }
.steps-form .steps-row .steps-step p {
    margin-top: 0.5rem; }
.steps-form .steps-row .steps-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important; }
.steps-form .steps-row .steps-step .btn-circle {
    width: 36px;
    height: 35px;
    text-align: center;
    padding: 7px 0;
    font-size: 12px;
    /* line-height: 1.528571429;
    
    margin-top: -2px;  */
    border-radius: 25px;
    }


.btn-indigo{
    background-color: #6610f2;
    color: white;
}

.btn-indigo{
    background-color: #6610f2;
    color: white;
}
.btn-default{
    background-color: #20c997;
    color: white;
}

.btn-step{
    background-color: var(--prm-color);
    color: #fff;
}

.btn-light{
    border-color: #0a5b42;
    opacity: 20px;
    
}

/* .btn-light:hover {
  color: #1F2D3D;
  background-color: #e2e6ea;
  
} */
.btn-primary{
    border-color: #2039c9;
 
}





</style>

    <div class="row">
        <center>
        <div class="col-md-6">
            
            <p class="mt-2" style="text-justify;color:#0171BD;font-weight:800;font-size:1.35rem">SOLICITUD DE CONCILIACIÓN</p>
        </div>
    </center>
        <div class="col-md-1"> </div>
        {{-- <div class="col-md-4 text-block"><img src="{{URL::asset('imagen/logo-personeria-azul.png')}}" class="rounded mx-auto d-block" width="50%"></div> --}}
    </div>
    <br>
    {{-- <div style="text-align:center;">
        <span class="step" id = "step-1"><i class="fas fa-info"></i></span>
        <span class="step" id = "step-2"><i class="fa fa-users nav-icon"></i></span>
        <span class="step" id = "step-3"><i class="fas fa-user-tie"></i></span>
        <span class="step" id = "step-4"><i class="fas fa-clipboard-list"></i></span>
      </div> --}}


    
    <div class="steps-form">
        <div class="steps-row setup-panel">
          <div class="steps-step">
            <a href="#step-1" type="button" class="btn btn-step btn-circle" id = "step-1"><span id="text-1">1</span><i id="stepi-1" class="fas fa-check" style="display:none;"></i></a>
        
            

          </div>
          <div class="steps-step">
            <a href="#step-2" type="button" class="btn btn-light btn-circle" id = "step-2" disabled="disabled"><span id="text-2">2</span><i id="stepi-2" class="fas fa-check" style="display:none;"></i></a>
  
          </div>
          <div class="steps-step">
            <a href="#step-3" type="button" class="btn btn-light btn-circle"  id = "step-3" disabled="disabled"><span id="text-3">3</span><i id="stepi-3" class="fas fa-check" style="display:none;"></i></a>
       
          </div>
          <div class="steps-step">
            <a href="#step-4" type="button" class="btn btn-light btn-circle" id = "step-4" disabled="disabled"><span id="text-4">4</span><i id="stepi-4" class="fas fa-check" style="display:none;"></i></a>
         
          </div>
        </div>
        

      </div>
      <div class="progress">
        <div class="progress-bar bg-primary" role="progressbar" id="progressbar" style="width: 12%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      {{-- <div style="text-align:center;">
        <span class="step" id = "step-1"></span>
        <span class="step" id = "step-2"></span>
        <span class="step" id = "step-3"></span>
        <span class="step" id = "step-4"></span>
      </div> --}}
      <br>   <br>

    
    <!-- INICIO DATOS DEL SOLICITANTE -->
    <div class="card tab" id="tab-1">
        <div class="card-header">
            <center>
            <b>DATOS DEL SOLICITANTE</b>
        </center>
        </div>
        <div class="card-body" style="margin-bottom: 10px;">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-floating mb-3">
         
                    {{ Form::select('tipoDocumento', $data['listaTipoDoc'], null, ['class' => 'form-control form-control-sm validate','name'=>'tipoDocumento','id'=>'tipoDocumento','aria-label'=>"tipoDocumento",'required']) }}
                    <div class="invalid-feedback tipoDocumento">
                        Campo obligatorio.
                      </div>
                    <label for="tipoDocumento">1. Tipo Documento *</label>
                    </div>
                </div>
                <div class="col-md-3">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control form-control-sm validate" id="numeroDocumento" onkeyup="this.value=this.value.toUpperCase();" name="numeroDocumento" autocomplete="off" onkeypress = "return soloNumeros(event);" required placeholder="0" minlength="4" maxlength="10" pattern="[0-9]+" >
                    <label for="numeroDocumento">2. No. de documento *</label>
                    <div class="invalid-feedback numeroDocumento">
                        Campo obligatorio.
                      </div>
 
                  </div>
                </div>

                
              
     
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm validate" minlength="3" name="primerNombre"  onkeyup="this.value=this.value.toUpperCase();" id="primerNombre" autocomplete="off" placeholder="0" required style="text-transform: uppercase">
                        <label for="primerNombre">3. Primer Nombre *</label>
                        <div class="invalid-feedback primerNombre">
                            Campo obligatorio.
                          </div>
                </div>
                </div>

                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="segundoNombre" id="segundoNombre" onkeyup="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="0" style="text-transform: uppercase" >
                        <label for="segundoNombre">4. Segundo Nombre</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" minlength="3" name="primerApellido" onkeyup="this.value=this.value.toUpperCase();" id="primerApellido" autocomplete="off" placeholder="0" required style="text-transform: uppercase">
                        <label for="primerApellido">5. Primer Apellido*</label>
                        <div class="invalid-feedback primerApellido">
                            Campo obligatorio.
                          </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="segundoApellido" id="segundoApellido" onkeyup="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="0" style="text-transform: uppercase">
                        <label for="segundoApellido">6. Segundo Apellido</label>
                    </div>
                </div>
        
         
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" name="primerTelefono" id="primerTelefono"  onkeypress = "return soloNumeros(event);" autocomplete="off" placeholder="0"  minlength="10" max="10" required>
                        <label for="primerTelefono">7. Teléfono celular *</label>
                        <div class="invalid-feedback primerTelefono">
                            Campo obligatorio.
                          </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" min="7" max="10" name="segundoTelefono" id="segundoTelefono" onkeypress = "return soloNumeros(event);" autocomplete="off" placeholder="0">
                        <label for="segundoTelefono">8. Teléfono fijo</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" name="direccion" id="direccion" autocomplete="off" onkeyup="this.value=this.value.toUpperCase();" placeholder="0" required style="text-transform: uppercase">
                        <label for="direccion">9. Dirección *</label>
                        <div class="invalid-feedback direccion">
                            Campo obligatorio.
                          </div>
                    </div>
                </div>
                <div class="col-md-3">
    
                    <div class="form-floating mb-3">
      
                    {{ Form::select('localidad', $data['listaLocalidades'], null, ['class' => $errors->first('localidad') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','id'=>'localidad','required', 'onchange' => 'doc1(this.value)']) }}
                    <div class="invalid-feedback localidad">
                        Campo obligatorio.
                      </div>
                    <label for="localidad"> 10. Localidad *</label>
                  </div>
                </div>
            

                    <div class="col-md-3" id="fuera_div" >
    
                        <div class="form-floating mb-3">
                            {!! Form::select('sis_departam_id',  $data['departamentos'], null, ['class' => 'form-control form-control-sm', 'id'=>'sis_departam_id', 'disabled']) !!}
                    @if($errors->has('sis_departam_id'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->first('sis_departam_id') }}
                     
                        </div>
                    @endif
                    <label for="sis_departam_id">10.1 Departamento:</label>
                  </div>
                </div>
       
                <div class="col-md-3" id="fueras_div" >
    
                    <div class="form-floating mb-3">
  
                        {!! Form::select('sis_municipio_id',  $data['municipios'], null, ['class' => 'form-control form-control-sm','id'=>'sis_municipio_id','disabled']) !!}
                @if($errors->has('sis_municipio_id'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('sis_municipio_id') }}

                    </div>
                @endif
                <label for="sis_municipio_id">10.2 Municipio</label>
              </div>
            </div>
            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::date('fechanacimiento', null, ['class' => $errors->first('fechanacimiento') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','id'=>'fechanacimiento','name'=>'fechanacimiento', 'onkeydown'=>"return false", 'required', 'max'=>$data['Maxhoy'], 'min'=>$data['minhoy']]) }}
                <div class="invalid-feedback fechanacimiento">
                    Campo obligatorio.
                  </div>
                <label for="fechanacimiento"> 11. Fecha de Nacimiento *</label>
              </div>
            </div>

            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::text('rangoedad', null, ['class' => $errors->first('rangoedad') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','style'=>"text-transform: uppercase",'id'=>'rangoedad'] ) }}
                <div class="invalid-feedback rangoedad">
                    Campo obligatorio.
                  </div>
                <label for="rangoedad">12. Rango de Edad</label>
              </div>
            </div>
            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::select('escolaridad', $data['escolaridad'], null, ['class' => $errors->first('escolaridad') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','name'=>'escolaridad','id'=>'escolaridad','required']) }}
                <div class="invalid-feedback escolaridad">
                    Campo obligatorio.
                  </div>
                <label for="escolaridad"> 13. Nivel de Escolaridad *</label>
              </div>
            </div>
            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::select('nacionalidad', $data['nacionalidad'], null, ['class' => 'form-control form-control-sm selectize','placeholder'=>'Seleccione','name'=>'nacionalidad','id'=>'nacionalidad','required',]) }}
                <div class="invalid-feedback nacionalidad">
                    Campo obligatorio.
                  </div>
              
                <label for="nacionalidad"> 14. Nacionalidad *</label>
              </div>
            </div>

            
            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::select('sexo', $data['sexocombo'], null, ['class' => 'form-control form-control-sm validate','name'=>'sexo','id'=>'sexo','required', ]) }}
                <div class="invalid-feedback sexo">
                    Campo obligatorio.
                  </div>
                <label for="sexo"> 15. Sexo *</label>
              </div>
            </div>
            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::select('genero', $data['generocombo'], null, ['class' => 'form-control form-control-sm validate','name'=>'genero','id'=>'genero','required', ]) }}
                <div class="invalid-feedback genero">
                    Campo obligatorio.
                  </div>
                <label for="genero"> 16. Identidad de Genero *</label>
              </div>
            </div>

            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::select('orientacion', $data['orientacioncombo'], null, ['class' => 'form-control form-control-sm validate','name'=>'orientacion','id'=>'orientacion','required',]) }}
                <div class="invalid-feedback orientacion">
                    Campo obligatorio.
                  </div>
                <label for="localidad"> 17. Orientación Sexual *</label>
              </div>
            </div>
            <div class="col-md-3">
    
                <div class="form-floating">
                    
                {{ Form::select('grupoafectado', $data['grupoafectado'], null, ['class' => 'form-control form-control-sm selectize','name'=>'grupoafectado','id'=>'grupoafectado','required',]) }}
                <div class="invalid-feedback grupoafectado">
                    Campo obligatorio.
                  </div>
                <label for="localidad"> 18. Grupo Afectado *</label>
              </div>
            </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                    
                        <input type="email" class="form-control form-control-sm validate[required, custom[email]]" name="email" id="email" autocomplete="off" placeholder="0">
                        <label for="email"> 19. Correo electrónico *</label>
                        <div class="invalid-feedback email">
                            Campo obligatorio.
                          </div>
                     </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailCon" id="emailCon" autocomplete="off" placeholder="0">
                        <label for="emailCon"> 19.1. Confirme correo electrónico *</label>
                    </div> 
                </div>

           

            <!-- INICIO TIPO DE SOLICITUD -->
        
                <div class="col-md-6">
                    
                    <div class="form-floating mb-3">
                        <select class="form-select form-select-sm validate[required]" name="tipoSolicitud" id="tipoSolicitud" onchange = 'doc(this.value)' required>
                            <option value=" ">- Seleccione una opcion -</option>
                            <option value="0">DIRECTA</option>
                            <option value="1">APODERADO</option>
                        </select>
                        <label for="tipoSolicitud"> 20. Tipo de Solicitud *</label>
                        <div class="invalid-feedback">Example invalid select feedback</div>
                        </div>
                    </div> 
 
     
          
       
               
            </div>
            
            <!-- FIN TIPO SOLICITUD -->
  
            </div>
            <div class="row justify-content-md-center" style="padding-top: 3px">
                <div id="apode_id" class="col-2">
                <a class="btn btn-success" onclick="run(1, 2);" style="width: 120px"> Siguiente  <i class="far fa-check-circle"></i> </a>
                
                 </div>
                 <div id="dire_id" class="col-2" >
                    
                <a class="btn btn-success" onclick="run(1, 3);" style="width: 120px" > Siguiente  <i class="far fa-check-circle"></i> </a>
             </div>
            </div>
            <br>
        </div>


    <!-- FIN DATOS DEL SOLICTANTE -->
    <!-- INICIO DATOS DE LOS CONVOCADOS -->
    <div class="card tab" id="tab-2">
        <div class="card-header">
            <center>
            <b>DATOS DEL APODERADO</b>
        </center>
        </div>
        <div class="card-body" style="margin-bottom: 10px;" >
            <div class="row">
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        {{ Form::select('tipoDocApoderado', $data['listaTipoDoc'], null, ['class' => 'form-control form-control-sm validate']) }}
                    @if($errors->has('tipoDocApoderado'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->first('tipoDocApoderado') }}
                        </div>
                    @endif
                    <label for="tipoDocApoderado"> 20.1. Tipo Documento *</label>
                    <div class="invalid-feedback tipoDocApoderado">
                        Campo obligatorio.
                      </div>
                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" name="numDocApoderado" id="numDocApoderado" autocomplete="off" placeholder="0" onkeypress = "return soloNumeros(event);">
                        <label for="numDocApoderado"> 20.2. No. de Documento *</label>
                        <div class="invalid-feedback numDocApoderado">
                            Campo obligatorio.
                          </div>
                    </div>
                </div>
         

                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" onkeyup="this.value=this.value.toUpperCase();" name="primerNombreApoderado" id="primerNombreApoderado" onkeyup="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="0" style="text-transform: uppercase">
                        <label for="primerNombreApoderado"> 20.3. Primer Nombre *</label>
                        <div class="invalid-feedback primerNombreApoderado">
                            Campo obligatorio.
                          </div>
                       
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" onkeyup="this.value=this.value.toUpperCase();" name="segundoNombreApoderado" id="segundoNombreApoderado" autocomplete="off" placeholder="0" style="text-transform: uppercase">
                        <label for="segundoNombreApoderado"> 20.4. Segundo Nombre</label>
                    </label>
                </div>
            </div>
                <div class="col-md-3">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" onkeyup="this.value=this.value.toUpperCase();" name="primerApellidoApoderado" id="primerApellidoApoderado" autocomplete="off" placeholder="0" style="text-transform: uppercase">
                        <label for="primerApellidoApoderado"> 20.5. Primer Apellido *</label>
                        <div class="invalid-feedback primerApellidoApoderado">
                            Campo obligatorio.
                          </div>

                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" onkeyup="this.value=this.value.toUpperCase();" name="segundoApellidoApoderado" id="segundoApellidoApoderado" autocomplete="off" placeholder="0" style="text-transform: uppercase">
                        <label for="segundoApellidoApoderado"> 20.6. Segundo Apellido</label>
                        
                    </div>
                </div>
         
        
                <div class="col-md-3">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate"  name="tarjetaProfesional" id="tarjetaProfesional" autocomplete="off" placeholder="0" style="text-transform: uppercase">
                        <label for="tarjetaProfesional"> 20.7. No. tarjeta Profesional *</label>
                        <div class="invalid-feedback tarjetaProfesional">
                            Campo obligatorio.
                          </div>
            
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" onkeyup="this.value=this.value.toUpperCase();" name="direccionApoderado" id="direccionApoderado" autocomplete="off" placeholder="0" style="text-transform: uppercase">
                        <label for="direccionApoderado"> 20.8. Dirección *</label>
                        <div class="invalid-feedback direccionApoderado">
                            Campo obligatorio.
                          </div>
                       
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" name="primerTelefonoApoderado" id="primerTelefonoApoderado" autocomplete="off" placeholder="0"  minlength="10" max="10" onkeypress = "return soloNumeros(event);">
                        <label for="primerTelefonoApoderado"> 20.9. Teléfono Celular *</label>
                        <div class="invalid-feedback primerTelefonoApoderado">
                            Campo obligatorio.
                          </div>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate[required minSize[7], maxSize[10]]" name="segundoTelefonoApoderado"  minlength="10" max="10" id="segundoTelefonoApoderado" autocomplete="off" placeholder="0" onkeypress = "return soloNumeros(event);">
                        <label for="segundoTelefonoApoderado"> 20.10. Teléfono fijo</label>
           
                    </div>
                </div>
        
            <div class="row">
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailApoderado" id="emailApoderado" autocomplete="off" placeholder="0">
                        <label for="emailApoderado"> 20.11. Correo electronico*</label>
                        <div class="invalid-feedback emailApoderado">
                            Campo obligatorio.
                          </div>
             
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailApoderadoCon" id="emailApoderadoCon" autocomplete="off" placeholder="0">
                        <label for="emailApoderadoCon"> 20.12. Confirme correo electronico *</label>
                        <div class="invalid-feedback emailApoderadoCon">
                            Campo obligatorio.
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
        <div class="row justify-content-md-center">
                <div class="col-2">
                     <div class="btn btn-outline-secondary " onclick="run(2, 1);" style="width: 120px"><svg style="height: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101" id="left"><path  d="M50.5 16.4c-18.8 0-34.1 15.3-34.1 34.1s15.3 34.1 34.1 34.1 34.1-15.3 34.1-34.1-15.3-34.1-34.1-34.1zm0 63.4c-16.1 0-29.3-13.1-29.3-29.3s13.1-29.3 29.3-29.3 29.3 13.1 29.3 29.3-13.2 29.3-29.3 29.3z"></path><path d="M57.1 33.1c-.9-.9-2.5-.9-3.4 0L38.2 48.6c-.5.5-.7 1.1-.7 1.7s.3 1.2.7 1.7l15.5 15.5c.5.5 1.1.7 1.7.7s1.2-.2 1.7-.7c.9-.9.9-2.5 0-3.4L43.3 50.3l13.8-13.8c1-.9 1-2.4 0-3.4z"></path></svg> Anterior </div>
                </div>    
                <div class="col-2">
                     <div class="btn btn-success " onclick="run(2, 3);" style="width: 120px"> Siguiente  <i class="far fa-check-circle"></i> </div>
                </div>
        </div>
        <br>
    </div>

    <!-- FIN DATOS DE LOS CONVOCADOS -->

    <!-- INICIO DATOS DEL APODERADO -->
    <div id="seccionApoderado">

        <div class="card tab" id="tab-3">
            <div class="card-header">
                <center>
                <b>DATOS DEL CONVOCADO/S</b>
            </center>
            </div>
            <div class="card-body" style="margin-bottom: 10px; height">
                <p class="text-justify">Si es un numero plural de convocados indique los correos electrónicos de cada uno de ellos. Se advierte que la invitación a la audiencia de conciliación virtual se realizará por correo electrónico, y por tanto deben ser verídicos. Si no cuenta con ellos, adelante la solicitud de conciliación presencial en la Sedes de Conciliación del Personería de Bogotá D.C. que se encuentra publicadas en la página web de la Entidad.</p>
                <br>
                <div class="agregar">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" onkeyup="this.value=this.value.toUpperCase();"  style="text-transform: uppercase" name="nomConvoc" id="nomConvoc" autocomplete="off" placeholder="0" minlength="3" >
                            <label for="nomConvoc">Nombres convocado</label>
                            <div class="invalid-feedback nomConvoc">
                                Campo obligatorio.
                              </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" onkeyup="this.value=this.value.toUpperCase();" style="text-transform: uppercase" name="apeConvoca" id="apeConvoca" autocomplete="off" placeholder="0" minlength="3" >
                            <label for="apeConvocante">Apellidos convocado</label>
                            <div class="invalid-feedback apeConvocante">
                                Campo obligatorio.
                              </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-6">
                        
                            <input type="email" class="form-control form-control-sm" name="emailConvo" id="emailConvo" autocomplete="off" placeholder="0" >
                            <label for="email"> Correo electronico</label>
                            <div class="invalid-feedback emailConU">
                                Campo obligatorio.
                              </div>
                         </div> 
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-sm validate" name="emailCon" id="emailConUC" autocomplete="off" placeholder="0" required>
                            <label for="emailCon"> Confirme correo electronico</label>
                            <div class="invalid-feedback emailCon">
                                Campo obligatorio.
                              </div>
                        </div> 
                    </div> --}}
                </div>
                    <br>

                    
                    <div class="col-md-3">
                         
                   <button type="button" class="btn btn-success" id="add_btn" >Agregar <i class="fa-solid fa-user-plus"></i></button> 
                    
    
      
                  </div>
              <br><br>
              
            </div>
            <div class="test">
                <div class="row">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>NOMBRES CONVOCADO</th>
                        <th>APELLIDOS CONVOCADO</th>
                        <th>EMAIL</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="tablita"></tbody>
                  </table>
                </div>
                </div>
               
               
            </div>


            <center>
            <div class="row justify-content-md-center">
                <div class="col-2" id="audi_div">
            <div class="btn btn-outline-secondary" onclick="run(3, 1);"  style="width: 120px"><svg style="height: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101" id="left"><path  d="M50.5 16.4c-18.8 0-34.1 15.3-34.1 34.1s15.3 34.1 34.1 34.1 34.1-15.3 34.1-34.1-15.3-34.1-34.1-34.1zm0 63.4c-16.1 0-29.3-13.1-29.3-29.3s13.1-29.3 29.3-29.3 29.3 13.1 29.3 29.3-13.2 29.3-29.3 29.3z"></path><path d="M57.1 33.1c-.9-.9-2.5-.9-3.4 0L38.2 48.6c-.5.5-.7 1.1-.7 1.7s.3 1.2.7 1.7l15.5 15.5c.5.5 1.1.7 1.7.7s1.2-.2 1.7-.7c.9-.9.9-2.5 0-3.4L43.3 50.3l13.8-13.8c1-.9 1-2.4 0-3.4z"></path></svg> Anterior </div>
                </div>
                <div class="col-2" id="full_div">
            <div class="btn btn-outline-secondary" onclick="run(3, 2);" style="width: 120px"><svg style="height: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101" id="left"><path  d="M50.5 16.4c-18.8 0-34.1 15.3-34.1 34.1s15.3 34.1 34.1 34.1 34.1-15.3 34.1-34.1-15.3-34.1-34.1-34.1zm0 63.4c-16.1 0-29.3-13.1-29.3-29.3s13.1-29.3 29.3-29.3 29.3 13.1 29.3 29.3-13.2 29.3-29.3 29.3z"></path><path d="M57.1 33.1c-.9-.9-2.5-.9-3.4 0L38.2 48.6c-.5.5-.7 1.1-.7 1.7s.3 1.2.7 1.7l15.5 15.5c.5.5 1.1.7 1.7.7s1.2-.2 1.7-.7c.9-.9.9-2.5 0-3.4L43.3 50.3l13.8-13.8c1-.9 1-2.4 0-3.4z"></path></svg> Anterior </div>
            </div>
            <div class="btn btn-success" onclick="run(3, 4);" style="width: 120px"> Siguiente  <i class="far fa-check-circle"></i></div>
        </div>
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
            <div class="card-body" style="margin-bottom: -12px; height">

                {{-- <div id="tipoAudienciaSeleccion" style="display: none">

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
                </div> --}}


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
                            <label for="asunto">21. Asunto *</label>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <select class="form-control form-control-sm custom-select validate[required]" name="subAsunto" id="subAsunto">
                                    <option value=" ">- Seleccione una opcion -</option>
                                </select>
                                <label for="subAsunto"> 21.1. Sub Asunto *</label>
                            </div>
                         
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control form-control-sm validate[required, maxSize[1000]]" onkeyup="this.value=this.value.toUpperCase();" name="detalle" id="detalle" placeholder="Resumen" oninput="auto_grow(this)" maxlength="1000"  cols='30' rows='20' style="text-transform: uppercase"></textarea>
                                <label for="detalle"> 22. Resumen de la pretensión o conflicto (Máximo 1000 caracteres)*</label>
                                <span id="chars"></span>
                                </div>
             
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-justify">
                            <div class="alert alert-success text-justify" role="alert" style="--bs-success-text-emphasis: #083822;">
                                {{-- <div class="alert alert-success text-justify" role="alert" style="--bs-success-bg-subtle:#0f5132;--bs-success-text-emphasis: #083822;"> --}}
                                
                              <img src="{{URL::asset('imagen/warning-sign-removebg-preview.png')}}" alt="Esta es una descripcion alternativa de la imagen para cuando no se pueda mostrar" width="45" height="45" align="left"/> 
                                <span class="text-justify">La pretensión no podrá ser superior a <u><b><span >100 SMMLV (${{(number_format($data['salario']->maximo));}})</span></b></u>, salvo que se trate de solicitudes de conciliación promovida por persona natural deudor hipotecario y por persona natural que reclame ser damnificado o victima el pago de indemnización de seguros de responsabilidad civil.</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input class="form-control form-control-sm validate" type="number" name="cuantia" id="cuantia" onkeypress = "return soloNumeros(event);" autocomplete="off" placeholder="0" min="1" max="116000000" maxlength="9">
                                <label for="cuantia"> 23. Valor de la Cuantía *</label>
                                <div id="test">
                                    {{ Form::number('salario', $data['salario']->numero, ['class' => 'form-control-plaintext' ,'id'=>'salario', 'style'=>"display: none"]) }}
                                    {{ Form::number('maximo', $data['salario']->maximo, ['class' => 'form-control-plaintext','id'=>'maximo','style'=>"display: none"]) }}
                                </div>
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
                {{-- <div class="col-md-3">
                    <div class="alert alert-success text-center" role="alert">
                        <small class="text-center" style="font-size: 100%"> <span id="valorCaptcha"></span> </small>
                    </div>
                </div>
                <div class="col-md-1 text-center" style="padding: .75rem 1.25rem;">
                    <span class="badge badge-light"><i class="fas fa-sync fa-2x" onclick="getCapchaValue()"></i></span>
                </div> --}}
                {{-- <div class="col-md-3" style="padding: .75rem 1.25rem;">
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control form-control-sm validate" name="captcha" id="captcha" autocomplete="off" placeholder="0">
                        <input type="hidden" name="captchaOrg" id="captchaOrg">
                        <label for="captcha"> Digite los caracteres de la imagen *</label>
     
                    </div>
                </div> --}}

     
      
                <center>

              


                <div class="btn btn-outline-secondary" onclick="run(4, 3);" style="width: 120px"><svg style="height: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101" id="left"><path  d="M50.5 16.4c-18.8 0-34.1 15.3-34.1 34.1s15.3 34.1 34.1 34.1 34.1-15.3 34.1-34.1-15.3-34.1-34.1-34.1zm0 63.4c-16.1 0-29.3-13.1-29.3-29.3s13.1-29.3 29.3-29.3 29.3 13.1 29.3 29.3-13.2 29.3-29.3 29.3z"></path><path d="M57.1 33.1c-.9-.9-2.5-.9-3.4 0L38.2 48.6c-.5.5-.7 1.1-.7 1.7s.3 1.2.7 1.7l15.5 15.5c.5.5 1.1.7 1.7.7s1.2-.2 1.7-.7c.9-.9.9-2.5 0-3.4L43.3 50.3l13.8-13.8c1-.9 1-2.4 0-3.4z"></path></svg> Anterior </div> 
                <br>
                <br>
                {!! htmlFormSnippet() !!}
                <br>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> Registrar Solicitud  <i class="far fa-check-circle"></i></button>
                    </div>
                  </div>
<br>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        Antes de terminar el proceso ¿Esta seguro de la informacion ingresada?
                        </div>
                        
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btnRegistro"  > Si  <i class="far fa-check-circle"></i></button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> No <i class="far fa-times-circle"></i></button>
                
                        </div>
                    </div>
                    </div>
                </div>


                {{-- <div class="row" id="btnRegistro">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success btn-block btn-sm "><span class="fa fa-save pr-4"> </span> Registrar Solicitud </button>
                    </div>
                    <div class="col-md-4"></div>
                </div> --}}
                </center>
 
                <div class="col-md-2"></div>
        
            </div>
        </div>

       
    </div>
    <!-- FIN TIPO DE AUDIENCIA -->



  
</form>

<div id="modalRespuesta"></div>

@endsection

@section('AddScriptFooter')

<script>
    //Cargar modal con mensaje de bienvenida
    $(document).ready(function() {
        modalBienvendia();
      //  getCapchaValue();
        validarEstadoTipoAudiencia();
        validarCcEmail();
        
        $("#frmRegistroDatos").validationEngine('attach', {
            onValidationComplete: function(form, status) {

                let recaptchaToken = grecaptcha.getResponse();
                    // console.log($('#g-recaptcha-response'));
                    // console.log($('#recaptcha-anchor').val());
                    // console.log($('#recaptcha-anchor').is(':checked'));
                    // console.log($('#recaptcha-anchor').attr('value'));
                    // console.log($('#g-recaptcha-response').attr('value'));
                    console.log(recaptchaToken);
                if (recaptchaToken==='') {
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
                // if ($("#emailConU").val() !== $("#emailConUC").val()) {
                //     errorEmailICon('primer');
                //     return;
                // }
                // if ($("#emailConD").val() !== $("#emailConDC").val()) {
                //     errorEmailICon('segundo');
                //     return;
                // }
                // if ($("#emailConT").val() !== $("#emailConTC").val()) {
                //     errorEmailICon('tercer');
                //     return;
                // }
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
        var msg = "Los correos electrónicos del solicitante en el campo 19 y 19.1 no son iguales. Por favor verifíquelos.  ";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }
    
    function TipoSolicitud() {
        var msg = "12. Seleccione un tipo de solicitud.  ";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }

    function campostab2(texto) {
        var msg = "No se ha agregado un convocante." ;
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }
    function correonovalido() {
        var msg = "Formato de correo no valido.";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }

    function rangofecha() {
        var msg = "Rango de fecha no valido.";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }

    function datosconvocados() {
        var msg = "Datos incompletos.";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }

    function camposfaltantes() {
        var msg = "Faltan campos por completar.  ";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }

    function TipoDocumento() {
        var msg = "1. Seleccione un tipo de documento.  ";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }

    function numeroDocumento() {
        var msg = "2. Ingrese el numero de documento.  ";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }
    //Error en comparacion de email Apoderado
    function errorEmailIgualApod() {
        var msg = "Los correos electrónicos del apoderado en el campo 20.11 y 20.12 no son iguales Por favor verifíquelos.  ";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }
    //Error de email igual para convocados
    function errorEmailICon(dato) {
        var msg = "Los correos electrónicos del " + dato + " convocado no son iguales Por favor verifíquelos.  ";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
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
    // $('#cuantia').on('keyup', function() {
    //     $(this).val();
    //     console.log($(this).val());
    //     var valor= $('#salario').val()*$(this).val();
    //     var maximo= $('#maximo').val();
    //     console.log(valor > maximo);
    //     if (valor > maximo) {
    //         var msg = "La pretensión no podrá ser superior a 100 SMMLV ($"+maximo+"), salvo que se trate de solicitudes de conciliación promovida por persona natural deudor hipotecario y por persona natural que reclame ser damnificado o victima el pago de indemnización de seguros de responsabilidad civil";
    //         var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
    //         llamarNotyTime('error', msg, 'center', 3000);
    //     }

    // });

    // function cuantiaVerificar(field) {
    //     var ref = $(field),
    //         val = ref.val();
    //     var str = $('#cuantia').val();
    //     var maxmo = $('#maximo').val();
        
    //     str = str.replace(/\+/gi, ' ');
    //     $("#cuantia").val(str);
    //     if (val > maxmo) {
    //         var msg = "La pretensión no podrá ser superior a 100 SMMLV ($116,000,000), salvo que se trate de solicitudes de conciliación promovida por persona natural deudor hipotecario y por persona natural que reclame ser damnificado o victima el pago de indemnización de seguros de responsabilidad civil";
    //         var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
    //         llamarNotyTime('error', msg, 'center', 3000);
    //     }
    // }
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
    
                      
                       
//     $('#add_btn').on('click',function(){
//      var html='';
//      html+='<div class="row" id="lista">'
//      html+='<div class="col-md-3">'
//      html+='<div class="form-floating mb-3">'
//      html+='<input type="text" class="form-control form-control-sm validate" name="nomConvocante[]" id="nomConvocante" autocomplete="off" placeholder="0">'
//      html+='<label for="nomConvocante">Nombre completo convocado</label>'
//      html+='<div class="invalid-feedback nomConvocante">'
//      html+='Campo obligatorio.'
//      html+='</div>'
//      html+='</div>'
//      html+='</div>'
//      html+='<div class="col-md-3">'
//      html+='<div class="form-floating mb-3">'
//      html+='<input type="text" class="form-control form-control-sm validate" name="apeConvocante[]" id="apeConvocante" autocomplete="off" placeholder="0">'
//      html+='<label for="apeConvocante">Nombre completo convocado</label>'
//      html+='<div class="invalid-feedback apeConvocante">'
//      html+='Campo obligatorio.'
//      html+='</div>'
//      html+='</div>'
//      html+='</div>'
//      html+='<div class="col-md-3">'
//      html+='<div class="form-floating mb-3">'
//      html+='<input type="email" class="form-control form-control-sm validate" name="emailConvocante[]" id="emailConU" autocomplete="off" placeholder="0">'
//      html+='<label for="email"> Correo electronico</label>'
//      html+='<div class="invalid-feedback emailConU">'
//      html+='Campo obligatorio.'
//      html+='</div>'
//      html+='</div>' 
//      html+='</div>'
//     //  html+='<div class="col-md-3">'
//     //  html+='<div class="form-floating mb-3">'
//     //  html+='<input type="text" class="form-control form-control-sm validate" name="emailCon" id="emailConUC" autocomplete="off" placeholder="0">'
//     //  html+='<label for="emailCon"> Confirme correo electronico</label>'
//     //  html+='<div class="invalid-feedback emailConvocante">'
//     //  html+='Campo obligatorio.'
//     //  html+='</div>'
//     //  html+='</div>' 
//     //  html+='</div>'
//      html+='<div class="col-md-3">'
//      html+='<button type="button" class="btn btn-outline-danger" id="remove" style="height: 50px; width: 120px">Eliminar <i class="far fa-times-circle"></i></button>'
//      html+='   </div>';
//      html+='</div>'
//      html+='</div>'
     
 



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
                $('#btnRegistro').prop('disabled', true);
            },
            success: function(r) {
                var datUsr = r.split("|");
                var valor = datUsr[1];
                var msg = datUsr[2];
                if (valor == 0) {
                    var msg = "<center><p><i class='fas fa-times fa-3x'></i></p></center>" + msg;
                    llamarNotyTime('error', msg, 'topRight', 3000);
                    $("#btnRegistro").show();
                    $('#btnRegistro').prop('disabled', false);
                } else {
                    $("#btnRegistro").hide();
                    $('#btnRegistro').prop('disabled', true);
                    var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
                    new Noty({
                        text: msg,
                        type: 'success',
                        layout: 'center',
                        theme: 'bootstrap-v4',
                        killer: true,
                        progressBar: true,
                        timeout: 15000,
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
                $('#btnRegistro').prop('disabled', false);
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

     $("#localidad").change(function() {
        
        if ($("#localidad").val()==60) {
            console.log($("#localidad").val());
            $("#sis_departam_id").removeAttr('disabled');
            $("#sis_municipio_id").removeAttr('disabled');
         
            
        } else {
            $("#sis_departam_id").attr('disabled','disabled');
            $("#sis_municipio_id").attr('disabled','disabled');
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
                // new Noty({
                //     text: '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Cargando...</span></div></div>',
                //     //type: 'info',
                //     layout: 'center',
                //     theme: 'bootstrap-v4',
                //     killer: true,
                //     progressBar: true,
                //     timeout: 300,
                // }).show();
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
                 //$("#abcContenedor").slideDown(); //Mostrar informacion ABC y input para documento adjunto
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
  
    $(document).ready(function () {



     $('#nacionalidad').selectize({
    
       });
    
    //   $('#nacionalidad').selectize({
    // searchField: 'text',
    // valueField: 'id',
    // onChange        : eventHandler('onChange'),
    // plugins: ["auto_position"],
    //   });

      $('#grupoafectado').selectize({
    searchField: 'text',
    valueField: 'id',
    plugins: ["auto_position"],
      });
      
      
})  ;
        var eventHandler = function(name) {
        return function() {
            console.log(name, arguments);
            $('#log').append('<div><span class="name">' + name + '</span></div>');
        };
        };

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
    // function getCapchaValue() {
    //     var text = "";
    //     var possible = "ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789";

    //     for (var i = 0; i < 5; i++)
    //         text += possible.charAt(Math.floor(Math.random() * possible.length));

    //     let valorCaptcha = text;
    //     $("#valorCaptcha").html(valorCaptcha);
    //     $("#captchaOrg").val(valorCaptcha);
    // }
    // //funciona con error del captcha
    function errorCaptcha() {
        var msg = 'El código de verificación es invalido.<br>Por favor verifique el valor ingresado';
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'topRight', 5000);
    }


    function length(userInput, minlength, maxlength) {
        alert(userInput.attr('maxLength'))
        var msg = "El campo"+userInput+" requiere una cantidad minima de" +minlength+" .  ";
        var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }

    function lengthRange(inputtxt, minlength, maxlength)
                {  	
                console.log(inputtxt);
                var userInput = inputtxt;  
                if(userInput.length >= minlength && userInput.length <= maxlength)
                    {  	
                        return true;  	
                    }
                else
                    {
                    length(userInput, minlength, maxlength);      	
                    
                        return false;  	
                    }  
                }    
                function isValidEmail(email) {

                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
                }

$(".tab").css("display", "none");
$("#tab-1").css("display", "block");


let f_armarCombo = function(json) {
            $(json.emptyxxx).empty();
            $.each(json.combosxx, function(i, d) {
                $.each(d.comboxxx, function(j, dd) {
                    $('#' + d.selectid).append('<option  value="' + dd.valuexxx + '">' + dd
                        .optionxx + '</option>');
                })
            });
        }


var f_municipio = function(dataxxxx) {
            $.ajax({
                url: "{{ route('municipio') }}",
                data: dataxxxx,
                type: 'GET',
                dataType: 'json',
                success: function(json) {
                    f_armarCombo(json);
                },
                error: function(xhr, status) {
                    alert('Disculpe, existió un problema al cargar los municipios');
                },
            });
        }

        $('#sis_departam_id').change(function() {
            f_municipio({
                padrexxx: $(this).val(),
                selected: [0]
            });
        });
function run(hideTab, showTab){
        if(hideTab < showTab){ // If not press previous button
          // Validation if press next button
          var currentTab = 0;
          x = $('#tab-'+hideTab);
          y = $(x).find(".form-control.form-control-sm.validate");
          z = $(x).find(".selectize");
          var empty_fields=[];

            if (hideTab==1){
                if ($("#email").val() !== $("#emailCon").val()||$("#email").val() ==='') {
                    errorEmailIgual();
                    return;
                }


                // $('.selectize').find('input').on('blur', function(){
                //     var selected_customer = $(this).val();
                //     console.log(selected_customer);
                //     if(selected_customer === ''){
                //         alert(selected_customer);
                //         return;
                //     }
                //     });

                // $(".selectize").each(function() {
                //         // var select = $(this).selectize(
                //         //     //your options
                //         // );
                //         // console.log(select);
                //         // var selectize = select[0].selectize;
                //         // console.log(selectize.getValue);
                //         var nombre= `${this.id}`;
                //         var valor=  $(this).val();
                //         nombre= nombre.replace('[]','')
                //         console.log(nombre);
                //          console.log(valor);
                //         if(valor===""){
                //             $(this).css("background", "#ffdddd");
                //             $(".invalid-feedback."+nombre).show();
                //             camposfaltantes();
                //             return;
                //         }else{
                //             $(this).css("background", "transparent");
                //             $(".invalid-feedback."+nombre).hide();
                            
                //         }
                    
                //     });

            
          
                 


                // if ($("#tipoDocumento").val()==='') {
                //     TipoDocumento();
                //     return;
                // }
                if ($("#tipoSolicitud").val()===' ') {
                    TipoSolicitud();
                    return;
                }
         }
         if (hideTab==2){
                if ($("#emailApoderado").val() !== $("#emailApoderadoCon").val() || $("#emailApoderado").val() ==='') {
                    errorEmailIgualApod();
                    return;
                }

                if ($("#tipoDocApoderado").val()==='') {
                    TipoDocumento();
                    return;
                }
      
                

        }

        if (hideTab==3){
            

                if ($("#nomConvocante").val()===undefined) {
                    var texto="Nombre";
                    campostab2(texto);
                    return;
                }
                

        }

        /*
             if (hideTab==2){
                //  if ($("#nomConvocante").val()=== "") {
                //     var texto="Nombre";
                //     campostab2(texto);
                //      return;
                //  }
                //  if ($("#apeConvocante").val()=== "") {
                //     var texto="Apellido";
                //     campostab2(texto);
                //      return;
                //  }
                //  if ($("#emailConU").val()=== "") {
                //     var texto="Correo";
                //     campostab2(texto);
                //     return;
                //  }else if (isValidEmail($("#emailConU").val())) {
                //     $('.invalid-feedback.emailConU').hide();
                //  }else{
                //     $('.invalid-feedback.emailConU').show();
                //     correonovalido();
                //     return;
                //  }
                */
                for (i = 0; i < y.length; i++){
                    console.log(hideTab);
                    if (y[i].value == ""||$(y[i]).val().length < y[i].minLength){
                        var nombre= y[i].name;
                        $(y[i]).css("background", "#ffdddd");
                        console.log(y[i]);
                        console.log(nombre);
                        console.log(y[i].value);
                        nombre= nombre.replace('[]','')
                 
                        $('.invalid-feedback.'+nombre).show();
                        return false;
                    }else{
                        console.log(y[i].name);
                        var nombre= y[i].name;
            
                        nombre= nombre.replace('[]','');
                
                        $(y[i]).css("background", "transparent");
                        $('.invalid-feedback.'+nombre).hide();
                    }          
                  }
   
                  for (i = 0; i < z.length; i++){
                    console.log(hideTab);
                    var nombre= z[i].id;
                    if (z[i].value == ""||$(z[i]).val().length < z[i].minLength){
                 
                        $(z[i]).css("background", "#ffdddd");
                        console.log(z[i]);
                        console.log(nombre);
                        console.log(z[i].value);
                        nombre= nombre.replace('[]','')
                 
                        $('.invalid-feedback.'+nombre).show();
                        return false;
                    }else{
                        console.log(z[i].name);
                        var nombre= z[i].name;
            
                       
                
                        $(z[i]).css("background", "transparent");
                        $('.invalid-feedback.'+nombre).hide();
                    }          
                  }

             //}
            //      y.each(function() {
            //     //console.log(`${index}: ${this.id} ${value}`);
            //     var nombre= `${this.id}`;
            //     var valor=  $(this).val();
            //     nombre= nombre.replace('[]','')
            //      console.log(nombre);
            //      console.log(valor);
            //     if(valor===""){
            //         $(this).css("background", "#ffdddd");
            //         $(".invalid-feedback."+nombre).show();
            //         camposfaltantes();
            //         return false;
            //     }else{
            //         $(this).css("background", "transparent");
            //         $(".invalid-feedback."+nombre).hide();
                    
            //     }
            //    });
            //     y.each(function() {
            //     //console.log(`${index}: ${this.id} ${value}`);
            //     var nombre= `${this.id}`;
            //     var valor=  $(this).val();
            //     nombre= nombre.replace('[]','')
            //      console.log(nombre);
            //     // console.log(valor);
            //     if(valor===""){
            //         $(this).css("background", "#ffdddd");
            //         $(".invalid-feedback."+nombre).show();
            //         camposfaltantes();
            //         return;
            //     }else{
            //         $(this).css("background", "transparent");
            //         $(".invalid-feedback."+nombre).hide();
                    
            //     }
            //    });
               



        //    for (i = 0; i < y.length; i++){
        //     if (y[i].value == ""||$(y[i]).val().length < y[i].minLength){
        //         var nombre= y[i].name;
        //         $(y[i]).css("background", "#ffdddd");
   
        //         nombre= nombre.replace('[]','')
  
        //         $('.invalid-feedback.'+nombre).show();
        //         return false;
        //     }else{
        //         var nombre= y[i].name;
     
        //         nombre= nombre.replace('[]','')
        
        //         $(y[i]).css("background", "transparent");
        //         $('.invalid-feedback.'+nombre).hide();
        //     }          
        //   }
        }

        // Progress bar
        for (i = 1; i < showTab; i++){
          if($("#tipoSolicitud").val()===0){
            $("#step-2").hide();
          }else{
            $("#step-2").show();
            $("#step-2").removeClass('btn-light');
            $("#step-2").addClass('btn-step');
          }
           $("#step-"+i).addClass("opacity", "1");
          console.log(i)
          
        }

        // Switch tab
        $("#tab-"+hideTab).css("display", "none");
        $("#tab-"+showTab).css("display", "block");
        //$("#step-"+hideTab).removeClass('btn-success').addClass('btn-light');
        // $("#stepi-"+hideTab).css("display", "block"); 0f5132
        // $("#text-"+hideTab).css("display", "none");
        $("#step-"+showTab).removeClass('btn-light');
        $("#step-"+showTab).addClass('btn-step');
        //$("input").css("background", "#fff");
        if(showTab===1){
            $("#progressbar").css("width", "12%");
        }else
        if(showTab===2){
            $("#progressbar").css("width", "39%");
        }else
        if(showTab===3){
            $("#progressbar").css("width", "63.5%");
        }else{
            $("#progressbar").css("width", "89%");

        }
    
}

$('#add_btn').on('click',function(){
    var nomConvocante= $("#nomConvoc").val() ;
    var apeConvocante= $("#apeConvoca").val();
    var emailConU= $("#emailConvo").val();
    
    var html='';
     html+=' <tr>';
     html+='<td style="text-transform: uppercase"><input type="text" class="form-control form-control-sm" name="nomConvocante[]" id="nomConvocante" value="'+nomConvocante+'" style="display:none;" >'+nomConvocante+'</td>';
     html+='<td style="text-transform: uppercase"><input type="text" class="form-control form-control-sm" name="apeConvocante[]" id="apeConvocante" value="'+apeConvocante+'" style="display:none;" >'+apeConvocante+'</td>';
     html+='<td style="text-transform: lowercase"><input type="email" class="form-control form-control-sm" name="emailConvocante[]" id="emailConU" value='+emailConU+' style="display:none;" >'+emailConU+'</td>';
     html+='<td> <button type="button" id="deletebtn" class="btn btn btn-outline-danger deletebtn">Eliminar <i class="far fa-times-circle"></i></button> </td>';
     html+='</tr>';

     if(nomConvocante ==='' || apeConvocante ==='' || emailConU ===''){
        datosconvocados();
     }else
        if (isValidEmail(emailConU)) {
                    $('.invalid-feedback.emailConU').hide();
                    $("#emailConvo").css("background", "transparent");
                    $("#nomConvoc").val('');
                    $("#apeConvoca").val('');
                    $("#emailConvo").val('');
                    $('#tablita').append(html);
                 }else{
                    $('.invalid-feedback.emailConU').show();
                    $("#emailConvo").css("background", "#ffdddd");
                    correonovalido();
                    return;
                 }
                   
     
     
    });


    $(document).on('click','#deletebtn',function(){
            console.log('test');
            $(this).closest('tr').remove();
        });



        $(function(){
            $('#fechanacimiento').on('change', calcularEdad);
        });
        
        function calcularEdad() {
            
            fecha = $(this).val();
            var hoy = new Date();
            var cumpleanos = new Date(fecha);
            
            var edad = hoy.getFullYear() - cumpleanos.getFullYear();
            var m = hoy.getMonth() - cumpleanos.getMonth();

            if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                edad--;
            }

            if(edad<=5){
                $('#rangoedad').val('Primera Infancia (0-5 años)');
            }else 
            if(edad>=6&&edad<=11){
                $('#rangoedad').val('Infancia (6 - 11 años)');
            }else

            if(edad>=12&&edad<=14){
                $('#rangoedad').val('Adolescencia (12 - 13 años)');
            }else

            if(edad>=14&&edad<=26){
                $('#rangoedad').val('Juventud (14 - 26 años)');
            }else

            if(edad>=27&&edad<=59){
                $('#rangoedad').val('Adultez (27- 59 años)');
            }else

            if(edad>=60&&edad<100){
                $('#rangoedad').val('Persona Mayor (60 años o mas) envejecimiento y vejez');
            }else
            if(edad>=100){
                $('#rangoedad').val('Rango de edad no valida');
                rangofecha();
            }
                        
            



            //$('#edad').val(edad);
        }

    //     $(".btn").click(() => {
    //     alert('jorge');
    //     var id = $(".btn").val();
    //     console.log(id);
    //     seleccionarCondicion(id);
    // });

// function seleccionarCondicion(id){
//     console.log(id);
//         $.ajax({
//             url: "seleccionarCondicion",
//             type: "POST",
//             data: {
//                 id: id,
              
//             },
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             success: function(id) {
//                 console.log(id);
//                 },
//                 error: function(xhr, status) {
//                     alert('Disculpe, existió un problema al cargar los municipios');
//                 },
//         })
//     };





function soloNumeros(e) {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 48) || (keynum == 57))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    }

// const formEl = document.querySelector("form");
// const tbodyEl = document.querySelector("tbody");
// const tableEl = document.querySelector("table");
// function onAddWebsite(e) {
// e.preventDefault();
// const nomConvocante = document.getElementById("nomConvocante").value;
// const apeConvocante = document.getElementById("apeConvocante").value;
// const emailConU = document.getElementById("emailConU").value;
// tbodyEl.innerHTML += `
//             <tr>
//                 <td name="nomConvocante[]">${nomConvocante}</td>
//                 <td name="apeConvocante[]">${apeConvocante}</td>
//                 <td name="emailConU[]">${emailConU}</td>
//                 <td><button class="btn btn-danger deleteBtn">Eliminar</button></td>
//             </tr>
//         `;
  
// }

// function onDeleteRow(e) {
//         if (!e.target.classList.contains("deleteBtn")) {
//           return;
//         }

//         const btn = e.target;
//         btn.closest("tr").remove();
//       }

//       formEl.addEventListener("submit", onAddWebsite);
//       tableEl.addEventListener("click", onDeleteRow);

function auto_grow(element) {
    element.style.height = "8px";
    element.style.height = (element.scrollHeight)+"px";
}
document.getElementById("dire_id").hidden=true;
document.getElementById("apode_id").hidden=true;
function doc(valor){
 
        if(valor == 1){
         
            document.getElementById("full_div").hidden=false;
            document.getElementById("apode_id").hidden=false;
            document.getElementById("audi_div").hidden=true;
            document.getElementById("dire_id").hidden=true;
            
   
            
    }else{
 
        document.getElementById("full_div").hidden=true;
        document.getElementById("audi_div").hidden=false;
        document.getElementById("apode_id").hidden=true;
        document.getElementById("dire_id").hidden=false;
     
        }  
    } 

    function carga() {
        doc(document.getElementById('tipoSolicitud').value);
}

function doc1(valor){
        if(valor == 23){
         
  
            document.getElementById("sis_departam_id").readonly=false;
            document.getElementById("sis_municipio_id").readonly=false;
            
    }else{
    
        document.getElementById("sis_departam_id").readOnly=true;
        document.getElementById('sis_municipio_id').readOnly = true;
     
        }  
    } 

    function carga() {
        doc(document.getElementById('tipoSolicitud').value);
        
}


    window.onload=carga;


</script>

<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>    


@endsection