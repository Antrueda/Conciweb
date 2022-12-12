<div id="ciudadano">
    <div class="row">
        <div class="col-md-3">
            <label class="form-group has-float-label">
                <select class="form-control form-control-sm custom-select validate[required]" name="tipoDocumento" id="tipoDocumento" onchange="anonimo(this.value)" >
                    <option value=" ">- Seleccione una opcion -</option>
                    @foreach ($data['listaTipoDoc'] as $info)
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
            <input type="text" class="form-control form-control-sm validate[required]" name="fechaNacimiento" id="fechaNacimiento" autocomplete="off">
            <span> 9) Fecha de Nacimiento *</span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <select class="form-control form-control-sm custom-select validate[required]" name="tipoGenero" id="tipoGenero">
                <option value="">-Seleccione Dato-</option>
                <option value="FEMENINO">FEMENINO</option>
                <option value="MASCULINO">MASCULINO</option>
                <option value="N">NO INFORMA</option>
            </select>
            <span> 10) Género *</span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <select class="form-control form-control-sm custom-select validate[required]" name="gradoEscolaridad" id="gradoEscolaridad">
                <option value=" ">- Seleccione una opcion -</option>
                @foreach ($data['listaEscolaridad'] as $info)
                    <option value="{{$info->sicidgradoescolaridad}}">{!! $info->sicgradoescolaridad !!}</option>
                @endforeach
            </select>
            <span> 11) Grado Escolaridad *</span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <input type="text" class="form-control form-control-sm validate[required]" name="direccion" id="direccion" autocomplete="off">
            <span> 12) Dirección *</span>
        </label>
    </div>
</div>

<div class="row">
  <div class="col-md-3">
        <label class="form-group has-float-label">
            <select class="form-control form-control-sm custom-select validate[required]" name="tipoDepartamento" id="tipoDepartamento">
                <option value=" ">- Seleccione una opcion -</option>
                @foreach ($data['listaDepartamento'] as $info)
                    <option value="{{$info->siciddepartamento}}">{!! $info->sicdepartamento !!}</option>
                @endforeach
            </select>
            <span> 13) Departamento * </span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <select class="form-control form-control-sm custom-select validate[required]" name="tipoCiudad" id="tipoCiudad">
                <option value=" ">- Seleccione una opcion -</option>
            </select>
            <span> 14) Ciudad *</span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <select class="form-control form-control-sm custom-select validate[optional]" name="tipoEstrato" id="tipoEstrato">
                <option value=" ">- Seleccione una opcion -</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="0">SIN REGISTRO</option>
            </select>
            <span> 15) Estrato *</span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <input type="text" class="form-control form-control-sm validate[required]" name="telefono" id="telefono" autocomplete="off">
            <span> 16) Teléfono 1 *</span>
        </label>
    </div>  
</div>

<script>
    $('#fechaNacimiento').datetimepicker({
        startDate:	'+1970/01/01',
        lang:'es',
        format:'d/m/Y', //format:'d/m/Y H:i',
        maxDate:0, // Bloquea días futuros
        timepickerScrollbar:false,
        timepicker:false,
        closeOnDateSelect: true,
    });

    $("#tipoDepartamento").change(function(){
        $.ajax({
            url:"consultalistaCiudadaes",
            type: "POST",
            data: { idDeparamento: $("#tipoDepartamento").val() },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(opciones){
                $('#tipoCiudad')
                    .find('option')
                    .remove()
                    .end()
                    .val('whatever');
                opciones.forEach(element => $('#tipoCiudad').append(new Option(element['sicciudad'], element['sicidciudad'])) );
            }
        })
    });

    $(function(){
        $('#ciudadano').on('blur','#numeroDocuemnto',function(){
            var valor=this.value;
            if(valor.length>=3) {
                var consulta = $.ajax({
                    type: 'POST',
                    url: 'consultaDatosCiudadano',
                    data: {numeroDocuemnto: valor},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'JSON'
                });
                consulta.done(function(data){
                    if(data==null){
                        //LIMPIAR TODOS LOS CAMPOS
                        $('#tipoDocumento').val('');    $('#ciudadExpedicion').val(''); $('#tipoPersona').val('');  $('#primerNombre').val('');
                        $('#segundoNombre').val('');    $('#primerApellido').val('');   $('#segundoApellido').val('');  $('#fechaNacimiento').val('');
                        $('#tipoGenero').val('');   $('#gradoEscolaridad').val('');     $('#direccion').val('');    $('#tipoDepartamento').val('');
                        $('#tipoCiudad').val('');   $('#tipoEstrato').val('');  $('#telefono').val('');
                        //NOTY CON RESPUESTA DEL ESTADO DEL USUARIO
                        var msg = "<center><p><i class='fas fa-user-slash fa-3x'></i></p> CIUDADANO SIN DATOS EN EL SISTEMA&nbsp; </center>";
                        llamarNotyTime('error',msg,'topRight',2000);
                        return false;
                    }else{
                        //ASIGNAR RESULTADO EN CADA ID
                        $('#tipoDocumento').val(data[0]['sicidtipodocumento']); $('#ciudadExpedicion').val(data[0]['sicciudadexpedicion']);
                        $('#tipoPersona').val(data[0]['sicnaturaleza']);    $('#primerNombre').val(data[0]['sicprimernombre']);
                        $('#segundoNombre').val(data[0]['sicsegundonombre']);   $('#primerApellido').val(data[0]['sicprimerapellido']);
                        $('#segundoApellido').val(data[0]['sicsegundoapellido']);   $('#fechaNacimiento').val(data[0]['sicfechanacimiento']);
                        $('#tipoGenero').val(data[0]['sicsexo']);   $('#gradoEscolaridad').val(data[0]['sicidgradoescolaridad']);
                        $('#direccion').val(data[0]['sicdireccion']);   $('#tipoEstrato').val(data[0]['sicestrato']);   $('#telefono').val(data[0]['siccelular']);
                        //NOTY CON RESPUESTA DEL ESTADO DEL USUARIO
                        var msg = "<center><p><i class='fas fa-user-check fa-3x'></i></p> REGISTRO DEL CIUDADANO ENCONTRADO EN EL SISTEMA&nbsp; </center>";
                        llamarNotyTime('success',msg,'topRight',2000);
                        return true;
                    }
                });
            }
        });
    });

    function anonimo(dato){
        var rol=$('#rolCiudadano').val();
        if(rol=='CONVOCADO' && dato==7){
            var msg = "<center><p><i class='fas fa-user-clock fa-3x'></i></p> <b>El tipo de identificación seleccionado genera automaticamente un número de identificación que podra ser modificado al conocer los datos.</b>&nbsp; </center>";
            llamarNotyTime('info',msg,'center',4000);
            $('#numeroDocuemnto').val(numeroAleatorio(800000000000, 900000000000));
            $('#numeroDocuemnto').prop('readonly', true);
            $('#ciudadExpedicion').val('NO INFORMA'); $('#tipoPersona').val('NO INFORMA');  $('#primerNombre').val('NO INFORMA');
            $('#segundoNombre').val('NO INFORMA');    $('#primerApellido').val('NO INFORMA');   $('#segundoApellido').val('NO INFORMA');  $('#fechaNacimiento').val('01/01/1800');
            $('#tipoGenero').val('N');   $('#gradoEscolaridad').val(13);     $('#direccion').val('SIN CONOCIMIENTO');    $('#tipoDepartamento').val('');
            $('#tipoCiudad').val('');   $('#tipoEstrato').val(0);  $('#telefono').val('0000000');
        }else{
            $('#inputId').prop('readonly', false);
            $('#ciudadExpedicion').val(''); $('#tipoPersona').val('');  $('#primerNombre').val('');
            $('#segundoNombre').val('');    $('#primerApellido').val('');   $('#segundoApellido').val('');  $('#fechaNacimiento').val('');
            $('#tipoGenero').val('');   $('#gradoEscolaridad').val('');     $('#direccion').val('');    $('#tipoDepartamento').val('');
            $('#tipoCiudad').val('');   $('#tipoEstrato').val('');  $('#telefono').val('');
        }
    }

    function numeroAleatorio(min, max) {
        return Math.round(Math.random() * (max - min) + min);
    }
</script>