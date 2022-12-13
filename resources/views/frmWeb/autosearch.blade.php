@extends('../mainUsrWeb')

@section('title','DATOS DEL DE CIUDADANO')

@section('AddScritpHeader')

@endsection

@section('content')

<form name="frmRegistroDatos" enctype="multipart/form-data" id="frmRegistroDatos">


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        <h5>Por favor ingrese el numero de solicitud y el codigo correspondiente</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-4">
                                        <label for="name">Numero de Solicitud</label>
                                        <input type="text" name="num_solicitud" id="num_solicitud" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="col-md-4">
                                    <label for="name">Codigo</label>
                                    <input type="text" name="codigo" id="codigo" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                </div>
                                <div id="product_list"></div>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <div class="modal" tabindex="-1" role="dialog" id="certifica">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-header">
                
              <h5 class="modal-title">Agregar Diagnostico</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="form-group col-md-4">
                    {{ Form::label('diag_id', 'Diagnostico', ['class' => 'control-label col-form-label-sm']) }}
                    
                    @if($errors->has('diag_id'))
                    <div class="invalid-feedback d-block">
                      {{ $errors->first('diag_id') }}
                    </div>
                 @endif
                </div>
        
                    <div class="form-group col-md-4">
                        {{ Form::label('codigo', 'Codigo', ['class' => 'control-label col-form-label-sm']) }}
                        {{ Form::text('codigo', null, ['class' => $errors->first('codigo') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm','id' =>'codigo' ]) }}
                        @if($errors->has('codigo'))
                        <div class="invalid-feedback d-block">
                          {{ $errors->first('codigo') }}
                        </div>
                     @endif
                    </div>
                </div>
                <div class="row">
                   <div class="form-group col-md-4">
                    {{ Form::label('esta_id', 'Estado', ['class' => 'control-label col-form-label-sm']) }}
                    
                    @if($errors->has('esta_id'))
                    <div class="invalid-feedback d-block">
                      {{ $errors->first('esta_id') }}
                    </div>
                 @endif
                    </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    {{ Form::label('concepto', 'Conducta y Evolución', ['class' => 'control-label col-form-label-sm']) }}
                   
                    <p id="contadorconcepto">0/4000</p>
                    @if($errors->has('concepto'))
                      <div class="invalid-feedback d-block">
                        {{ $errors->first('concepto') }}4
                      </div>
                   @endif
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button  class="btn btn-success" id="ajaxSubmit">Guardar</button>
              </div>
          </div>
        </div>
      </div>
</form>

<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
{{-- {!! Form::open(['route' => ['cambioestado',$dato->num_solicitud],'class' => 'form-horizontal']) !!}

<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success" role="alert">
      <small class="text-justify">
        <div class="card-body">
        <div class="row">
          <div class="col-md-11">
            <b>¿Desea realizar el desistimiento de la solicitud de concilación?</b>
          </div>
          <div class="col-md-1">
          </div>
        </div>
        <hr>
            <div class="col-md-6">
              <select class="form-control form-control-sm custom-select" name="desistir" id="desistir" required>
                <option value=" ">- Seleccione una opcion -</option>
                <option value="Cancelado">Si</option>
                <option value="Remitido">No</option>
            </select>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                {{ Form::submit('Guardar', ['class' => 'btn btn-primary ml-2']) }}
              </div>
              <div class="col-md-4">
                <a class="btn btn-primary ml-2" href="{{ route('search') }}">Regresar</a>
              </div>
            </div>
            
      </div>
      </small>
    </div>
  </div>
</div>

{!! Form::close() !!} --}}
  </div>
  <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Hide this modal and show the first with the button below.
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
        </div>
      </div>
    </div>
  </div>


<div id="modalRespuesta"></div>

@endsection

@section('AddScriptFooter')

<script>
    $(document).ready(function(){
        $('#num_solicitud').on('keyup',function () {
            var query = $(this).val();
            var codigo = $('#codigo').val();
            $.ajax({
                url:'{{ route('search') }}',
                type:'GET',
                data:{'num_solicitud':query,
                'codigo':codigo,
            },
                success:function (data) {
                    $('#product_list').html(data);
                }
            })
        });
        $('#codigo').on('keyup',function () {
            var query = $('#num_solicitud').val();
            var codigo = $('#codigo').val();
            $.ajax({
                url:'{{ route('search') }}',
                type:'GET',
                data:{'num_solicitud':query,
                'codigo':codigo,
            },
                success:function (data) {
                    $('#product_list').html(data);
                }
            })
        });
        $(document).on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        // $(document).on('click', 'li', function(){
        //     var value = $(this).text();
        //     $('#num_solicitud').val(value);
        //     $('#product_list').html("");
        // });
    });
</script>
@endsection
