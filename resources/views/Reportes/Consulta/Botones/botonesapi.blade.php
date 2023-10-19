{{-- 
<a class="btn btn-sm btn-success " href="{{ route($requestx->routexxx[0].'.editar', $queryxxx->id) }}">EDITAR</a> --}}


<a class="btn btn-sm btn-primary " href="{{ route($requestx->routexxx[0].'.agregar', [$queryxxx->num_solicitud]) }}">VER</a>
{{-- <a class="btn btn-success" data-bs-toggle="modal" id="mediumButton" data-target="#mediumModal" data-attr=" {{route('consultac.agregar', $queryxxx->num_solicitud)}} " style="color:white">Ver  2  <i class="fas fa-minus-square"></i></a> --}}

{{-- <a class="btn btn-sm btn-danger " href="{{ route($requestx->routexxx[0].'.borrar', [$queryxxx->id]) }}">INACTIVAR</a> --}}




<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
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

<script>

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
</script>