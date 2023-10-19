@extends('../mainAdmin')

@section('content')
    <h1>Visualización de Datos</h1>
    <table class="table" id="miTabla">
        <thead>
            <tr>
                <th>ID Registro</th>
                <th>Fecha Creación</th>
                <th>Fecha Actualización</th>
                <th>Fecha Actualización</th>
            </tr>
        </thead>
    </table>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            console.log('Documento listo');
            $('#miTabla').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('datatable.getData') !!}',
                columns: [
                    { data: 'NUM_SOLICITUD', name: 'NUM_SOLICITUD' },
                    { data: 'FEC_SOLICITUD_TRAMITE', name: 'FEC_SOLICITUD_TRAMITE' },
                    { data: 'UPDATED_AT', name: 'UPDATED_AT' },
                    { data: 'ESTADODOC', name: 'ESTADODOC' },
                ]
            });
        });
    </script>
@endsection