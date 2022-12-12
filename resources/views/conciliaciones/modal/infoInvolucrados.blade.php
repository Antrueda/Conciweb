
<script type="text/javascript">
    $('#modal').modal({backdrop: 'static', keyboard: false});
    $('#modal').modal('show');
</script>

<div class="modal fade bd-example-modal-xl" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <input type="hidden" value="{{$numSinproc=$data['numSolicitud']}}" name="numSolicitud" id="numSolicitud">
            <div class="alert" role="alert" style="background-color: #003E65; color: white;">
                <div class="row">
                    <div class="col-md-12 text-md-center">
                        <p class="text-xs-center"><strong>DATOS BASICOS (DEL / LOS) {{$rol=$data['rol']}}(S) &nbsp;&nbsp; <br><small>Todos los campos con asterisco (*) son obligatorios</small></strong></p>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                <div id="tablaUsrInicial">
                    <div class="card">
                        <div class="card-body">
                            CIUDADANOS
                        </div>
                    </div>
                    <!-- DATATABEL USUARIO -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap" width="100%" id="myTable">
                            <thead>
                            <tr>
                                <th width="14%">IDENTIFICACIÓN</th>
                                <th width="10%">TIPO DOC.</th>
                                <th width="38%">NOMBRES</th>
                                <th width="26%">DIRECCION</th>
                                <th width="12%">ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @empty(!$data['registrosCiudadano'])
                                @foreach ($data['registrosCiudadano'] as $info)
                                    <tr>
                                        <th scope="row">{{$info->sicidentificacion}}</th>
                                        <td>{!! $info->sicsigla !!}</td>
                                        <td>{!! $info->sicprimernombre !!} {!! $info->sicsegundonombre !!} {!! $info->sicprimerapellido !!} {!! $info->sicsegundoapellido !!}</td>
                                        <td>{{$info->sicdireccion}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="edicionDatosUsr('{{$numSinproc}}','{{$info->sicidentificacion}}','{{$rol}}','USR')"><i class="fas fa-user-edit"></i></button>
                                            <button type="button" class="btn btn-danger" onclick="desactivarUsr('{{$numSinproc}}','{{$info->sicidentificacion}}','{{$rol}}','USR')"><i class="fas fa-user-times"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endempty
                            </tbody>
                        </table>
                    </div>
                    <!-- DATATABEL ORGAIZACIONES -->
                    <hr>
                    <div class="card">
                        <div class="card-body">
                            ORGANIZACIONES
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap" width="100%" id="myTable">
                            <thead>
                            <tr>
                                <th width="14%">IDENTIFICACIÓN</th>
                                <th width="26%">NOMBRE</th>
                                <th width="48%">DIRECCION</th>
                                <th width="12%">ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @empty(!$data['registroOrganizaciones'])
                                @foreach ($data['registroOrganizaciones'] as $info)
                                    <tr>
                                        <th scope="row">{{$info->sicidentificacion}}</th>
                                        <td>{!! $info->sicnombre !!}</td>
                                        <td>{{$info->sicdireccion}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="edicionDatosUsr('{{$numSinproc}}','{{$info->sicidentificacion}}','{{$rol}}','ORG')"><i class="fas fa-user-edit"></i></button>
                                            <button type="button" class="btn btn-danger" onclick="desactivarUsr('{{$numSinproc}}','{{$info->sicidentificacion}}','{{$rol}}','ORG')"><i class="fas fa-user-times"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endempty
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="seccionEdicionUsr">

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-danger btn-block btn-sm" data-dismiss="modal">&nbsp;<span class="fa fa-window-close"> </span> CERRAR</button>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<script>
    function edicionDatosUsr(sinproc,identificacion,rol,tipo){
        if (tipo=='USR'){ var url='moduloEdicionDatosUsr';}else{ var url='moduloEdicionDatosUsrOrg';}
        $.ajax({
            url:url,
            data: {sinproc:sinproc,identificacion:identificacion,rol:rol},
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(respuesta){
                $("#seccionEdicionUsr").html(respuesta);
                $('#tablaUsrInicial').hide();
                },
            error: function(jqXHR, textStatus, errorThrown){    alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest);    }
        })
    }

    function desactivarUsr(sinproc,identificacion,rol,tipo){
        $.ajax({
            url:'moduloDesactivarUsr',
            data: {sinproc:sinproc,identificacion:identificacion,rol:rol,tipo:tipo},
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){llamarNotyCarga();},
            success: function(r){
                cons();
                var datUsr=r.split("|");
                var valor=datUsr[1];
                var msg=datUsr[2];
                if(valor==0) {
                    var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
                    llamarNotyTime('error',msg,'topRight',2000);
                }else{
                    var msg="<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" +msg;
                    new Noty({
                        text: msg,
                        type: 'success',
                        layout: 'center',
                        theme: 'bootstrap-v4',
                        killer:true,
                        progressBar:true,
                        timeout:2000,
                        callbacks: {
                            afterClose: function() {
                                $('#modal').modal('toggle');
                            },
                        }
                    }).show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown){    alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest);    }
        })
    }
</script>