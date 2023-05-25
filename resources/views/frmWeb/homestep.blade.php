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

.selectize-input {
    min-height: calc(1.5em + 0.5rem + calc(var(--bs-border-width) * 2));
    padding: 0.25rem 0.5rem;
    font-size: .875rem;
    color: black;
    border-radius: 0.25rem;
    appearance: none;
    color: var(--bs-body-color);
        border: 0px solid #d0d0d0;
        background: 0 0!important;
}
.selectize-input>input[placeholder] {
    box-sizing: initial;
    color: black;
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
.progress{
        height: 25px;
}
.progress-bar{
        height: 25px;
        color: transparent;
        opacity: 0.0;
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
    line-height: 1.528571429;
    border-radius: 25px;
    margin-top: -2px; 
    }
.btn-indigo{
    background-color: #6610f2;
    color: white;
}
.btn-default{
    background-color: #20c997;
    color: white;
}

.btn-light{
    border-color: #0a5b42;
    opacity: 20px;
    
}

.btn-light:hover {
  color: #1F2D3D;
  background-color: #e2e6ea;
  
}
.btn-primary{
    border-color: #2039c9;
  

 
}




</style>
    <div class="row">
        <center>
        <div class="col-md-6">
            {{-- <h5><b class="text-justify">SOLICITUD DE CONCILIACIÓN</b></h5> --}}
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

      {{-- <div class="progress">
        <span class="progress-bar progress-bar-striped progress-bar-animated" id = "step-1" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</span>
        <span class="progress-bar progress-bar-striped progress-bar-animated" id = "step-2" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</span>
        <span class="progress-bar progress-bar-striped progress-bar-animated" id = "step-3" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</span>
        <span class="progress-bar progress-bar-striped progress-bar-animated" id = "step-4" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</span>
    </div>
     --}}
    <div class="steps-form">
        <div class="steps-row setup-panel">
          <div class="steps-step">
            <a href="#step-1" type="button" class="btn btn-success btn-circle" id = "step-1"><span id="text-1">1</span><i id="stepi-1" class="fas fa-check" style="display:none;"></i></a>
        
            

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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating">
         
                    {{ Form::select('tipoDocumento', $data['listaTipoDoc'], null, ['class' => $errors->first('tipoDocumento') ? 'form-select form-select-sm is-invalid' : 'form-select form-select-sm validate[required]'.'required','id'=>'tipoDocumento','aria-label'=>"tipoDocumento",'required']) }}
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
                    <input type="text" class="form-control form-control-sm validate" id="numeroDocumento" name="numeroDocumento" autocomplete="off" onkeypress = "return soloNumeros(event);" required placeholder="0" minlength="4" maxlength="10" pattern="[0-9]+">
                    <label for="numeroDocumento">2. No. de cédula *</label>
                    <div class="invalid-feedback numeroDocumento">
                        Campo obligatorio.
                      </div>
 
                  </div>
                </div>

                
              
     
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm validate" minlength="3" name="primerNombre" id="primerNombre" autocomplete="off" placeholder="0" required>
                        <label for="primerNombre">3. Primer Nombre *</label>
                        <div class="invalid-feedback primerNombre">
                            Campo obligatorio.
                          </div>
                </div>
                </div>

                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="segundoNombre" id="segundoNombre" autocomplete="off" placeholder="0" >
                        <label for="segundoNombre">4. Segundo Nombre</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" minlength="3" name="primerApellido" id="primerApellido" autocomplete="off" placeholder="0" required>
                        <label for="primerApellido">5. Primer Apellido*</label>
                        <div class="invalid-feedback primerApellido">
                            Campo obligatorio.
                          </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="segundoApellido" id="segundoApellido" autocomplete="off" placeholder="0">
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
                        <input type="text" class="form-control form-control-sm validate" name="direccion" id="direccion" autocomplete="off" placeholder="0" required>
                        <label for="direccion">9. Dirección *</label>
                        <div class="invalid-feedback direccion">
                            Campo obligatorio.
                          </div>
                    </div>
                </div>
                <div class="col-md-3">
    
                    <div class="form-floating mb-3">
      
                    {{ Form::select('localidad', $data['listaLocalidades'], null, ['class' => $errors->first('localidad') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','id'=>'localidad','required', 'onchange' => 'doc1(this.value)']) }}
                    @if($errors->has('localidad'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->first('localidad') }}
                        </div>
                    @endif
                    <label for="localidad"> 10. Localidad *</label>
                  </div>
                </div>
            

                    <div class="col-md-3" id="fuera_div" style="display:none">
    
                        <div class="form-floating mb-3">
                            {!! Form::select('sis_departam_id',  $data['departamentos'], null, ['class' => 'form-control form-control-sm', 'id'=>'sis_departam_id']) !!}
                    @if($errors->has('sis_departam_id'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->first('sis_departam_id') }}
                        </div>
                    @endif
                    <label for="sis_departam_id"> Departamento:</label>
                  </div>
                </div>
       
                <div class="col-md-3" id="fueras_div" style="display:none">
    
                    <div class="form-floating mb-3">
  
                        {!! Form::select('sis_municipio_id',  $data['municipios'], null, ['class' => 'form-control form-control-sm','id'=>'sis_municipio_id']) !!}
                @if($errors->has('sis_municipio_id'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('sis_municipio_id') }}
                    </div>
                @endif
                <label for="sis_municipio_id"> Municipio</label>
              </div>
            </div>
            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::date('fechanacimiento', null, ['class' => $errors->first('fechanacimiento') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','id'=>'fechanacimiento','required', 'max'=>$data['Maxhoy']]) }}
                @if($errors->has('fechanacimiento'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('fechanacimiento') }}
                    </div>
                @endif
                <label for="fechanacimiento"> 11. Fecha de Nacimiento *</label>
              </div>
            </div>

            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::text('rangoedad', null, ['class' => $errors->first('rangoedad') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','id'=>'rangoedad']) }}
        
                <label for="rangoedad">12. Rango de Edad</label>
              </div>
            </div>
            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::select('escolaridad', $data['escolaridad'], null, ['class' => $errors->first('escolaridad') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','id'=>'escolaridad','required']) }}
                @if($errors->has('escolaridad'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('escolaridad') }}
                    </div>
                @endif
                <label for="escolaridad"> 13. Nivel de Escolaridad *</label>
              </div>
            </div>
            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::select('nacionalidad', $data['nacionalidad'], null, ['class' => $errors->first('nacionalidad') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm','placeholder'=>'Seleccione','id'=>'nacionalidad','required',]) }}
                @if($errors->has('nacionalidad'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('nacionalidad') }}
                    </div>
                @endif
                <label for="nacionalidad"> 14. Nacionalidad *</label>
              </div>
            </div>
            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::select('sexo', $data['sexocombo'], null, ['class' => $errors->first('sexo') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','id'=>'sexo','required', ]) }}
                @if($errors->has('sexo'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('sexo') }}
                    </div>
                @endif
                <label for="sexo"> 15. Sexo *</label>
              </div>
            </div>
            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::select('genero', $data['generocombo'], null, ['class' => $errors->first('localidad') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','id'=>'localidad','required', ]) }}
                @if($errors->has('genero'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('localidad') }}
                    </div>
                @endif
                <label for="genero"> 16. Identidad de Genero *</label>
              </div>
            </div>

            <div class="col-md-3">
    
                <div class="form-floating mb-3">
  
                {{ Form::select('orientacion', $data['orientacioncombo'], null, ['class' => $errors->first('orientacion') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','id'=>'orientacion','required',]) }}
                @if($errors->has('orientacion'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('orientacion') }}
                    </div>
                @endif
                <label for="localidad"> 17. Orientación Sexual *</label>
              </div>
            </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                    
                        <input type="email" class="form-control form-control-sm validate[required, custom[email]]" name="email" id="email" autocomplete="off" placeholder="0">
                        <label for="email"> 18. Correo electrónico *</label>
                        <div class="invalid-feedback email">
                            Campo obligatorio.
                          </div>
                     </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailCon" id="emailCon" autocomplete="off" placeholder="0">
                        <label for="emailCon"> 18.1. Confirme correo electrónico *</label>
                    </div> 
                </div>

           

            <!-- INICIO TIPO DE SOLICITUD -->
        
                <div class="col-md-3">
                    
                    <div class="form-floating mb-3">
                        <select class="form-select form-select-sm validate[required]" name="tipoSolicitud" id="tipoSolicitud" onchange = 'doc(this.value)' required>
                            <option value=" ">- Seleccione una opcion -</option>
                            <option value="0">Directa</option>
                            <option value="1">Apoderado</option>
                        </select>
                        <label for="tipoSolicitud"> 19. Tipo de Solicitud *</label>
                        <div class="invalid-feedback">Example invalid select feedback</div>
                        </div>
                    </div> 
                    <div class="col-md-3">
    
                        <div class="form-floating mb-3">
                            
                        {{ Form::select('grupoafectado', $data['grupoafectado'], null, ['class' => $errors->first('grupoafectado') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm','id'=>'grupoafectado','required',]) }}
                        @if($errors->has('grupoafectado'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('grupoafectado') }}
                            </div>
                        @endif
                        <label for="localidad"> 20. Grupo Afectado *</label>
                      </div>
                    </div>
                    <div class="d-flex mt-3 mb-1">
                        <label class="py-1">21. Condiciones de Protección</label>
                    </div>
                    <div class="container pb-2 @error('selectedCondiciones') is-invalid border border-danger @enderror">            
                        <div class="row row-cols-sm-3 justify-content-md-center px-5 pt-3">
                            @foreach ($listaCondicionesProteccion as $key => $condicion)
                                <div class="col col-md-1">                                                
                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-title="{{$condicion['nombre']}}" @isset($condicion['descripcion']) data-bs-content="{{ $condicion['descripcion'] }}" @endisset >
                                        <button class="btn" onclick="seleccionarCondicion({{$key}});" @if(!$condicion['enabled']) echo disabled @endif type="button">
                                            {{-- <button class="btn" wire:click="seleccionarCondicion({{$key}})" @if(!$condicion['enabled']) echo disabled @endif type="button"> --}}
                                            @if(!$condicion['checked']) 
                                                <img src="{{URL::asset($condicion['imagen_on'])}}" alt="">
                                            @else 
                                                <img src="{{URL::asset($condicion['imagen_off'])}}" alt="">
                                            @endif
                                        </button>
                                    </span>
                                </div>
                            @endforeach
                            {{-- <div class="col col-md-2">
                                <div class="d-flex w-100 h-100 align-items-center justify-content-center">
                                    <button wire:click="resetCondiciones" type="button" class="btn btn-danger ">
                                        Reiniciar
                                    </button>
                                </div>
                            </div> --}}
                        </div>
                        {{-- <div wire:loading wire:target="seleccionarCondicion, resetCondiciones" class="row row-cols-1 pt-1">
                            <div class="col">
                                <div class="clearfix">
                                    <div class="spinner-border float-end" role="status">
                                      <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    @error('selectedCondiciones')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
       
               
            </div>
            <br>
            <!-- FIN TIPO SOLICITUD -->
            <center>
                <div id="apode_id">
                <div class="btn btn-success" onclick="run(1, 2);" style="width: 120px">Siguiente <i class="fas fa-angle-right"></i></div>
                 </div>
                 <div id="dire_id">
                <div class="btn btn-success" onclick="run(1, 3);" style="width: 120px">Siguiente <i class="fas fa-angle-right"></i></div>
             </div>
            </center>
            <br>
        </div>

    </div>
    <!-- FIN DATOS DEL SOLICTANTE -->
    <!-- INICIO DATOS DE LOS CONVOCADOS -->
    <div class="card tab" id="tab-2">
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
                    <div class="invalid-feedback tipoDocApoderado">
                        Campo obligatorio.
                      </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" name="numDocApoderado" id="numDocApoderado" autocomplete="off" placeholder="0" onkeypress = "return soloNumeros(event);">
                        <label for="numDocApoderado"> 11.2. No. de cédula *</label>
                        <div class="invalid-feedback numDocApoderado">
                            Campo obligatorio.
                          </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" name="primerNombreApoderado" id="primerNombreApoderado" autocomplete="off" placeholder="0">
                        <label for="primerNombreApoderado"> 11.3. Primer Nombre *</label>
                        <div class="invalid-feedback primerNombreApoderado">
                            Campo obligatorio.
                          </div>
                       
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
                        <div class="invalid-feedback primerApellidoApoderado">
                            Campo obligatorio.
                          </div>

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
                        <div class="invalid-feedback tarjetaProfesional">
                            Campo obligatorio.
                          </div>
            
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="direccionApoderado" id="direccionApoderado" autocomplete="off" placeholder="0">
                        <label for="tarjetaProfesional"> 11.8. Dirección *</label>
                        <div class="invalid-feedback direccionApoderado">
                            Campo obligatorio.
                          </div>
                       
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate" name="primerTelefonoApoderado" id="primerTelefonoApoderado" autocomplete="off" placeholder="0" onkeypress = "return soloNumeros(event);">
                        <label for="primerTelefonoApoderado"> 11.9. Teléfono Celular *</label>
                        <div class="invalid-feedback primerTelefonoApoderado">
                            Campo obligatorio.
                          </div>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate[required minSize[7], maxSize[10]]" name="segundoTelefonoApoderado" id="segundoTelefonoApoderado" autocomplete="off" placeholder="0" onkeypress = "return soloNumeros(event);">
                        <label for="segundoTelefonoApoderado"> 11.10. Teléfono fijo</label>
           
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailApoderado" id="emailApoderado" autocomplete="off" placeholder="0">
                        <label for="emailApoderado"> 11.10. Correo electronico*</label>
                        <div class="invalid-feedback emailApoderado">
                            Campo obligatorio.
                          </div>
             
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailApoderadoCon" id="emailApoderadoCon" autocomplete="off" placeholder="0">
                        <label for="emailApoderadoCon"> 11.12. Confirme correo electronico *</label>
                        <div class="invalid-feedback emailApoderadoCon">
                            Campo obligatorio.
                          </div>
                    </div>
                </div>
            </div>
        </div>

   
        <center>
        <div class="btn btn-success" onclick="run(2, 1);" style="width: 120px"><i class="fas fa-angle-left"></i> Anterior</div>
        <div class="btn btn-success" onclick="run(2, 3);" style="width: 120px">Siguiente<i class="fas fa-angle-right"></i></div>
        </center>
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
            <div class="card-body">
                <p class="text-justify">Si es un numero plural de convocados indique los correos electrónicos de cada uno de ellos. Se advierte que la invitación a la audiencia de conciliación virtual se realizará por correo electrónico, y por tanto deben ser verídicos. Si no cuenta con ellos, adelante la solicitud de conciliación presencial en la Sedes de Conciliación del Personería de Bogotá D.C. que se encuentra publicadas en la página web de la Entidad.</p>
                <div class="agregar">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="nomConvoc" id="nomConvoc" autocomplete="off" placeholder="0" minlength="3" >
                            <label for="nomConvoc">Nombres convocado</label>
                            <div class="invalid-feedback nomConvoc">
                                Campo obligatorio.
                              </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="apeConvoca" id="apeConvoca" autocomplete="off" placeholder="0" minlength="3" >
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
                    <div class="col-md-3">
                         
                   <button type="button" class="btn btn-success" id="add_btn" >Agregar <i class="fas fa-plus"></i></button> 
                    
    
      
                  </div>
                </div>
              
            </div>
            <div class="test">
                <div class="row">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Nombres Convocado</th>
                        <th>Apellidos Convocado</th>
                        <th>Email</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="tablita"></tbody>
                  </table>
                </div>
                </div>
               
               
            </div>


            <center>
            <div class="btn btn-success" onclick="run(3, 1);" id="audi_div" style="width: 120px"><i class="fas fa-angle-left"></i> Anterior</div>
            <div class="btn btn-success" onclick="run(3, 2);" id="full_div" style="width: 120px"><i class="fas fa-angle-left"></i> Anterior</div>
            <div class="btn btn-success" onclick="run(3, 4);" style="width: 120px">Siguiente <i class="fas fa-angle-right"></i></div>
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
                                <textarea class="form-control form-control-sm validate[required, maxSize[1000]]" name="detalle" id="detalle" placeholder="Resumen" maxlength="1000" ></textarea>
                                <label for="detalle"> 15. Resumen de la pretensión o conflicto (Máximo 1000 caracteres)*</label>
                                <span id="chars"></span>
                                </div>
             
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-justify">
                            <div class="alert alert-success text-justify" role="alert">
                                <small class="text-justify">La pretensión no podrá ser superior a <span style="color: red">100 SMMLV (${{(number_format($data['salario']->maximo));}})</span>, salvo que se trate de solicitudes de conciliación promovida por persona natural deudor hipotecario y por persona natural que reclame ser damnificado o victima el pago de indemnización de seguros de responsabilidad civil.</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input class="form-control form-control-sm validate" type="text" name="cuantia" id="cuantia" onkeypress = "return soloNumeros(event);" autocomplete="off" placeholder="0" min="1" max="116000000" maxlength="10">
                                <label for="cuantia"> 16. Valor de la Cuantía *</label>
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
         
                <div class="btn btn-success" onclick="run(4, 3);" style="width: 120px"><i class="fas fa-angle-left"></i> Anterior</div>
                <br>
                <hr>
                {!! htmlFormSnippet() !!}
                <br>
                <div class="row">
                    <div class="col-md-4" style="padding-left: 10%;margin-top:10px;margin-left:30%">
                      <button type="button" class="btn btn-success btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"> <span class="fa fa-save pr-4"> </span> Registrar Solicitud</button>
                    </div>
                  </div>

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
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"> </i> Si </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> No</button>
                
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
                <br>
            </div>
        </div>

       
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
        var msg = "Los correos electrónicos del solicitante en el campo 11 y 11.1 no son iguales. Por favor verifíquelos.  ";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }
    
    function TipoSolicitud() {
        var msg = "12. Seleccione un tipo de solicitud.  ";
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }

    function campostab2(texto) {
        var msg = "Faltan el campo." +texto;
        var msg = "<center><p><i class='fas fa-times-circle fa-3x'></i></p></center>" + msg;
        llamarNotyTime('error', msg, 'center', 3000);
    }
    function correonovalido() {
        var msg = "Formato de correo no valido.";
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
        var msg = "Los correos electrónicos del apoderado en el campo 11.11 y 11.12 no son iguales Por favor verifíquelos.  ";
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
//      html+='<button type="button" class="btn btn-danger" id="remove" style="height: 50px; width: 120px">Eliminar <i class="fas fa-minus"></i></button>'
//      html+='   </div>';
//      html+='</div>'
//      html+='</div>'
     
 

//     /*
//      html+='<tr>';
//      html+='<td><input type="text" class="form-control form-control-sm validate" name="nomConvocante[]" autocomplete="off"></td>';
//      html+='<td><input type="text" class="form-control form-control-sm" name="emailConvocante[]" id="emailConU" autocomplete="off"></td>';
//      html+='<td><input type="text" class="form-control form-control-sm" id="emailConUC[]" autocomplete="off"></td>';
//      html+='<td><button type="button" class="btn btn-success" id="remove"><i class="fas fa-minus"></i></button></td>';
//      html+='</tr>';
//      html+='<br>
//      html+='<div class="row">
//      html+='<div class="col-md-3">
//      html+='<div class="form-floating mb-3">
//      html+='<input type="text" class="form-control form-control-sm validate" name="nomConvocante[]" id="primerNombre" autocomplete="off" placeholder="0">
//      html+='<label for="nomConvocante">Nombre completo convocado</label>
//      html+='</label>
//      html+='</div>
//      html+='</div>
//      html+='<div class="col-md-3">
//      html+='<div class="form-floating mb-3">
//      html+='<input type="email" class="form-control form-control-sm validate[required, custom[email]]" name="emailConvocante[]" id="email" autocomplete="off" placeholder="0">
//      html+='<label for="email"> Correo electronico</label>
//      html+='         </div> 
//      html+='    </div>
//      html+='    <div class="col-md-3">
//      html+='       <div class="form-floating mb-3">
//      html+='           <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailCon" id="emailConUC" autocomplete="off" placeholder="0">
//      html+='           <label for="emailCon"> Confirme correo electronico</label>
//      html+='       </div> 
//      html+='   </div>
//      html+='<br>
// */ 
//      $('.agregar').append(html);
//     });
//     $(document).on('click','#remove',function(){
//             $(this).closest('#lista').remove();
//         });

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

    $("#localidad").change(function() {
        
        if ($("#localidad").val()==23) {
            console.log($("#localidad").val());
            $("#fuera_div").css("display", "block");
            $("#fueras_div").css("display", "block");
            
        } else {
            $("#fuera_div").css("display", "none");
            $("#fueras_div").css("display", "none");
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
//change selectboxes to selectize mode to be searchable
$('#nacionalidad').selectize({
    searchField: 'option',
    valueField: 'id',
      });
      $('#grupoafectado').selectize({
    searchField: 'option',
    valueField: 'id',
      });
})  ;


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

            if (hideTab==1){
                if ($("#email").val() !== $("#emailCon").val()||$("#email").val() ==='') {
                    errorEmailIgual();
                    return;
                }

                if ($("#tipoDocumento").val()==='') {
                    TipoDocumento();
                    return;
                }
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

                if ($("#tipoDocumento").val()==='') {
                    TipoDocumento();
                    return;
                }
                if ($("#tipoSolicitud").val()===' ') {
                    TipoSolicitud();
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
                    if (y[i].value == ""||$(y[i]).val().length < y[i].minLength){
                        var nombre= y[i].name;
                        $(y[i]).css("background", "#ffdddd");
                        console.log(y[i].value);
                        nombre= nombre.replace('[]','')
        
                        $('.invalid-feedback.'+nombre).show();
                        return false;
                    }else{
                        console.log(y[i].name);
                        var nombre= y[i].name;
            
                        nombre= nombre.replace('[]','')
                
                        $(y[i]).css("background", "transparent");
                        $('.invalid-feedback.'+nombre).hide();
                    }          
                  }

             //}
                
                y.each(function() {
                //console.log(`${index}: ${this.id} ${value}`);
                var nombre= `${this.id}`;
                var valor=  $(this).val();
                nombre= nombre.replace('[]','')
                console.log(nombre);
                console.log(valor);
                if(valor===""){
                    $(this).css("background", "#ffdddd");
                    $(".invalid-feedback."+nombre).show();
                    camposfaltantes();
                    return;
                }else{
                    $(this).css("background", "transparent");
                    $(".invalid-feedback."+nombre).hide();
                    
                }
               });



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
          }
        //   $("#step-"+i).addClass("opacity", "1");
          console.log(i)
        }

        // Switch tab
        $("#tab-"+hideTab).css("display", "none");
        $("#tab-"+showTab).css("display", "block");
        $("#step-"+hideTab).removeClass('btn-success').addClass('btn-light');
       // $("#stepi-"+hideTab).css("display", "block");
       // $("#text-"+hideTab).css("display", "none");
        $("#step-"+showTab).removeClass('btn-light');
        $("#step-"+showTab).addClass('btn-success');
        $("input").css("background", "#fff");
    
}

$('#add_btn').on('click',function(){
    var nomConvocante= $("#nomConvoc").val() ;
    var apeConvocante= $("#apeConvoca").val();
    var emailConU= $("#emailCon").val();

    var html='';
     html+=' <tr>';
     html+='<td><input type="text" class="form-control form-control-sm" name="nomConvocante[]" id="nomConvocante" value='+nomConvocante+' style="display:none;" >'+nomConvocante+'</td>';
     html+='<td><input type="text" class="form-control form-control-sm" name="apeConvocante[]" id="apeConvocante" value='+apeConvocante+' style="display:none;" >'+apeConvocante+'</td>';
     html+='<td><input type="email" class="form-control form-control-sm" name="emailConvocante[]" id="emailConU" value='+emailConU+' style="display:none;" >'+emailConU+'</td>';
     html+='<td> <button type="button" id="deletebtn" class="btn btn-danger deletebtn">Eliminar</button> </td>';
     html+='</tr>';

     if(nomConvocante ==='' || apeConvocante ==='' || emailConU ===''){
        datosconvocados();
     }else
        if (isValidEmail(emailConU)) {
                    $('.invalid-feedback.emailConU').hide();
                    $("#nomConvocantes").val('');
                    $("#apeConvocantes").val('');
                    $("#emailConUs").val('');
                    $('#tablita').append(html);
                 }else{
                    $('.invalid-feedback.emailConU').show();
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

            if(edad>=60){
                $('#rangoedad').val('Persona Mayor (60 años o mas) envejecimiento y vejez');
            }
                        
            



            //$('#edad').val(edad);
        }

    //     $(".btn").click(() => {
    //     alert('jorge');
    //     var id = $(".btn").val();
    //     console.log(id);
    //     seleccionarCondicion(id);
    // });

function seleccionarCondicion(id){
    console.log(id);
        $.ajax({
            url: "seleccionarCondicion",
            type: "POST",
            data: {
                id: id,
              
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(id) {
                console.log(id);
                },
                error: function(xhr, status) {
                    alert('Disculpe, existió un problema al cargar los municipios');
                },
        })
    };





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



function doc(valor){
    document.getElementById("dire_id").hidden=true;
    document.getElementById("apode_id").hidden=false;
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
         
            document.getElementById("fuera_div").hidden=false;
            
    }else{
        document.getElementById("fuera_div").hidden=true;
     
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