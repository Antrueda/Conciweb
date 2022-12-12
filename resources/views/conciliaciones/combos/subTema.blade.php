<label class="form-group has-float-label">
    <select class="form-control form-control-sm custom-select validate[required]" name="idSubTema" id="idSubTema">
        <option value=" ">- Seleccione una opcion -</option>
        @foreach ($data['listaSubTemas'] as $info)
            <option value="{{$info->sicidclasificacionasunto}}">{!! $info->sicnombreclasificacionasunto !!}</option>
        @endforeach
    </select>
    <span> 9) Sub-Tema *</span>
</label>