@extends('../mainUsrWeb')

@section('title','CONSULTAR SOLICITUD')

@section('AddScritpHeader')

@endsection

@section('content')

<form name="frmRegistroDatos" enctype="multipart/form-data" id="frmRegistroDatos">


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        <h5>Por favor ingrese el Número de solicitud y el Código correspondiente</h5>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row justify-content-md-center">
                                    <div class="col-md-5">
                                      <div class="form-floating mb-3">
                              
                                        <input type="text" name="num_solicitud" id="num_solicitud" class="form-control" autocomplete="off" placeholder="0">
                                        <label for="num_solicitud">Número de Solicitud</label>
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-floating mb-3">
                                   
                                    <input type="text" name="codigo" id="codigo" class="form-control" autocomplete="off" placeholder="0">
                                    <label for="codigo">Pin o Contraseña</label>
                                    </div>
                                </div>
                                <div class="col-sm-1" style="padding: 6px;margin-top:7px;width:60px;height:60px">
                                  <div id="search" class="btn btn-outline-primary" ><i class="fas fa-search-plus"></i></div>
                                </div>
                                </div>
                                <div id="product_list"></div>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>  
  </div>  
<br>
  <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Desistimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>


</form>



{{-- <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
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
  {{-- </div>
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
  </div> --}} 




@endsection

@section('AddScriptFooter')

<script>
    $(document).ready(function(){
        $('#search').on('click',function () {
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

        // $('#codigo').on('keyup',function () {
        //     var query = $('#num_solicitud').val();
        //     var codigo = $('#codigo').val();
        //     $.ajax({
        //         url:'{{ route('search') }}',
        //         type:'GET',
        //         data:{'num_solicitud':query,
        //         'codigo':codigo,
        //     },
        //         success:function (data) {
        //             $('#product_list').html(data);
        //         }
        //     })
        // });
        
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
