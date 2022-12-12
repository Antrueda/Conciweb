<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Personería de Bogotá - Tutelas en línea</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include JQuery 3.6 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include Font-Awesome 5.14 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <!-- Include custome CSS -->
    <link rel="stylesheet" href="/css/ciudadano_form.css">
    <!-- Include Select2 CSS/JS -->
    <link href="/plugs/select2/css/select2.min.css" rel="stylesheet">
    <script src="/plugs/select2/js/select2.min.js"></script>
    <script src="/plugs/select2/js/i18n/es.js"></script>
  </head>
  <body>
    <!-- Header -->
    <div class="container-fluid header">
        <div class="row">
            <div class="col-sm-2">
                <a href="https://www.personeriabogota.gov.co/" data-toggle="tooltip" data-placement="bottom" title="Regresar al portal" style="text-decoration: none;">
                    <img src="/img/logo5.png" alt="Logo Personería de Bogotá" class="logo">
                </a>
            </div>
            <div class="col-sm-5">
            </div>
            <div class="col-sm-5 text-end align-middle">
                <a href="https://www.personeriabogota.gov.co/" data-toggle="tooltip" data-placement="bottom" title="Regresar al portal" class="regreso-portal">
                    Regresar al portal
                </a>
            </div>
        </div>
        <img src="/img/menu-after-05.png" alt="Colores bandera Bogotá" class="bandera">
    </div>

    <!-- Body -->
    <div class="container">
        <input type="hidden" id="csrf">
        <!-- Pagina de bienvenida -->
        <div class="row" id="paginaUno">
            <div class="col-sm-12">
            <h2>¡Bienvenido al sistema de elaboración de tutelas, desacato e impugnación en línea!</h2>
            </div>
            <div class="col-sm-12" id="textoBienvenida"></div>
            <div class="col-sm-12 btn-datosp" id="botonDatosPerdonales">
                <button type="button" class="btn btn-primary" onclick="DatosPersonales();">
                    Solicitud de autorización para el tratamiento de datos personales.
                </button>
            </div>
        </div>
        <!-- Wizard con los pasos del formulario -->
        <div id="pasos" style="display: none;">

            <!-- Numeracion de los pasos -->
            <div class="row" style="margin-top: 25px; padding: 0px 15px;">
                <div class="col-3 text-left" style="padding: 0px;">
                    <a type="button" class="btn btn-tutelas btn-circleT">1</a>
                    <div class="progress" style="height: 10px; margin: 0px;">
                      <div class="progress-bar bg-tutelas" style="width:100%">
                      </div>
                    </div>
                </div>
                <div class="col-3 text-left" style="padding: 0px;">
                    <a type="button" class="btn btn-default btn-circleT" id="btnCirculoPaso2">2</a>
                    <div class="progress" style="height: 10px; margin: 0px;">
                      <div class="progress-bar bg-tutelas" id="progresoPaso2" style="width:0%">
                      </div>
                    </div>
                </div>
                <div class="col-3 text-left" style="padding: 0px;">
                    <a type="button" class="btn btn-default btn-circleT" id="btnCirculoPaso3">3</a>
                    <div class="progress" style="height: 10px; margin: 0px;">
                      <div class="progress-bar bg-tutelas" id="progresoPaso3" style="width:0%">
                      </div>
                    </div>
                </div>
                <div class="col-3 text-left" style="padding: 0px;">
                    <a type="button" class="btn btn-default btn-circleT" id="btnCirculoPaso4">4</a>
                    <div class="progress" style="height: 10px; margin: 0px;">
                      <div class="progress-bar bg-tutelas" id="progresoPaso4" style="width:0%">
                      </div>
                    </div>
                </div>
            </div>

            <!-- Contenido (campos) de los pasos -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card" style="margin-bottom: 40px;">
                        <input type="hidden" id="pasoActual" value="1">
                        <div class="card-header" id="tutuloPasos" style="font-weight: bold;">
                            Paso #1: ¿Es usted el afectado?
                        </div>
                        <div class="card-body" style="margin-bottom: 15px;">


                            <!-- Pregunta a nombre propio -->
                            <div class="row" id="preguntaNP">
                                <div class="col-sm-12">
                                    <label>¿Es usted el afectado?</label><br><br>
                                    <button type="button" class="btn btn-light" onclick="EsElAfectado('Si');" id="SiEsElAfectado" style="margin-top: 15px;">Si</button>
                                    &nbsp;&nbsp;
                                    <button type="button" class="btn btn-light" onclick="EsElAfectado('No');" id="NoEsElAfectado" style="margin-top: 15px;">No</button>
                                    <input type="hidden" id="esAfectado" value="">
                                </div>
                            </div>

                            <!-- Datos peticionario -->
                            <div class="row" id="datosPeticionario" style="margin-top: 10px; display: none;">
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="tipoDocumentoP">Tipo documento de quien diligencia</label>
                                    <select class="form-control" id="tipoDocumentoP" onchange="CambioTipoDocumento(this);">
                                    </select>
                                    <div id="MtipoDocumentoP" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="numeroDocumentoP">Número de documento de quien diligencia</label>
                                    <input type="text" class="form-control" placeholder="Número de documento" id="numeroDocumentoP" maxlength="12" onblur="ConsultarRegistraduria(this.id);" onkeyup="this.value = FiltrarCaracteres(this, 'numeros');">
                                    <input id="validoRegistraduriaP" type="hidden" value="">
                                    <div id="MnumeroDocumentoP" class="msgerr">El dato es requerido</div>
                                </div>
                                <div id="DDfechaExpP" class="col-sm-6" style="display: none;">
                                    <label class="form-label requerido" for="fechaExpP">Fecha de expedición del documento de quien diligencia</label>
                                    <input class="form-control" type="date" min='1900-01-01' max="2022-12-01" id="fechaExpP" onblur="ConsultarRegistraduria(this.id);" onchange="LimpiarRequerido(this);">
                                    <div id="MfechaExpP" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="nombresP">Nombres de quien diligencia</label>
                                    <input type="text" class="form-control" placeholder="Nombres" id="nombresP" maxlength="150" onkeyup="this.value = FiltrarCaracteres(this, 'nombres');">
                                    <div id="MnombresP" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="apellidosP">Apellidos de quien diligencia</label>
                                    <input type="text" class="form-control" placeholder="Apellidos" id="apellidosP" maxlength="150" onkeyup="this.value = FiltrarCaracteres(this, 'nombres');">
                                    <div id="MapellidosP" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="telefonoP">Teléfono/Celular de quien diligencia</label>
                                    <input type="text" class="form-control" placeholder="Teléfono/Celular" id="telefonoP" maxlength="12" onkeyup="this.value = FiltrarCaracteres(this, 'numeros');">
                                    <div id="MtelefonoP" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="emailP">Correo electrónico de quien diligencia</label>
                                    <input type="text" class="form-control" placeholder="Correo electrónico" id="emailP" maxlength="150" onkeyup="this.value = FiltrarCaracteres(this, 'email');" onblur="ValidarEmail(this.id);">
                                    <div id="MemailP" class="msgerr">El correo no es valido</div>
                                </div>
                            </div>

                            <!-- Datos del afectado -->
                            <div class="row" id="datosAfectado" style="margin-top: 10px; display: none;">
                                <div class="col-sm-12">
                                    <label>¿El posible afectado tiene alguna(s) de las siguientes características?</label>
                                </div>
                                <div class="col-sm-12" style="margin-top: 15px;">
                                    <img id="btnCara1" src="/img/img1a.png" style="cursor: pointer;" onclick="AgregarCaracteristica(1);" data-toggle="tooltip" title="Niños Y Niñas (Menores de 14 años)">
                                    <input type="checkbox" name="grupoVulnerable[]" id="cara1" style="display: none;" value="1">
                                    <img id="btnCara2" src="/img/img2a.png" style="cursor: pointer;" onclick="AgregarCaracteristica(2);" data-toggle="tooltip" title="Mujer Embarazada">
                                    <input type="checkbox" name="grupoVulnerable[]" id="cara2" style="display: none;" value="2">
                                    <img id="btnCara3" src="/img/img3a.png" style="cursor: pointer;" onclick="AgregarCaracteristica(3);" data-toggle="tooltip" title="Adulto Mayor: mayores de 60 años (ley 1251 de 2008)">
                                    <input type="checkbox" name="grupoVulnerable[]" id="cara3" style="display: none;" value="3">
                                    <img id="btnCara4" src="/img/img4a.png" style="cursor: pointer;" onclick="AgregarCaracteristica(4);" data-toggle="tooltip" title="Persona en Condición de Discapacidad">
                                    <input type="checkbox" name="grupoVulnerable[]" id="cara4" style="display: none;" value="4">
                                    <img id="btnCara5" src="/img/img5a.png" style="cursor: pointer;" onclick="AgregarCaracteristica(5);" data-toggle="tooltip" title="Víctima Conflicto Armado">
                                    <input type="checkbox" name="grupoVulnerable[]" id="cara5" style="display: none;" value="5">
                                    <img id="btnCara6" src="/img/img6a.png" style="cursor: pointer;" onclick="AgregarCaracteristica(6);" data-toggle="tooltip" title="Grupo Étnico">
                                    <input type="checkbox" name="grupoVulnerable[]" id="cara6" style="display: none;" value="6">
                                    <img id="btnCara7" src="/img/img7a.png" style="cursor: pointer;" onclick="AgregarCaracteristica(7);" data-toggle="tooltip" title="<strong>Persona con Poca Instrucción:</strong> ciudadano que no sabe leer o escribir.">
                                    <input type="checkbox" name="grupoVulnerable[]" id="cara7" style="display: none;" value="7">
                                    <img id="btnCara8" src="/img/img8a.png" style="cursor: pointer;" onclick="AgregarCaracteristica(8);" data-toggle="tooltip" title="<strong>Persona Desposeída:</strong> ciudadano que aparentemente no está en capacidad de asumir los costos de la gestión de su actuación ante las autoridades.">
                                    <input type="checkbox" name="grupoVulnerable[]" id="cara8" style="display: none;" value="8">
                                    <img id="btnCara9" src="/img/img9a.png" style="cursor: pointer;" onclick="AgregarCaracteristica(9);" data-toggle="tooltip" title="Enfermedad Castastrófica">
                                    <input type="checkbox" name="grupoVulnerable[]" id="cara9" style="display: none;" value="9">
                                    <img id="btnCara10" src="/img/img10a.png" style="cursor: pointer;" onclick="AgregarCaracteristica(10);" data-toggle="tooltip" title="<strong>Ninguno:</strong> Cuando el afectado no cumple con ninguna de las características anteriores.">
                                    <input type="checkbox" name="grupoVulnerable[]" id="cara10" style="display: none;" value="10">
                                    <div id="MgrupoVulnerable" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6" id="DDcara4" style="display: none;">
                                    <label class="form-label requerido" for="tipoDiscapacidad">Tipo discapacidad</label>
                                    <select class="form-control" id="tipoDiscapacidad" onchange="LimpiarRequerido(this);">
                                    </select>
                                    <div id="MtipoDiscapacidad" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6" id="DDcara6" style="display: none;">
                                    <label class="form-label requerido" for="grupoEtnico">Grupo etnico</label>
                                    <select class="form-control" id="grupoEtnico" onchange="LimpiarRequerido(this);">
                                        <option value>-Seleccione Dato-</option>
                                        <option value="0" title="Incluyen: Afrodescendientes, Negros, Mulatos, Palenqueros">AFROCOLOMBIANOS</option>
                                        <option value="2">INDÍGENAS</option>
                                        <option value="1">ROM O GITANO</option>
                                        <option value="4" title="Del archipiélago de San Andrés y Providencia">RAIZALES Y PALENQUEROS</option>
                                    </select>
                                    <div id="MgrupoEtnico" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6" id="DDcara9" style="display: none;">
                                    <label class="form-label requerido">Enfermedad</label>
                                    <select class="form-control" id="enfermedad" onchange="LimpiarRequerido(this);">
                                    </select>
                                    <div id="Menfermedad" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="tipoDocumentoA">Tipo documento del afectado</label>
                                    <select class="form-control" id="tipoDocumentoA" onchange="CambioTipoDocumento(this);">
                                    </select>
                                    <div id="MtipoDocumentoA" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="numeroDocumentoA">Número de documento del afectado</label>
                                    <input type="text" class="form-control" placeholder="Número de documento" id="numeroDocumentoA" maxlength="12" onblur="ConsultarRegistraduria(this.id);" onkeyup="this.value = FiltrarCaracteres(this, 'numeros');">
                                    <input id="validoRegistraduriaA" type="hidden" value="">
                                    <div id="MnumeroDocumentoA" class="msgerr">El dato es requerido</div>
                                </div>
                                <div id="DDfechaExpA" class="col-sm-6" style="display: none;">
                                    <label for="fechaExpA" class="form-label">Fecha de expedición del documento del afectado</label>
                                    <input class="form-control" type="date" min='1900-01-01' max="2022-12-01" id="fechaExpA" onblur="ConsultarRegistraduria(this.id);" onchange="LimpiarRequerido(this);">
                                    <div id="MfechaExpA" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="nombresA">Nombres del afectado</label>
                                    <input type="text" class="form-control" placeholder="Nombres" id="nombresA" maxlength="150" onkeyup="this.value = FiltrarCaracteres(this, 'nombres');">
                                    <div id="MnombresA" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="apellidosA">Apellidos del afectado</label>
                                    <input type="text" class="form-control" placeholder="Apellidos" id="apellidosA" maxlength="150" onkeyup="this.value = FiltrarCaracteres(this, 'nombres');">
                                    <div id="MapellidosA" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="direccionA">Dirección para notificación del afectado</label>
                                    <input type="text" class="form-control" placeholder="Dirección para notificación" id="direccionA" maxlength="150" onkeyup="this.value = FiltrarCaracteres(this, 'textos');">
                                    <div id="MdireccionA" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label requerido" for="telefono1A">Teléfono/Celular 1 del afectado</label>
                                    <input type="text" class="form-control" placeholder="Teléfono/Celular" id="telefono1A" maxlength="12" onkeyup="this.value = FiltrarCaracteres(this, 'numeros');">
                                    <div id="Mtelefono1A" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="telefono2A">Teléfono/Celular 2 del afectado</label>
                                    <input type="text" class="form-control" placeholder="Teléfono/Celular" id="telefono2A" maxlength="12" onkeyup="this.value = FiltrarCaracteres(this, 'numeros');">
                                    <div id="Mtelefono2A" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="emailA" class="form-label requerido">Correo electrónico del afectado</label>
                                    <input type="text" class="form-control" placeholder="Correo electrónico" id="emailA" maxlength="150" onkeyup="this.value = FiltrarCaracteres(this, 'email');" onblur="ValidarEmail(this.id);">
                                    <div id="MemailA" class="msgerr">El correo no es valido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="localidadA">Localidad del afectado</label>
                                    <select class="form-control" id="localidadA">
                                    </select>
                                    <div id="MlocalidadA" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="sexoA">Sexo del afectado</label>
                                    <select class="form-control" id="sexoA">
                                    </select>
                                    <div id="MsexoA" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="identidadGeneroA">Identidad de género del afectado</label>
                                    <select class="form-control" id="identidadGeneroA">
                                    </select>
                                    <div id="MidentidadGeneroA" class="msgerr">El dato es requerido</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="orientacionA">Orientación sexual del afectado</label>
                                    <select class="form-control" id="orientacionA">
                                    </select>
                                    <div id="MorientacionA" class="msgerr">El dato es requerido</div>
                                </div>
                            </div>

                            <!-- Hechos y pretensiones -->
                            <div class="row" id="hechosPretensiones" style="margin-top: 10px; display: none;">
                                <div class="col-sm-12">
                                    <label class="form-label requerido" for="hechos" style="margin-top: -5px;">
                                        Relate lo sucedido (Hechos)
                                        <i class="fas fa-question-circle" data-toggle="tooltip" title="Ayuda" onclick="MostrarAyudaHechosP('H');" style="cursor: pointer; color: #17a2b8; font-size: 20px;"></i>
                                    </label>
                                    <textarea class="form-control" id="hechos" rows="5" maxlength="4000" onkeyup="this.value = FiltrarCaracteres(this, 'textos', true);" onblur="$('#hechos').val(FiltrarCaracteres(this, 'textos', true));"></textarea>
                                    <div id="Mhechos" class="msgerr">El dato es requerido</div>
                                    <div id="cont_hechos" style="font-size: 11px; padding-top: 2px; text-align: right;"><i class="fas fa-align-left"></i> 4000</div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label requerido" for="pretensiones" style="margin-top: -5px;">
                                        Describa lo que reclama / Solicitudes (Pretensiones)
                                        <i class="fas fa-question-circle" data-toggle="tooltip" title="Ayuda" onclick="MostrarAyudaHechosP('P');" style="cursor: pointer; color: #17a2b8; font-size: 20px;"></i>
                                    </label>
                                    <textarea class="form-control" id="pretensiones" rows="5" maxlength="4000" onkeyup="this.value = FiltrarCaracteres(this, 'textos', true);" onblur="$('#pretensiones').val(FiltrarCaracteres(this, 'textos', true));"></textarea>
                                    <div id="Mpretensiones" class="msgerr">El dato es requerido</div>
                                    <div id="cont_pretensiones" style="font-size: 11px; padding-top: 2px; text-align: right;"><i class="fas fa-align-left"></i> 4000</div>
                                </div>
                            </div>

                            <!-- Documentos adjuntos -->
                            <div class="row" id="adjuntos" style="margin-top: 10px; display: none;">
                                <div class="col-sm-12">
                                    <span style="color: red; font-size: 12px;">* El tamaño de cada uno de los archivos debe ser menor a 2MB y debe adjuntar mínimo 2</span>
                                    <table class="table table-bordered table-hover" style="font-size: 12px; text-transform: uppercase;">
                                        <thead>
                                            <tr>
                                                <th scope="col">Documento</th>
                                                <th scope="col" style="text-align: center; width: 100px;">Adjuntar</th>
                                                <th style="width: 24px;"></th>
                                            </tr>
                                        </thead>
                                        <input type="hidden" id="archivosTodos">
                                        <input type="hidden" id="archivosRequeridos">
                                        <tbody id="tablaArchivos">
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6 text-start">
                                    <button type="button" class="btn btn-light" id="btnAnteriorPasos" onclick="AccionBotonPasos(0);" disabled>Anterior</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-light" id="btnSiguientePasos" onclick="AccionBotonPasos(1);" disabled>Siguiente</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Datos personales -->
    <div class="modal fade" id="datosPersonalesModal" tabindex="-1" aria-labelledby="datosPersonalesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="datosPersonalesModalLabel">Solicitud de autorización para el tratamiento de datos personales</h5>
                <button type="button" class="btn-close" onclick="ConfirmarCierre('datosPersonalesModal', 'No ha aprobado la autorización de sus datos');"></button>
            </div>
            <div class="modal-body" id="textoDatosPersonales">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="QueRequiere();">Aceptar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Pregunta iniciales -->
    <div class="modal fade" id="modalQueRequiere" tabindex="-1" aria-labelledby="modalQueRequiereLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalQueRequiereLabel">¿Cuál es la solicitud requerida?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form>
                <input type="hidden" id="requerimiento" value="">
                <input type="hidden" id="tipoSolicitud">
                <input type="hidden" id="tabClic" value="1">
                <!-- Pestañas -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tituloTutela" data-bs-toggle="tab" data-bs-target="#menu1" type="button" role="tab" aria-controls="menu1" aria-selected="true" onclick="$('#tabClic').val(1);">Tutela</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tituloImpugnacion" data-bs-toggle="tab" data-bs-target="#menu2" type="button" role="tab" aria-controls="menu2" aria-selected="false" onclick="$('#tabClic').val(2);">Impugnación</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tituloDesacato" data-bs-toggle="tab" data-bs-target="#menu3" type="button" role="tab" aria-controls="menu3" aria-selected="false" onclick="$('#tabClic').val(3);">Desacato</button>
                    </li>
                </ul>
                <!-- Contenido de las pestañas -->
                <div class="tab-content" id="tabContent">
                    <!-- Tutela -->
                    <div class="tab-pane fade show active" id="menu1" role="tabpanel" aria-labelledby="tituloTutela">
                        <div id="textoTutela" class="txt-solicitud"></div>
                        <div class="row">
                            <div class="col-sm-6" id="DtematicaTutela0">
                                <label class="form-label requerido" for="tematicaTutela0">Seleccione la temática</label>
                                <select class="form-control" id="tematicaTutela0" onchange="LimpiarRequeridoSelect2(this);CargarNivelTematica('tematicaTutela', this.value);">
                                </select>
                                <div id="MtematicaTutela0" class="msgerr">El dato es requerido</div>
                            </div>
                            <div class="col-sm-6" id="DtematicaTutela">
                                <label class="form-label requerido" for="tematicaTutela">Seleccionar tema especifico</label>
                                <select class="form-control" id="tematicaTutela" onchange="LimpiarRequeridoSelect2(this);">
                                </select>
                                <div id="MtematicaTutela" class="msgerr">El dato es requerido</div>
                            </div>
                        </div>
                    </div>

                    <!-- Impugnación -->
                    <div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="tituloImpugnacion">
                        <div id="textoInpugnacion" class="txt-solicitud"></div>
                        <div class="row">
                            <div class="col-sm-6" id="DtematicaImpugnacion0">
                                <label class="form-label requerido" for="tematicaImpugnacion0">Seleccione la temática</label>
                                <select class="form-control" id="tematicaImpugnacion0" onchange="LimpiarRequeridoSelect2(this);CargarNivelTematica('tematicaImpugnacion', this.value);">
                                </select>
                                <div id="MtematicaImpugnacion0" class="msgerr">El dato es requerido</div>
                            </div>
                            <div class="col-sm-6" id="DtematicaImpugnacion">
                                <label class="form-label requerido" for="tematicaImpugnacion">Seleccionar tema especifico</label>
                                <select class="form-control" id="tematicaImpugnacion" onchange="LimpiarRequeridoSelect2(this);">
                                </select>
                                <div id="MtematicaImpugnacion" class="msgerr">El dato es requerido</div>
                            </div>
                        </div>
                    </div>

                    <!-- Desacato -->
                    <div class="tab-pane fade" id="menu3" role="tabpanel" aria-labelledby="tituloDesacato">
                        <div id="textoDesacato" class="txt-solicitud"></div>
                        <div class="row">
                            <div class="col-sm-6" id="DtematicaDesacato0">
                                <label class="form-label requerido" for="tematicaDesacato0">Seleccione la temática</label>
                                <select class="form-control" id="tematicaDesacato0" onchange="LimpiarRequeridoSelect2(this);CargarNivelTematica('tematicaDesacato', this.value);">
                                </select>
                                <div id="MtematicaDesacato0" class="msgerr">El dato es requerido</div>
                            </div>
                            <div class="col-sm-6" id="DtematicaDesacato">
                                <label class="form-label requerido" for="tematicaDesacato">Seleccionar tema especifico</label>
                                <select class="form-control" id="tematicaDesacato" onchange="LimpiarRequeridoSelect2(this);">
                                </select>
                                <div id="MtematicaDesacato" class="msgerr">El dato es requerido</div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="SeleccionSolicitud();">Continuar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal lisat de archivos -->
    <div class="modal fade" id="modalListaArchivos" tabindex="-1" aria-labelledby="modalListaArchivosLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalListaArchivosLabel">Documentos requeridos</h5>
                <span style="position: absolute; font-size: 12px; margin-top: 46px; color: #910000;">(Debe contar con mínimo 2 documentos de los requeridos).</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12" id="listaArchivos">
                        ...
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h5>¿Cuenta con los documentos necesarios?</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" onclick="AlFormulario();">Si</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal mensaje de ayuda hechos -->
    <div class="modal fade" id="modalAyudaH" tabindex="-1" aria-labelledby="modalAyudaHLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAyudaHLabel">Ayuda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="textoAyudaHechos"></p>
                <p>Si tiene problemas para escribir puedes dejar una grabación haciendo clic <a href="#" onclick="IniciarGrabacion('H');">aquí <i class="fas fa-microphone"></i></a>.</p>

                <div class="card" id="controlGrabacionH" style="display: none;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 m  msj-5min">
                                Podrás grabar hasta un máximo de 3 grabaciones, con una duración de 5 minutos cada una.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <button type="button" class="btn btn-danger btn-sm" id="recordH">Iniciar <i class="fas fa-microphone"></i></button>
                                <button type="button" class="btn btn-success btn-sm" id="stopH">Detener <i class="fas fa-microphone-slash"></i></button>
                            </div>
                            <div class="col-sm-7" id="cronometroH" style="display: none;color: #d80000;padding-top: 7px;font-size: 16px;">
                                <i class="fas fa-circle faa-burst animated" style="margin-right: 10px;"></i> <span id="tiempoH"></span>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" id="cuantosAudiosH" value="0">
                                <table style="width:100%">
                                    <tr>
                                        <th style="width: 90%;"></th>
                                        <th></th>
                                    </tr>
                                    <tr id="audioH1" style="display: none;">
                                        <td><audio controls style="height: 30px; width: 100%;" id="grabacionH1"></audio></td>
                                        <td><button type="button" class="btn btn-danger btn-sm" id="btnEliminarH1" onclick="EliminarGrabacion('H-1');"><i class="fas fa-trash-alt"></i></button></td>
                                    </tr>
                                    <tr id="audioH2" style="display: none;">
                                        <td><audio controls style="height: 30px; width: 100%;" id="grabacionH2"></audio></td>
                                        <td><button type="button" class="btn btn-danger btn-sm" id="btnEliminarH2" onclick="EliminarGrabacion('H-2');"><i class="fas fa-trash-alt"></i></button></td>
                                    </tr>
                                    <tr id="audioH3" style="display: none;">
                                        <td><audio controls style="height: 30px; width: 100%;" id="grabacionH3"></audio></td>
                                        <td><button type="button" class="btn btn-danger btn-sm" id="btnEliminarH3" onclick="EliminarGrabacion('H-3');"><i class="fas fa-trash-alt"></i></button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal mensaje de ayuda pretensiones -->
    <div class="modal fade" id="modalAyudaP" tabindex="-1" aria-labelledby="modalAyudaPLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAyudaPLabel">Ayuda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="textoAyudaPretensiones"></p>
                <p>Si tiene problemas para escribir puedes dejar una grabación haciendo clic <a href="#" onclick="IniciarGrabacion('P');">aquí <i class="fas fa-microphone"></i></a>.</p>
                <div class="card" id="controlGrabacionP" style="display: none;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 msj-5min">
                                Podrás grabar hasta un máximo de 3 grabaciones, con una duración de 5 minutos cada una.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <button type="button" class="btn btn-danger btn-sm" id="recordP">Iniciar <i class="fas fa-microphone"></i></button>
                                <button type="button" class="btn btn-success btn-sm" id="stopP">Detener <i class="fas fa-microphone-slash"></i></button>
                            </div>
                            <div class="col-sm-7" id="cronometroP" style="display: none;color: #d80000;padding-top: 7px;font-size: 16px;">
                                <i class="fas fa-circle faa-burst animated" style="margin-right: 10px;"></i> <span id="tiempoP"></span>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" id="cuantosAudiosP" value="0">
                                <table style="width:100%">
                                    <tr>
                                        <th style="width: 90%;"></th>
                                        <th></th>
                                    </tr>
                                    <tr id="audioP1" style="display: none;">
                                        <td><audio controls style="height: 30px; width: 100%;" id="grabacionP1"></audio></td>
                                        <td><button type="button" class="btn btn-danger btn-sm" id="btnEliminarP1" onclick="EliminarGrabacion('P1');"><i class="fas fa-trash-alt"></i></button></td>
                                    </tr>
                                    <tr id="audioP2" style="display: none;">
                                        <td><audio controls style="height: 30px; width: 100%;" id="grabacionP2"></audio></td>
                                        <td><button type="button" class="btn btn-danger btn-sm" id="btnEliminarP2" onclick="EliminarGrabacion('P2');"><i class="fas fa-trash-alt"></i></button></td>
                                    </tr>
                                    <tr id="audioP3" style="display: none;">
                                        <td><audio controls style="height: 30px; width: 100%;" id="grabacionP3"></audio></td>
                                        <td><button type="button" class="btn btn-danger btn-sm" id="btnEliminarP3" onclick="EliminarGrabacion('P3');"><i class="fas fa-trash-alt"></i></button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal mensaje de accion juramentada -->
    <div class="modal fade" id="modalAccionJuramentada" tabindex="-1" aria-labelledby="modalAccionJuramentadaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAccionJuramentadaLabel">Declaración jurada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="textoAccionJuramentada">
                </p>
                <div id="txtConfirmarEmails" class="alert alert-warning" role="alert" style="text-align: justify;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Rechazar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarSolicitud" onclick="GuardarSolicitud();">Aceptar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal mensaje radicacion de la solicitud -->
    <div class="modal fade" id="modalRadicacionSolicitud" tabindex="-1" aria-labelledby="modalRadicacionSolicitudLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRadicacionSolicitudLabel">Solicitud Tutela en línea</h5>
                <a href="https://www.personeriabogota.gov.co/" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <p id="textoRadicacionSolicitud">
                </p>
            </div>
            <div class="modal-footer">
            </div>
            </div>
        </div>
    </div>


    <!-- Modal confirmar email -->
    <div class="modal fade" id="modalConfirmarEmail" tabindex="-1" aria-labelledby="modalConfirmarEmailLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmarEmailLabel">Confirmar email</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <label class="form-label" for="emailP_X">Correo electrónico de quien diligencia</label>
                        <input type="text" class="form-control" placeholder="Correo electrónico" id="emailP_X" maxlength="150">
                        <div id="MemailP_X" class="msgerr">El correo no es valido</div>
                    </div>
                    <div class="col-sm-12">
                        <label for="emailA_X" class="form-label requerido">Correo electrónico del afectado</label>
                        <input type="text" class="form-control" placeholder="Correo electrónico" id="emailA_X" maxlength="150" onkeyup="this.value = FiltrarCaracteres(this, 'email');" onblur="ValidarEmail(this.id);">
                        <div id="MemailA_X" class="msgerr">El correo no es valido</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="ModificarEmail();">Modificar</button>
            </div>
            </div>
        </div>
    </div>


    <!-- Modal Loading-->
    <div id="modalLoading" class="modal fade" role="dialog">
        <div class="modal-dialog" style="text-align: center;">
            <div class="lds-facebook">
                <div style="border: solid 1px;"></div>
                <div style="border: solid 1px;"></div>
                <div style="border: solid 1px;"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid footer">
        <p>
            <a href="https://www.personeriabogota.gov.co/mecanismos-de-contacto-con-el-sujeto-obligado/proteccion-de-datos-personales/politicas-de-seguridad-de-la-informacion-del-sitio-web" title="Politicas de Seguridad de la información" alt="Link a Politicas de Seguridad de la información" target="_blank">
                Políticas de seguridad de la información del sitio WEB
            </a> --
            <a href="https://www.personeriabogota.gov.co/mecanismos-de-contacto-con-el-sujeto-obligado/proteccion-de-datos-personales/politica-de-proteccion-de-datos-personales" title="Politicas de tratamiento de datos personales" alt="Link a Politicas de tratamiento de datos personales" target="_blank">
                Política de tratamiento de datos personales
            </a>
        </p>
    </div>


    <!-- Include custome JQuery JS -->
    <script src="/js/base64.js"></script>
    <script src="/js/ciudadano_form.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
