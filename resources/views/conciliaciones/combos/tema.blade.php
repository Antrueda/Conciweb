<label class="form-group has-float-label">
    <select class="form-control form-control-sm custom-select validate[required]" name="idTema" id="idTema" onchange="busquedaSubTema(this.value)">
        <option value=" ">- Seleccione una opcion -</option>
        @foreach ($data['listaTemas'] as $info)
            <option value="{{$info->sicidasunto}}">{!! $info->sicnombreasunto !!}</option>
        @endforeach
    </select>
    <span> 8) Tema *</span>
</label>