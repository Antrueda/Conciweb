<label class="form-group has-float-label">
    <select class="form-control form-control-sm custom-select validate[required]" name="idArea" id="idArea" onchange="busquedaTema(this.value)">
        <option value=" ">- Seleccione una opcion -</option>
        @foreach ($data['listaAreas'] as $info)
            <option value="{{$info->sicidarea}}">{!! $info->sicnombrearea !!}</option>
        @endforeach
    </select>
    <span> 7) Area *</span>
</label>