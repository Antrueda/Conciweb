

//Funcion que permite mostrar modals bloqueados

//Funcion que permite ocultar modals bloqueados



$( document ).ready(function() {
$('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        animate: true,
        delay: 500,
        html: true,
        container: 'body'
    });

    var valido = false;
    var hoy = new Date();
    var diaHoy = hoy.getDay();
    var horaHoy = hoy.getHours();

    if (diaHoy != 6 && diaHoy != 0) {
        if (horaHoy > 6 && horaHoy < 18) {
            valido = true;
        }
    }

});



function DatosPersonales(){
    MostrarModal('datosPersonalesModal');
}

//Despliega el modal con las preguntas iniciales
function QueRequiere(){
    OcultarModal('datosPersonalesModal');
    //Consulta las opciones de los selects por cada requerimiento
    $.ajax({
        url: "GetSelectTematica",
        beforeSend: function () { MostrarModal('modalLoading'); },
        success: function () { OcultarModal('modalLoading'); }
    }).done(function(respuesta) {
        $('#tematicaTutela0').html(respuesta.optionsTematicasTutelas);
        $('#requerimiento').html(respuesta.optionsRequerimientos);
        $('#tematicaImpugnacion0').html(respuesta.optionsTematicasImpugnacion);
        $('#tematicaDesacato0').html(respuesta.optionsTematicasDesacato);
        MostrarModal('modalQueRequiere');
        $('#tematicaTutela0').select2({width:'100%', dropdownParent: "#DtematicaTutela0"});
        $('#tematicaImpugnacion0').select2({width:'100%', dropdownParent: "#DtematicaImpugnacion0"});
        $('#tematicaDesacato0').select2({width:'100%', dropdownParent: "#DtematicaDesacato0"});
    });
}

//Despliega la lista de archivos requeridos por cada solicitud y temática
function SeleccionSolicitud(){
    var tipo = $('#tabClic').val();
    var tematica = null;
    var labelSelect = '';
    if (tipo == 1) {
        tematica = $('#tematicaTutela').val();
        if (tematica==null) {
            labelSelect='tematicaTutela0';
        } else{
            labelSelect='tematicaTutela';
        }
        $('#tipoSolicitud').val('Tutela');
    }
    if (tipo == 2) {
        tematica = $('#tematicaImpugnacion').val();
        if (tematica==null) {
            labelSelect='tematicaImpugnacion0';
        } else{
            labelSelect='tematicaImpugnacion';
        }
        $('#tipoSolicitud').val('Impugnación');
        tematica = 160;
    }
    if (tipo == 3) {
        tematica = $('#tematicaDesacato').val();
        if (tematica==null) {
            labelSelect='tematicaDesacato0';
        } else{
            labelSelect='tematicaDesacato';
        }
        $('#tipoSolicitud').val('Desacato');
        tematica = 160;
    }
    $('#requerimiento').val(tipo);
    if (tematica != '' && tematica != null && tipo != '') {
        //Consulta la lista de archivos requeridos para la tematica seleccionada
        $.ajax({
            url: "GetArchivosXTemanicas/" + tematica,
            beforeSend: function () { MostrarModal('modalLoading'); },
            success: function () { OcultarModal('modalLoading'); }
        }).done(function(respuesta) {
            $('#listaArchivos').html(respuesta.listaArchivos);
            $('#tablaArchivos').html(respuesta.tablaArchivos);
            $('#archivosTodos').val(respuesta.todos);
            $('#archivosRequeridos').val(respuesta.requeridos);
            OcultarModal('modalQueRequiere');
            MostrarModal('modalListaArchivos');
        });
    } else{
        if (tematica == '' || tematica == null) {
            InvalidSelect2(labelSelect);
            $('#M'+labelSelect).show();
        }
    }
}

//Permive resaltar como invalido un select 2
function InvalidSelect2(idselect){
    $("#select2-"+idselect+"-container").parent().css("border", "1px solid #dc3545");
}

//Permive resaltar como valido un select 2
function ValidSelect2(idselect){
    $("#select2-"+idselect+"-container").parent().css("border", "1px solid #aaa");
}

//Permite eliminar los estilos de campo requerido
function LimpiarRequeridoSelect2(elemento){
    if (elemento.value != '') {
        $('#M'+elemento.id).hide();
        ValidSelect2(elemento.id);
    } else{
        $('#M'+elemento.id).show();
        InvalidSelect2(elemento.id);
    }
}

//Permite eliminar los estilos de campo requerido
function LimpiarRequerido(elemento){
    if (elemento.value != '') {
        $('#M'+elemento.id).hide();
        $('#'+elemento.id).removeClass('is-invalid')
    } else{
        $('#M'+elemento.id).show();
        $('#'+elemento.id).addClass('is-invalid')
    }
}

//Habilita el formulario de captura o no dependiendo de la respuesta
function AlFormulario(){
    $('#paginaUno').hide();
    $('#pasos').show();
    OcultarModal('modalListaArchivos');
}

//Habilita los campos del formulario dependiendo si es el afectado o no
function EsElAfectado(respuesta){
    $('#esAfectado').val(respuesta);
    HaDeBotonAccionPaso(1, 'Siguiente');
    //Consulta las opciones del select Tipo de documento
    if (respuesta == '0') {
        $('#SiEsElAfectado').addClass('btn-primary');
        $('#SiEsElAfectado').removeClass('btn-light');
        $('#NoEsElAfectado').removeClass('btn-primary');
        $('#NoEsElAfectado').addClass('btn-light');
    } else {
        $('#NoEsElAfectado').addClass('btn-primary');
        $('#NoEsElAfectado').removeClass('btn-light');
        $('#SiEsElAfectado').removeClass('btn-primary');
        $('#SiEsElAfectado').addClass('btn-light');
    }
}



var CaracteristicasRequeridas = [];
//Opciones de accion Siguiente / Anterior del wizard de los pasos del formulario ciudadano
function AccionBotonPasos(tipo){
    $('#datosolicitante').hide();
    $('#datosPeticionario').hide();
    $('#datosAfectado').hide();
    $('#hechosPretensiones').hide();
    $('#adjuntos').hide();
    var pasoActual = $('#pasoActual').val();
    //Identifica si la accion es aterior (0) o siguiente (1) y dependiendo del paso actual le muestra los campos correspondientes
    if (tipo == 0) {
        DesactivarPaso(pasoActual);
        var des = pasoActual -1;
        $('#pasoActual').val(des);
        //Del paso 2 al paso 1
        if (pasoActual == 2) {
            HaDeBotonAccionPaso(0, 'Anterior');
            $('#tutuloPasos').html('Paso #1: DATOS DEL SOLICITANTE');
            $('#datosolicitante').show();
        }
        //Del paso 3 al paso 2
        if (pasoActual == 3) {
            $('#tutuloPasos').html('Paso #2: Datos personales');
            if ($('#esAfectado').val() == 'Si') {
                $('#datosAfectado').show();
            }
            if ($('#esAfectado').val() == 'No') {
                $('#datosPeticionario').show();
            }
        }
        //Del paso 4 al paso 3
        if (pasoActual == 4) {
            $('#btnSiguientePasos').html('Siguiente');
            $('#tutuloPasos').html('Paso #3: Datos personales');
            if ($('#esAfectado').val() == 'Si') {
                $('#tutuloPasos').html('Paso #3: Sucesos y solicitudes');
                $('#hechosPretensiones').show();
            }
            if ($('#esAfectado').val() == 'No') {
                $('#tutuloPasos').html('Paso #3: Datos personales del afectado');
                $('#datosAfectado').show();
            }
        }
    } else {
        //Del paso 1 al paso 2
        if (pasoActual == 1) {
            HaDeBotonAccionPaso(1, 'Anterior');
            $('#tutuloPasos').html('Paso #2: Datos personales');
            $('#pasoActual').val(2);
            ActivarPaso(2);
            if ($('#esAfectado').val() == 'Si') {
                $('#datosAfectado').show();
            }
            if ($('#esAfectado').val() == 'No') {
                $('#datosPeticionario').show();
            }
        }
        //Del paso 2 al paso 3
        if (pasoActual == 2) {
            if ($('#esAfectado').val() == 'Si') {
                $('#datosAfectado').show();
                if ($('#tipoDocumentoA').val() == 'CC') {
                    var campos = ['tipoDocumentoA', 'fechaExpA', 'numeroDocumentoA', 'nombresA', 'apellidosA', 'direccionA', 'telefono1A', 'emailA'];
                } else {
                    var campos = ['tipoDocumentoA', 'numeroDocumentoA', 'nombresA', 'apellidosA', 'direccionA', 'telefono1A', 'emailA'];
                }
                var validos = ValidarCamposDiligenciados(campos);
                ValidarEmail('emailA');
                if ($('#tipoDocumentoA').val() == 'CC' && validos) {
                    if ($('#validoRegistraduriaA').val()=='No') {
                        validos = false;
                        alert("La identificación ingresada por usted fue validada en la Registraduría Nacional del Estado Civil y se encontraron inconsistencias, por favor verifíquela e intente nuevamente el registro.");
                    }
                    if ($('#validoRegistraduriaA').val()=='Er') {
                        validos = false;
                        alert("En el momento no es posible validar la información de la cédula, por favor inténtelo de nuevo más tarde");
                    }
                }
                var grupoVulnerable = "";
                $("[name='grupoVulnerable[]']:checked").each(function(){
                    grupoVulnerable += $(this).val();
                });
                if (grupoVulnerable=="") {
                    validos=false;
                    $('#MgrupoVulnerable').show();
                } else {
                    $('#MgrupoVulnerable').hide();
                }
                if (validos) {
                    if (ValidarEmail('emailA')) {
                        $('#tutuloPasos').html('Paso #3: Sucesos y solicitudes');
                        $('#pasoActual').val(3);
                        ActivarPaso(3);
                        $('#datosAfectado').hide();
                        $('#hechosPretensiones').show();
                    } else{
                        $('#MemailA').show();
                        $('#DemailA').addClass('has-error');
                    }
                }
            }
            if ($('#esAfectado').val() == 'No') {
                $('#datosPeticionario').show();
                if ($('#tipoDocumentoP').val() == 'CC') {
                    var campos = ['tipoDocumentoP', 'fechaExpP', 'numeroDocumentoP', 'nombresP', 'apellidosP', 'telefonoP', 'emailP'];
                } else {
                    var campos = ['tipoDocumentoP', 'numeroDocumentoP', 'nombresP', 'apellidosP', 'telefonoP', 'emailP'];
                }
                var validos = ValidarCamposDiligenciados(campos);
                ValidarEmail('emailP');
                if ($('#tipoDocumentoP').val() == 'CC' && validos) {
                    if ($('#validoRegistraduriaP').val()=='No') {
                        validos = false;
                        alert("La identificación ingresada por usted fue validada en la Registraduría Nacional del Estado Civil y se encontraron inconsistencias, por favor verifíquela e intente nuevamente el registro.");
                    }
                    if ($('#validoRegistraduriaP').val()=='Er') {
                        validos = false;
                        alert("En el momento no es posible validar la información de la cédula, por favor inténtelo de nuevo más tarde");
                    }
                }
                if (validos) {
                    if (ValidarEmail('emailP')) {
                        $('#tutuloPasos').html('Paso #3: Datos personales del afectado');
                        $('#pasoActual').val(3);
                        ActivarPaso(3);
                        $('#datosPeticionario').hide();
                        $('#datosAfectado').show();
                    } else{
                        $('#MemailP').show();
                        $('#DemailP').addClass('has-error');
                    }
                }
            }
        }
        //Del paso 3 al paso 4
        if (pasoActual == 3) {
            if ($('#esAfectado').val() == 'Si') {
                $('#hechosPretensiones').show();
                const campos = [];
                if (blobH1 === null) {
                    campos.push('hechos');
                }
                if (blobP1 === null) {
                    campos.push('pretensiones');
                }
                var validos = ValidarCamposDiligenciados(campos);
                if (validos) {
                    $('#btnSiguientePasos').html('Solicitar elaboración');
                    $('#tutuloPasos').html('Paso #4: Archivos adjuntos');
                    $('#pasoActual').val(4);
                    ActivarPaso(4);
                    $('#hechosPretensiones').hide();
                    $('#adjuntos').show();
                }
            }
            if ($('#esAfectado').val() == 'No') {
                $('#datosAfectado').show();
                if ($('#tipoDocumentoA').val() == 'CC') {
                    var campos = ['tipoDocumentoA', 'fechaExpA', 'numeroDocumentoA', 'nombresA', 'apellidosA', 'direccionA', 'telefono1A', 'emailA'];
                    campos=campos.concat(CaracteristicasRequeridas);
                } else {
                    var campos = ['tipoDocumentoA', 'numeroDocumentoA', 'nombresA', 'apellidosA', 'direccionA', 'telefono1A', 'emailA'];
                    campos=campos.concat(CaracteristicasRequeridas);
                }
                var validos = ValidarCamposDiligenciados(campos);
                ValidarEmail('emailA');
                if ($('#tipoDocumentoA').val() == 'CC' && validos) {
                    if ($('#validoRegistraduriaA').val()=='No') {
                        validos = false;
                        alert("Los datos de la cedula no han sido validados por la Registraduría, si no proporciona datos reales (validados por la Registraduría) no podrá continuar con el proceso.");
                    }
                    if ($('#validoRegistraduriaA').val()=='Er') {
                        validos = false;
                        alert("En el momento no es posible validar la información de la cédula, por favor inténtelo de nuevo más tarde");
                    }
                }
                var grupoVulnerable = "";
                $("[name='grupoVulnerable[]']:checked").each(function(){
                    grupoVulnerable += $(this).val();
                });
                if (grupoVulnerable=="") {
                    validos=false;
                    $('#MgrupoVulnerable').show();
                } else {
                    $('#MgrupoVulnerable').hide();
                }
                if (validos) {
                    $('#btnSiguientePasos').html('Solicitar elaboración');
                    if (ValidarEmail('emailA') != false) {
                        $('#tutuloPasos').html('Paso #4: Sucesos, solicitudes y archivos adjuntos');
                        $('#pasoActual').val(4);
                        ActivarPaso(4);
                        $('#datosAfectado').hide();
                        $('#hechosPretensiones').show();
                        $('#adjuntos').show();
                    } else{
                        $('#MemailA').show();
                        $('#DemailA').addClass('has-error');
                    }
                }
            }
        }
        //Del paso 4 a guardar
        if (pasoActual == 4) {
            if ($('#esAfectado').val() == 'Si') {
                $('#adjuntos').show();
            } else{
                $('#hechosPretensiones').show();
                $('#adjuntos').show();
            }
            const campos = [];
            if (blobH1 === null) {
                campos.push('hechos');
            }
            if (blobP1 === null) {
                campos.push('pretensiones');
            }
            var archivosRequeridos = $('#archivosRequeridos').val();
            if (archivosRequeridos != 'false') {
                var temp = archivosRequeridos.split(',');
                for (var i = 0; i < temp.length; i++) {
                    campos.push('adjunto'+temp[i]);
                }
            }
            var validos = ValidarCamposDiligenciados(campos);
            if (validos) {
                if ($('#requerimiento').val() > 1) {
                    $('#textoAccionJuramentada').html('');
                    $('#modalAccionJuramentadaLabel').html('Confirmar email');
                }
    
            }
        }
    }
}

//
function ArchivoValido(id, tipos, peso){
    var valida = true;
    var fileInput = $('#' + id);
    var maxSize = peso * 1000000;
    if(fileInput.get(0).files.length){
        var extArchivo = fileInput.get(0).files[0].name.split('.').pop().toLowerCase();
        var fileSize = fileInput.get(0).files[0].size;
        if(fileSize > maxSize){
            alert('El tamaño del archivo debe ser máximo ' + peso + 'MB.');
            $("#"+id).val('');
            valida = false;
        }
        var sp = tipos.split(';');
        var noEncontrado = true;
        var txtExt = '';
        for (let i = 0; i < sp.length; i++) {
            txtExt += ', ' + sp[i];
            if (extArchivo == sp[i]) {
                noEncontrado = false;
            }
        }
        if (noEncontrado) {
            alert('El tipo de archivo seleccionado no es correcto, por favor seleccione un archivo ' + txtExt + '.');
            $("#"+id).val('');
            valida = false;
        }
    } else{
        $("#"+id).val('');
        valida = false;
    }
    return valida;
}

//Activa el icono del paso y la barra de progreso dependiendo del paso
function ActivarPaso(paso){
    $('#btnCirculoPaso'+paso).removeClass('btn-default');
    $('#btnCirculoPaso'+paso).addClass('btn-tutelas');
    $('#progresoPaso'+paso).width('100%');
}

//Desactiva el icono del paso y la barra de progreso dependiendo del paso
function DesactivarPaso(paso){
    $('#btnCirculoPaso'+paso).removeClass('btn-tutelas');
    $('#btnCirculoPaso'+paso).addClass('btn-default');
    $('#progresoPaso'+paso).width('0%');
}

//Habilita o desabilita el boton de accion Sigiente o Anterior dependiendo del tipo y del boton btn
function HaDeBotonAccionPaso(tipo, btn){
    if (tipo == 0) {
        $('#btn'+btn+'Pasos').prop('disabled', true);
        $('#btn'+btn+'Pasos').removeClass('btn-primary');
        $('#btn'+btn+'Pasos').addClass('btn-light');
    } else{
        $('#btn'+btn+'Pasos').prop('disabled', false);
        $('#btn'+btn+'Pasos').addClass('btn-primary');
        $('#btn'+btn+'Pasos').removeClass('btn-light');
    }
}

//Revisa el tipo de documento seleccionado para habilitar el campo de fecha de expedicion del documento si es cedula de ciudadania
function CambioTipoDocumento(elemento){
    var tipo = elemento.value;
    var ultimo = elemento.id.slice(-1);
    if (tipo != '') {
        $('#M'+elemento.id).hide();
        $('#'+elemento.id).removeClass('is-invalid');
        if (tipo == 'CC') {
            $('#DDfechaExp'+ultimo).show();
        } else {
            $('#DDfechaExp'+ultimo).hide();
            $('#validoRegistraduria'+ultimo).val('');
            $('#nombres'+ultimo).prop('disabled',false);
            $('#apellidos'+ultimo).prop('disabled',false);
        }
    } else {
        $('#DD'+ultimo).hide();
        $('#M'+elemento.id).show();
        $('#D'+elemento.id).addClass('has-error');
    }
}

var ccvalidada="";
//Consulta el nombre y apellido del ciudadno dependiendo del número de cedula y la fecha de expedicion
function ConsultarRegistraduria(id){
    var ultimo = id.slice(-1);
    var documento = $('#numeroDocumento'+ultimo).val();
    var temp = $('#fechaExp'+ultimo).val();
    var fecha = temp.split('-').reverse().join('-');
    if (documento != '' && fecha != '') {
        //Consulta las opciones del select Tipo de documento
        var ccsinvalidar=documento+fecha;
        if (ccvalidada == "" || ccvalidada != ccsinvalidar) {
            $.ajax({
                url: urlAPI + "GetRegistraduria/" + documento + "/" + fecha,
                beforeSend: function () { MostrarModal('modalLoading'); },
                success: function () { OcultarModal('modalLoading'); }
            }).done(function(respuesta) {
                ccvalidada = ccsinvalidar;
                $('#nombres'+ultimo).prop('disabled',true);
                $('#apellidos'+ultimo).prop('disabled',true);
                if (respuesta.valido) {
                    $('#nombres'+ultimo).val(respuesta.nombres);
                    $('#apellidos'+ultimo).val(respuesta.apellidos);
                    $('#validoRegistraduria'+ultimo).val('Si');
                } else {
                    $('#nombres'+ultimo).prop('disabled',false);
                    $('#apellidos'+ultimo).prop('disabled',false);
                    $('#nombres'+ultimo).val("");
                    $('#apellidos'+ultimo).val("");
                    if (respuesta.nombres == "error") {
                        $('#validoRegistraduria'+ultimo).val('Er');
                        alert("En el momento no es posible validar la información de la cédula, por favor inténtelo de nuevo más tarde");
                    } else {
                        $('#validoRegistraduria'+ultimo).val('No');
                        alert("La identificación ingresada por usted fue validada en la Registraduría Nacional del Estado Civil y se encontraron inconsistencias, por favor verifíquela e intente nuevamente el registro.");
                    }
                }
            });
        }
    }
}

//Permite filtrar los caracteres de un campo para restringir los caracteres que se pueden digitar
function FiltrarCaracteres(esto, tipo, cont = false) {
    $('#M'+esto.id).hide();
    $('#'+esto.id).removeClass('is-invalid');
    var valor = esto.value;
    var out = '';
    var filtro = '';
    if (tipo == 'numeros') {
        filtro = '1234567890';
    }
    if (tipo == 'fechas') {
        filtro = '1234567890/';
    }
    if (tipo == 'email') {
        valor = valor.toLowerCase();
        filtro = "abcdefghijklmnopqrstuvwxyz1234567890@.-_~!$&()*+,;=:'";
    }
    if (tipo == 'nombres') {
        valor = valor.toUpperCase();
        filtro = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚÜ ';
    }
    if (tipo == 'textos') {
        filtro = 'abcdefghijklmnñopqrstuvwxyzáéíóúüABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚÜ-_,;./#:@1234567890 ';
    }
    for (var i = 0; i < valor.length; i++){
        if (valor.charAt(i) == "\n") {
            out += valor.charAt(i);
        }
        if (filtro.indexOf(valor.charAt(i)) != -1){
            out += valor.charAt(i);
        }
    }
    if (cont) {
        var cuenta = 4000 - out.length;
        $('#cont_' + esto.id).html('<i class="fas fa-align-left"></i> ' + cuenta);
    }
    return out;
}

//Permite validar la estructura del email email@email.com
function ValidarEmail(id) {
    var email = $('#'+id).val();
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var respuesta = re.test(String(email).toLowerCase());
    if (respuesta) {
        $('#M'+id).hide();
        $('#'+id).removeClass('is-invalid');
        if (id == 'emailA') {
            var emails = "";
            if ($('#emailP').val() != '') {
                emails = $('#emailP').val()+', '+String(email).toLowerCase();
            } else {
                emails = String(email).toLowerCase();
            }
            $('#txtConfirmarEmails').html('Correo(s) electrónicos: <br><b>'+emails+'</b><br>Si esta información no es correcta haga clic <a href="#" onclick="MostrarCorregirEmail();">aquí</a>');
        }
    } else {
        $('#M'+id).show();
        $('#'+id).addClass('is-invalid');
    }
    return respuesta;
}

function MostrarCorregirEmail(){
    $('#emailP_X').val($('#emailP').val());
    $('#emailA_X').val($('#emailA').val());
    MostrarModal('modalConfirmarEmail');
}

function ModificarEmail(){
    var emailP = true;
    if ($('#emailP_X').val() != '') {
        emailP = ValidarEmail('emailP_X');
    }
    if (ValidarEmail('emailA_X') && emailP) {
        $('#emailP').val($('#emailP_X').val());
        $('#emailA').val($('#emailA_X').val());
        var emails = "";
        if ($('#emailP').val() != '') {
            emails = $('#emailP').val()+', '+$('#emailA').val();
        } else {
            emails = $('#emailA').val();
        }
        $('#txtConfirmarEmails').html('Correo(s) electrónicos: <br><b>'+emails+'</b>.<br>Si esta información no es correcta haga clic <a href="#" onclick="MostrarCorregirEmail();">aquí</a>');
        OcultarModal('modalConfirmarEmail');
    }
}

//Permite seleccionar los iconos de caracteristicas de vulnerabilidad como un checkbox de acuerdo a las condiciones del formuario de referencia (requerimiento ciudadano SINPROC)
function AgregarCaracteristica(tipo){
    $('#MgrupoVulnerable').hide();
    if ($('#cara'+tipo).is(':checked')) {
        $('#cara'+tipo).prop('checked',false);
        $('#btnCara'+tipo).attr('src','/img/img'+tipo+'a.png');
        $('#DDcara'+tipo).hide();
        if (tipo == 4) {
            var i = CaracteristicasRequeridas.indexOf("tipoDiscapacidad");
            CaracteristicasRequeridas.splice(i, 1);
        }
        if (tipo == 6) {
            var i = CaracteristicasRequeridas.indexOf("grupoEtnico");
            CaracteristicasRequeridas.splice(i, 1);
        }
        if (tipo == 9) {
            var i = CaracteristicasRequeridas.indexOf("enfermedad");
            CaracteristicasRequeridas.splice(i, 1);
        }
    } else {
        $('#cara'+tipo).prop('checked',true);
        $('#btnCara'+tipo).attr('src','/img/img'+tipo+'b.png');
        $('#DDcara'+tipo).show();
        if (tipo == 4) {
            CaracteristicasRequeridas.push("tipoDiscapacidad");
        }
        if (tipo == 6) {
            CaracteristicasRequeridas.push("grupoEtnico");
        }
        if (tipo == 9) {
            CaracteristicasRequeridas.push("enfermedad");
        }
    }
    var quitar = [];
    if (tipo == 1) { quitar = [3,7,8,10]; }
    if (tipo == 2) { quitar = [10]; }
    if (tipo == 3) { quitar = [1,2,7,8,10]; }
    if (tipo == 4) { quitar = [10]; }
    if (tipo == 5) { quitar = [10]; }
    if (tipo == 6) { quitar = [10]; }
    if (tipo == 7) { quitar = [1,2,3,10]; }
    if (tipo == 8) { quitar = [1,2,3,10]; }
    if (tipo == 9) { quitar = [10]; }
    if (tipo == 10) {
        quitar = [1,2,3,4,5,6,7,8,9];
        $('#DDcara4').hide();
        $('#DDcara6').hide();
        $('#DDcara9').hide();
        $('#tipoDiscapacidad').val('');
        $('#grupoEtnico').val('');
        $('#enfermedad').val('');
    }
    for (var i = 0; i < quitar.length; i++) {
        $('#cara'+quitar[i]).prop('checked',false);
        $('#btnCara'+quitar[i]).attr('src','/img/img'+quitar[i]+'a.png');
    }
}

//Verifica cada uno de los elementos del array campos y evalua si fue diligenciado o no
function ValidarCamposDiligenciados(campos){
    var retorno = true;
    for (var i = 0; i < campos.length; i++) {
        var archivo = false;
        if (campos[i].substring(0, 7) == 'adjunto') {
            archivo = true;
        }
        if ($('#'+campos[i]).val() == '') {
            retorno = false;
            if (archivo) {
                var exampleEl = document.getElementById('btn-'+campos[i]);
                var popover = new bootstrap.Popover(exampleEl, {trigger: 'focus'});
                popover.show();
            } else{
                $('#M'+campos[i]).show();
                $('#'+campos[i]).addClass('is-invalid');
            }
        } else{
            if (archivo) {
                var exampleTriggerEl = document.getElementById('btn-'+campos[i]);
                var popover = bootstrap.Popover.getOrCreateInstance(exampleTriggerEl);
                popover.hide();
            } else {
                $('#M'+campos[i]).hide();
                $('#'+campos[i]).removeClass('is-invalid');
            }
        }
    }
    return retorno;
}

//Muestra el modal de ayuda de diligenciamiento de hechos o pretensiones dependiendo del tipo (esto con el fin de evitar conflictos con data-toggle="tooltip" para el modal)
function MostrarAyudaHechosP(tipo){
    MostrarModal('modalAyuda'+tipo);
}

//Definicion de variables utilizadas por el sistema de grabacion de relatos
let blobH1 = null; blobH2 = null; blobH3 = null;
let blobP1 = null; blobP2 = null; blobP3 = null;
let s = 0, m = 0, intervalo = 0;

//Inicia el componente de grabacion empleando MediaStream Recording API
function IniciarGrabacion(tipo){
    MostrarModal('modalLoading');
    $('#modalAyuda'+tipo).css('z-index', 2);
    //Evalua si el navegador esta soportado y solicita permisos para acceder al microfono
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({audio: true}).then(function(stream) {
            const mediaRecorder = new MediaRecorder(stream);
            $('#controlGrabacion'+tipo).show();
            OcultarModal('modalLoading');
            $('#modalAyuda'+tipo).css('z-index', '');
            //Inicia la captura del stream de audio del microfono
            $('#record'+tipo).on('click', function() {
                s = 0; m = 0; intervalo = 0;
                var audios = parseInt($('#cuantosAudios'+tipo).val(), 10);
                audios++;
                $('#cuantosAudios'+tipo).val(audios);
                mediaRecorder.start();
                //Genera el cronometro de tiempo de grabacion (5 minutos maximo luego corta la grabacion)
                intervalo = setInterval(function () {
                    var mAux, sAux;
                    s++;
                    if (s>59){m++;s=0;}
                    if (s<10){sAux='0'+s;}else{sAux=s;}
                    if (m<10){mAux='0'+m;}else{mAux=m;}
                    $('#cronometro'+tipo).show();
                    $('#tiempo'+tipo).html(mAux + ':' + sAux);
                    if (m==5) {
                        $('#stop'+tipo).click();
                    }
                }, 1000);
            });
            //Almacena el stream a medida que se va capturando el microfono
            let chunks = [];
            mediaRecorder.ondataavailable = function(e) {
                chunks.push(e.data);
            }
            //Detiene la grabacion solo se pueden capturar 3 audios y deshabilita los botones de captura
            $('#stop'+tipo).on('click', function() {
                mediaRecorder.stop();
                s=0;
                $('#cronometro'+tipo).hide();
                $('#tiempo'+tipo).html('');
                clearInterval(intervalo);
                var audios = parseInt($('#cuantosAudios'+tipo).val(), 10);
                if (audios == 3) {
                    $('#record'+tipo).prop('disabled', true);
                    $('#stop'+tipo).prop('disabled', true);
                }
                if (tipo == 'H') {
                	if ($('#hechos').val() == '') {
                		$('#hechos').val('Agregado mediante grabación.');
                	}
                } else {
                	if ($('#pretensiones').val() == '') {
                		$('#pretensiones').val('Agregado mediante grabación.');
                	}
                }
            });
            //En el momento que se detiene la grabacion se guarda el steam en una variable (blob), se carga y visualiza el reproductor del audio capturado
            mediaRecorder.onstop = function(e) {
                var audios = $('#cuantosAudios'+tipo).val();
                const audio = document.getElementById('grabacion'+tipo+audios);
                const blob = new Blob(chunks, { 'type' : 'audio/ogg; codecs=opus' });
                if (tipo=='H') {
                    if (audios==1) {blobH1 = blob}
                    if (audios==2) {blobH2 = blob}
                    if (audios==3) {blobH3 = blob}
                }
                if (tipo=='P') {
                    if (audios==1) {blobP1 = blob}
                    if (audios==2) {blobP2 = blob}
                    if (audios==3) {blobP3 = blob}
                }
                chunks = [];
                const audioURL = window.URL.createObjectURL(blob);
                audio.src = audioURL;
                $('#audio'+tipo+audios).show();
                var des = parseInt(audios,10) - 1;
                $('#btnEliminar'+tipo+des).prop('disabled', true);
            }

        }).catch(function(err) {
            OcultarModal('modalLoading');
            $('#modalAyudaH').css("z-index", "1060");
        }
       );
    } else {
        OcultarModal('modalLoading');
       $('#modalAyuda'+tipo).css('z-index', '');
    }
}

//Eliminala grabacion (audio), debido a que es una grabacion en secuencia solo se puede eliminar una a la vez (la ultima de la lista)
function EliminarGrabacion(audio){
    var sp = audio.split('-');
    $('#grabacion'+sp[0]+sp[1]).attr('src','');
    $('#audio'+sp[0]+sp[1]).hide();
    if (sp[0]=='H') {
        if (sp[1]==1) {blobH1 = null}
        if (sp[1]==2) {blobH2 = null}
        if (sp[1]==3) {blobH3 = null}
    }
    if (sp[0]=='P') {
        if (sp[1]==1) {blobP1 = null}
        if (sp[1]==2) {blobP2 = null}
        if (sp[1]==3) {blobP3 = null}
    }
    $('#record'+sp[0]).prop('disabled', false);
    $('#stop'+sp[0]).prop('disabled', false);
    var audios = parseInt($('#cuantosAudios'+sp[0]).val(),10);
    var actual = audios-1;
    $('#cuantosAudios'+sp[0]).val(actual);
    $('#btnEliminar'+sp[0]+actual).prop('disabled', false);
}

//Valida el archivo seleccionado
function ArchivoSeleccionado(id){
    ArchivoValido('adjunto'+id, 'pdf;jpg;png;zip', 2);
    if ($('#adjunto'+id).val() != '') {
        $('#checkAdjunto'+id).show();
        var exampleTriggerEl = document.getElementById('btn-adjunto'+id);
        var popover = bootstrap.Popover.getOrCreateInstance(exampleTriggerEl);
        popover.hide();
    } else{
        $('#checkAdjunto'+id).hide();
    }
}

function matchCustom(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
      return data;
    }

    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
      return null;
    }

    // `params.term` should be the term that is used for searching
    // `data.text` is the text that is displayed for the data object
    if (data.text.indexOf(params.term) > -1) {
      var modifiedData = $.extend({}, data, true);
      modifiedData.text += ' (matched)';

      // You can return modified objects from here
      // This includes matching the `children` how you want in nested data sets
      return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
}

//**************************************************************************
function GuardarSolicitud(){
    $('#btnGuardarSolicitud').prop('disabled', true);
    OcultarModal('modalAccionJuramentada');
    MostrarModal('modalLoading');
    var data = new FormData();
    //Agrega los campos
    var campos = [
        'tipoSolicitud',
        'esAfectado',
        'tipoDocumentoP',
        'numeroDocumentoP',
        'fechaExpP',
        'validoRegistraduriaP',
        'nombresP',
        'apellidosP',
        'telefonoP',
        'emailP',
        'tipoDocumentoA',
        'numeroDocumentoA',
        'fechaExpA',
        'validoRegistraduriaA',
        'nombresA',
        'apellidosA',
        'direccionA',
        'telefono1A',
        'telefono2A',
        'emailA',
        'localidadA',
		'sexoA',
		'identidadGeneroA',
		'orientacionA',
        'hechos',
        'pretensiones',
        'tipoDiscapacidad',
        'grupoEtnico',
        'enfermedad',
        'requerimiento',
    ];
    for (var i = 0; i < campos.length; i++) {
        if (campos[i]=="direccionA" || campos[i]=="hechos" || campos[i]=="pretensiones") {
            data.append(campos[i].toLowerCase(), Base64.encode($('#'+campos[i]).val()));
        } else {
            data.append(campos[i].toLowerCase(), $('#'+campos[i]).val());
        }
    }
    var tipoSolicitud = $('#tipoSolicitud').val().replace("Impugnación", "Impugnacion");
    data.append('tematicasolicitud', $('#tematica'+tipoSolicitud).val());
    //Agrega los chack seleccionado de opciones de vulnerabilidad
    var grupoVulnerable = '';
    $("[name='grupoVulnerable[]']:checked").each(function(){
        grupoVulnerable += $(this).val()+',';
    });
    data.append('grupovulnerable', grupoVulnerable);
    //Agrega los archivos adjuntos
    var archivosTodos = $('#archivosTodos').val().split(',');
    if (archivosTodos[0] != 'false') {
        for (var i = 0; i < archivosTodos.length; i++) {
            var archivo = document.getElementById('adjunto'+archivosTodos[i]);
            if (archivo.files[0]) {
                data.append('adjunto'+archivosTodos[i], archivo.files[0]);
            }
        }
    }
    //Agrega las grabaciones de audio

    data.append('blobh1', blobH1);
    data.append('blobh2', blobH2);
    data.append('blobh3', blobH3);
    data.append('blobp1', blobP1);
    data.append('blobp2', blobP2);
    data.append('blobp3', blobP3);
    //Datos de Usuario SINPROC
    data.append('autoasignacion', 0);
    data.append('cedula', 0);
    var oReq = new XMLHttpRequest();
    oReq.open("POST", "api/GuardarSolicitud");
    oReq.send(data);
    oReq.onload = function() {
        OcultarModal('modalLoading');
        var obj = JSON.parse(oReq.response);
        $('#textoRadicacionSolicitud').html(obj.textoRadicacionSolicitud);
        MostrarModal('modalRadicacionSolicitud');
    };
}

function ConfirmarCierre(modal, mensaje){
    var r = confirm(mensaje);
    if (r == true) {
        OcultarModal(modal);
    }
}

function CargarNivelTematica(tag, select){
    var para = '2;'+select;
    $.ajax({
        url: urlAPI+"GetNivelXTematica/"+para,
        beforeSend: function () {MostrarModal('modalLoading');},
        success: function () {OcultarModal('modalLoading');}
    }).done(function(respuesta) {
        $('#'+tag).html(respuesta);
        $('#'+tag).select2({width:'100%', dropdownParent: "#D"+tag});
    });
}
