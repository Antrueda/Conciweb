<div class="form-group row">
    <div class="form-group col-md-4">
        {{ Form::label('prm_documento_id','Tipo de documento') }}
        {{ Form::select('prm_documento_id',$todoxxxx['prm_documento_id'], null,['class'=>'form-control form-control-sm select2',$todoxxxx['readonly']]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('s_documento','No. de Documento') }}
        {{ Form::text('s_documento', null,['class'=>'form-control form-control-sm',$todoxxxx['readonly']]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('sis_departam_id','Departamento Exp. Documento') }}
        {{ Form::select('sis_departam_id',$todoxxxx['sis_departam_id'], null,['class'=>'form-control form-control-sm select2',$todoxxxx['readonly']]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('sis_municipio_id','Municipio Exp. Documento') }}
        {{ Form::select('sis_municipio_id',$todoxxxx['sis_municipio_id'], null,['class'=>'form-control form-control-sm select2',$todoxxxx['readonly']]) }}
    </div>

    <div class="form-group col-md-4">
        {{ Form::label('s_primer_nombre','Primer Nombre') }}
        {{ Form::text('s_primer_nombre', null,['class'=>'form-control form-control-sm',$todoxxxx['readonly'],'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'style' => 'text-transform:uppercase;']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('s_segundo_nombre','Segundo Nombre') }}
        {{ Form::text('s_segundo_nombre', null,['class'=>'form-control form-control-sm',$todoxxxx['readonly'],'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'style' => 'text-transform:uppercase;']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('s_primer_apellido','Primer Apellido') }}
        {{ Form::text('s_primer_apellido', null,['class'=>'form-control form-control-sm',$todoxxxx['readonly'],'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'style' => 'text-transform:uppercase;']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('s_segundo_apellido','Segundo Apellido') }}
        {{ Form::text('s_segundo_apellido', null,['class'=>'form-control form-control-sm',$todoxxxx['readonly'],'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'style' => 'text-transform:uppercase;']) }}
    </div>

    <div class="form-group col-md-4">
        {{ Form::label('s_telefono','Teléfono') }}
        {{ Form::number('s_telefono', null,['class'=>'form-control form-control-sm',$todoxxxx['readonly'],"onkeypress" => "return soloNumeros(event);"]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('email','Correo Electrónico') }}
        {{ Form::text('email', null,['class'=>'form-control form-control-sm',$todoxxxx['readonly'],'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'style' => 'text-transform:uppercase;']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('prm_tvinculacion_id','Tipo de Vinculación') }}
        {{ Form::select('prm_tvinculacion_id',$todoxxxx['prm_tvinculacion_id'], null,['class'=>'form-control form-control-sm select2',$todoxxxx['readonly']]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('s_matriculap','Tarjeta Profesional') }}
        {{ Form::text('s_matriculap', null,['class'=>'form-control form-control-sm',$todoxxxx['readonly'],'onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'style' => 'text-transform:uppercase;']) }}
    </div>


    <div class="form-group col-md-4">
        {{ Form::label('sis_cargo_id','Cargo') }}
        {{ Form::select('sis_cargo_id',$todoxxxx['sis_cargo_id'], null,['class'=>'form-control form-control-sm select2',$todoxxxx['readonly']]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('d_vinculacion','Fecha de Vinculación') }}
        {{Form::date('d_vinculacion', null,['class'=>'form-control form-control-sm',$todoxxxx['readonly']])}}
    </div>

    <div class="form-group col-md-4">
        {{ Form::label('d_finvinculacion','Fecha lí­mite de vinculación') }}
        {{Form::date('d_finvinculacion', null,
    ['class'=>'form-control form-control-sm'])}}
    </div>
    @include('administracion.Usuario.Usuario.formulario.motivoestado')
    @include('layouts.tiempos')
    @include('layouts.registro')
</div>
