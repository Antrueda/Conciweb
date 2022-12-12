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
                        <h5>Laravel 9 Ajax Autocomplete Search from Database Example - NiceSnippets.com</h5>
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
    990614

</form>

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
        // $(document).on('click', 'li', function(){
        //     var value = $(this).text();
        //     $('#num_solicitud').val(value);
        //     $('#product_list').html("");
        // });
    });
</script>
@endsection
