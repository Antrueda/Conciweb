<form name="frmRegistroDatos" id="frmRegistroDatos">
    <input type="hidden" name="rol" value="{!! $data['rol'] !!}" >
    <input type="hidden" name="numSolicitud" value="{!! $data['numSinproc'] !!}" >
    <input type="hidden" name="identificacion" value="{!! $data['identificacion'] !!}" >

    <div class="row">
        <div class="col-md-3">
            <label class="form-group has-float-label">
                <input type="text" class="form-control form-control-sm validate[required]" name="nombreOrg" id="nombreOrg" value="{!! $data['nombreOrg'] !!}" autocomplete="off">
                <span> 1) Nombre Organizacion *</span>
            </label>
        </div>
        <div class="col-md-3">
            <label class="form-group has-float-label">
                <input type="text" class="form-control form-control-sm validate[required]" name="direccion" id="direccion" value="{!! $data['direccion'] !!}" autocomplete="off">
                <span> 2) Direccion *</span>
            </label>
        </div>
        <div class="col-md-3">
            <label class="form-group has-float-label">
                <input type="text" class="form-control form-control-sm validate[required]" name="telefono" id="telefono" value="{!! $data['telefono'] !!}" autocomplete="off">
                <span> 3) Telefono *</span>
            </label>
        </div>
    </div>

    <div class="col-md-4" id="btnRegistrar">
        <button type="submit" class="btn btn-primary btn-block btn-sm" >&nbsp;<span class="fa fa-save"> </span> ACTUALIZAR </button>
    </div>
</form>
<script>

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
            url: "edicionDatosCiudadanoOrg",
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