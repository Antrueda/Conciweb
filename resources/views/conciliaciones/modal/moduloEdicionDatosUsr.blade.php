<form name="frmRegistroDatos" id="frmRegistroDatos">
    <input type="hidden" name="rol" value="{!! $data['rol'] !!}" >
    <input type="hidden" name="numSolicitud" value="{!! $data['numSinproc'] !!}" >
    @foreach ($data['datosCiudadano'] as $info)
        <div class="row">
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="primerNombre" id="primerNombre" value="{!! $info->sicprimernombre !!}" autocomplete="off">
                    <span> 1) Primer Nombre *</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="segundoNombre" id="segundoNombre" value="{!! $info->sicsegundonombre !!}" autocomplete="off">
                    <span> 2) Segundo Nombre </span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="primerApellido" id="primerApellido" value="{!! $info->sicprimerapellido !!}" autocomplete="off">
                    <span> 3) Primer Apellido *</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="segundoApellido" id="segundoApellido" value="{!! $info->sicsegundoapellido !!}" autocomplete="off">
                    <span> 4) Segundo Apellido </span>
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="numeroDocuemnto" id="numeroDocuemnto" value="{!! $data['tipoDocCiudadano'] !!}" readonly>
                    <span> 5) Tipo de Documento *</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="numeroDocuemnto" id="numeroDocuemnto" value="{!! $data['identificacion'] !!}" readonly>
                    <span> 6) Numero de Documento *</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="ciudadExpedicion" id="ciudadExpedicion" value="{!! $info->sicciudadexpedicion !!}" autocomplete="off">
                    <span> 7) Ciudad de Expedicion *</span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="direccion" id="direccion" value="{!! $info->sicdireccion !!}" autocomplete="off">
                    <span> 8) Direccion *</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <input type="text" class="form-control form-control-sm validate[required]" name="telefono" id="telefono" value="{!! $info->sictelefono !!}" autocomplete="off">
                    <span> 9) Telefono </span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <select class="form-control form-control-sm custom-select validate[required]" name="tipoDepartamento" id="tipoDepartamento">
                        <option selected value="{!! $data['idDepartamente'] !!}">{!! $data['nombreDepartamento'] !!}</option>
                        @foreach ($data['listaDepartamento'] as $info)
                            <option value="{{$info->siciddepartamento}}">{!! $info->sicdepartamento !!}</option>
                        @endforeach
                    </select>
                    <span> 10) Departamento *</span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="form-group has-float-label">
                    <select class="form-control form-control-sm custom-select validate[required]" name="tipoCiudad" id="tipoCiudad">
                        <option selected value="{!! $data['idCiudadadActual'] !!}">{!! $data['nombreCiudadadActual'] !!}</option>
                    </select>
                    <span> 11) Ciudada </span>
                </label>
            </div>
        </div>

    @endforeach
    <div class="col-md-4" id="btnRegistrar">
        <button type="submit" class="btn btn-primary btn-block btn-sm" >&nbsp;<span class="fa fa-save"> </span> ACTUALIZAR </button>
    </div>
</form>
<script>
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
        var formData=new FormData(document.getElementById("frmRegistroDatos"));
        formData.append("dato","valor");
        $.ajax({
            type: "POST",
            url: "edicionDatosCiudadano",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
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
</script>