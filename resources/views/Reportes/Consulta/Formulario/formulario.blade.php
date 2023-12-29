<form method="POST" action="{{ route('reportes.generate-excel') }}">
    @csrf
    <div class="row justify-content-md-center">
        <div class="col-4">
    <label for="start_date">Fecha de inicio:</label>
    {{ Form::date('start_date', null, ['class' => $errors->first('start_date') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','id'=>'start_date','name'=>'start_date', 'onkeydown'=>"return false",  'max'=>$todoxxxx['Maxhoy']]) }}
    </div>
    <div class="col-4">
    <label for="end_date">Fecha de fin:</label>
    {{ Form::date('end_date', null, ['class' => $errors->first('end_date') ? 'form-control form-control-sm is-invalid validate' : 'form-control form-control-sm validate','id'=>'end_date','name'=>'end_date', 'onkeydown'=>"return false",  'max'=>$todoxxxx['Maxhoy']]) }}
</div>
    </div>
    <br>
    <div class="row justify-content-md-center">
    <button type="submit" class="btn btn-success pt-2" id="btnRegistro" style='width: 220px'  > Generar Reporte  <i class="far fa-check-circle"></i></button>
    </div>      
</form>