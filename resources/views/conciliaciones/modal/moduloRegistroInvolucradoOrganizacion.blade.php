
<div class="row">
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <select class="form-control form-control-sm custom-select validate[required]" name="tipoOrganizacion" id="tipoOrganizacion" onchange="tipoOrg(this.value)">
                <option value=" ">- Seleccione una opcion -</option>
                <option value="PUBLICA">PÚBLICA</option>
                <option value="PRIVADA">PRIVADA</option>
            </select>
            <span> 1) Tipo de Organización *</span>
        </label>
    </div>
    <div class="col-md-3" id="subSeccionEntidad" style="display: none">
        <label class="form-group has-float-label">
            <select class="form-control form-control-sm custom-select validate[required]" name="tipoEntidad" id="tipoEntidad">
                <option value=" ">- Seleccione una opcion -</option>
                @foreach ($data['tipoEntidadPublica'] as $info)
                    <option value="{{$info->sicidtipoentidadpublica}}">{!! $info->sictipoentidadpublica !!}</option>
                @endforeach
            </select>
            <span> 2) Tipo de Entidad Publica  *</span>
        </label>
    </div>
    <div class="col-md-6"></div>
</div>
<div class="row">
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <select class="form-control form-control-sm custom-select validate[required]" name="tipoIdentificacion" id="tipoIdentificacion">
                <option value=" ">- Seleccione una opcion -</option>
                @foreach ($data['listaTipoDoc'] as $info)
                    <option value="{{$info->sicidtipodocumentoidentidad}}">{!! $info->sictipodocumentoidentidad !!}</option>
                @endforeach
            </select>
            <span> 3) Tipo Identificación *</span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <input type="text" class="form-control form-control-sm validate[required]" name="numeroDocuemnto" id="numeroDocuemnto" autocomplete="off">
            <span> 4) Numero de Documento *</span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <input type="text" class="form-control form-control-sm validate[required]" name="nombreOrganizacion" id="nombreOrganizacion" autocomplete="off">
            <span> 5) Nombre *</span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <select class="form-control form-control-sm custom-select validate[optional]" name="tipoSectorEconomico" id="tipoSectorEconomico">
                <option value=" ">- Seleccione una opcion -</option>
                @foreach ($data['tipoSectorEconomico'] as $info)
                    <option value="{{$info->sicidsectoreconomico}}">{!! $info->sicsectoreconomico !!}</option>
                @endforeach
            </select>
            <span> 6) Sector Económico </span>
        </label>
    </div>
</div>
<hr>
<ul class="nav justify-content-center breadcrumb text-center">
    <li class="nav-item">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                    Información de Contacto
            </li>
        </ul>
    </li>

</ul>


<hr>


<div class="row">
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <select class="form-control form-control-sm custom-select validate[required]" name="tipoDepartamento" id="tipoDepartamento">
                <option value=" ">- Seleccione una opcion -</option>
                @foreach ($data['listaDepartamento'] as $info)
                    <option value="{{$info->siciddepartamento}}">{!! $info->sicdepartamento !!}</option>
                @endforeach
            </select>
            <span> 7) Departamento * </span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <select class="form-control form-control-sm custom-select validate[required]" name="tipoCiudad" id="tipoCiudad">
                <option value=" ">- Seleccione una opcion -</option>
            </select>
            <span> 8) Ciudad *</span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <input type="text" class="form-control form-control-sm validate[required]" name="direccion" id="direccion" autocomplete="off">
            <span> 9) Dirección *</span>
        </label>
    </div>
    <div class="col-md-3">
        <label class="form-group has-float-label">
            <input type="text" class="form-control form-control-sm validate[required]" name="telefono" id="telefono" autocomplete="off">
            <span> 10) Teléfono 1 *</span>
        </label>
    </div>
</div>





<script>

    function tipoOrg(dato){
        if(dato=='PUBLICA'){
            $('#subSeccionEntidad').show();
        }else{
            $('#subSeccionEntidad').hide();
        }
    }

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

</script>