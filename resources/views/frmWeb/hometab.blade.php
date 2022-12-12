@extends('../mainUsrWeb')

@section('title','DATOS DEL DE CIUDADANO')

@section('AddScritpHeader')

@endsection

@section('content')




<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#frmRegistroDatos {
  background-color: #ffffff;
  padding: 40px;
  width: 100%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
<body>

<form id="frmRegistroDatos" action="/action_page.php">
    
    <div class="row">
        <div class="col-md-1"> </div>
        <div class="col-md-6 text-center">
            <h5><b class="text-justify">SOLICITUD DE CONCILIACIÓN VIA WEB</b></h5>
        </div>

  <!-- One "tab" for each step in the form: -->
  <div class="card tab">
    <div class="card-header">
        <b>DATOS DEL SOLICITANTE</b>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <label class="form-group has-float-label">
                    <span> 1. Tipo Documento *</span>
                {{ Form::select('tipoDocumento', $data['listaTipoDoc'], null, ['class' => $errors->first('tipoDocumento') ? 'form-select form-select-sm is-invalid' : 'form-select form-select-sm']) }}
                @if($errors->has('tipoDocumento'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('tipoDocumento') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required, minSize[4], maxSize[10]]" name="numeroDocumento" id="numeroDocumento" autocomplete="off">
                    <span> 2. No. de cédula *</span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="primerNombre" id="primerNombre" autocomplete="off">
                    <span> 3. Primer Nombre *</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[optional]" name="segundoNombre" id="segundoNombre" autocomplete="off">
                    <span> 4. Segundo Nombre </span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="primerApellido" id="primerApellido" autocomplete="off">
                    <span> 5. Primer Apellido *</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[optional]" name="segundoApellido" id="segundoApellido" autocomplete="off">
                    <span> 6. Segundo Apellido </span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required, minSize[10], maxSize[10]]" name="primerTelefono" id="primerTelefono" autocomplete="off">
                    <span> 7. Teléfono celular *</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[optional,  minSize[7], maxSize[10]]" name="segundoTelefono" id="segundoTelefono" autocomplete="off">
                    <span> 8. Teléfono fijo </span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="direccion" id="direccion" autocomplete="off">
                    <span> 9. Dirección *</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <span> 10. Localidad</span>
                {{ Form::select('localidad', $data['listaLocalidades'], null, ['class' => $errors->first('localidad') ? 'form-select form-select-sm is-invalid' : 'form-select form-select-sm']) }}
                @if($errors->has('localidad'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('localidad') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="email" id="email" autocomplete="off">
                    <span> 11. Correo electrónico *</span>
                </label>
            </div>
            <div class="col-md-6">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required, custom[email]]" name="emailCon" id="emailCon" autocomplete="off">
                    <span> 11.1. Confirme correo electrónico *</span>
                </label>
            </div>

        </div>

        <!-- INICIO TIPO DE SOLICITUD -->
        <div class="row">
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <select class="form-control form-control-sm custom-select validate[required]" name="tipoSolicitud" id="tipoSolicitud">
                        <option value=" ">- Seleccione una opcion -</option>
                        <option value="0">Directa</option>
                        <option value="1">Apoderado</option>
                    </select>
                    <span>12. Tipo de Solicitud *</span>
                </label>
            </div>
        </div>
        <!-- FIN TIPO SOLICITUD -->
    </div>
</div>
  <div class="tab">Contact Info:
    <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
    <p><input placeholder="Phone..." oninput="this.className = ''" name="phone"></p>
  </div>
  <div class="tab">Birthday:
    <p><input placeholder="dd" oninput="this.className = ''" name="dd"></p>
    <p><input placeholder="mm" oninput="this.className = ''" name="nn"></p>
    <p><input placeholder="yyyy" oninput="this.className = ''" name="yyyy"></p>
  </div>
  <div class="tab">Login Info:
    <p><input placeholder="Username..." oninput="this.className = ''" name="uname"></p>
    <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("frmRegistroDatos").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

@endsection