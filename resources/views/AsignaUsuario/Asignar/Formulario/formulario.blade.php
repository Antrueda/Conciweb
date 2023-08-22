<style>
    input {
    
    width: 50%;
     }
</style>


<div class="form-row align-items-end">
    <div class="row">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Cedula</th>
                <th scope="col"> {{$todoxxxx['userrolx']->cedula}}</th>
              </tr>
              <tr>
              <th scope="col">Nombre Completo</th>
              <th scope="col">{{$todoxxxx['userrolx']->nombre}} {{$todoxxxx['userrolx']->apellido}}</th>
            </tr>
            <tr>
            <th scope="col">Correo</th>
            <th scope="col">{{$todoxxxx['userrolx']->email}}</th>
          </tr>
            <tr>
            <th scope="col">Estado</th>
            <th scope="col">{{$todoxxxx['userrolx']->estado}}</th>
          </tr>
            </thead>
          
          </table>
        </div>
    </div>
</div>
    
    <div class="row">
        <div class="form-group col-md-6">
            
            {{ Form::label('correo', '¿Desea recibir correo?:', ['class' => 'control-label col-form-label-sm']) }}
            {{ Form::select('correo', $todoxxxx['correose'],$todoxxxx['modeloxx']->correo, ['class' => 'form-control form-control-sm', 'date-placeholder'=>'- Seleccione una opcion -', 'id'=>'correo']) }}
              {{-- <option value=" ">- Seleccione una opcion -</option>
              <option value=1>Si</option>
              <option value=0>No</option>
          </select> --}}
    
        </div>
        <div class="form-group col-md-6">
    	{{ Form::label('estado', 'Estado:', ['class' => 'control-label col-form-label-sm']) }}
        {{ Form::select('estado', $todoxxxx['estadoxx'],$todoxxxx['modeloxx']->estado, ['class' => 'form-control form-control-sm', 'date-placeholder'=>'- Seleccione una opcion -', 'id'=>'estado']) }}
        {{-- <select class="form-control form-control-sm custom-select" name="correo" id="correo" required>
            <option value=" ">- Seleccione una opcion -</option>
            <option value=1>Si</option>
            <option value=0>No</option>
        </select> --}}
    </div>
    
  </div>  
  <br>
  <div class="row">
      @foreach ($todoxxxx['rolesxxx'] as $rol)
          <label>
              <input type="checkbox" name="roles[]" value="{{ $rol->id }}" 
                     {{ $todoxxxx['userrolx']->roles->contains($rol->id) ? 'checked' : '' }}>
              {{ $rol->name }}
          </label><br>
      @endforeach

    </div>
<br>

