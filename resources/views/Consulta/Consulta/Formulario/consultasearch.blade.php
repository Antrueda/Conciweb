@extends('../mainAdmin')

@section('title','CONCIWEB')

@section('AddScritpHeader')

@endsection

@section('content')

<form name="frmRegistroDatos" enctype="multipart/form-data" id="frmRegistroDatos">


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        <h5>Por favor ingrese el Número de solicitud y Vigencia</h5>
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
                                    <label for="codigo">Vigencia</label>
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



</form>



@endsection

@section('AddScriptFooter')

<script>
    $(document).ready(function(){
        $('#search').on('click',function () {
            var query = $('#num_solicitud').val();
            var codigo = $('#codigo').val();
            $.ajax({
                url:'{{ route('consultanum') }}',
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
