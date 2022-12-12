<style type="text/css">
    .titleLabel{
        size:2;
        font-weight: bold;
        text-align: left;
    }
    .table{
        border-collapse: separate;
        border-spacing: 0px;
    }
    #esto{
        position:absolute; bottom:1px; width:100%;  text-align:right;
    }
</style>
<body style="margin-bottom:0px; margin-top:0px;">
    <div class="container" style="position: relative; top: -40px;">

        <table width="100%" class="table">
            <tbody>
            <tr>
                <td width="30%">
                    <img src="{{ public_path('imagen/logo.png') }}" class="img-fluid" alt=""><br>
                </td>
                <td width="70%" style="text-align:left;">
                    <div style="text-align:center; color:#000000;">
                        <font size=3><b> PERSONERÍA DE BOGOTÁ D.C.<br/> CENTRO DE CONCILIACIÓN</b></font><br/>
                        <b>Autorizado Resolución 2449 del 24 de diciembre de 2003<br/>
                            Ministerio del Interior y de Justicia<br/>
                            Código No. 3186</b>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        @foreach ($datosDeLaSolicitud as $info)
            <table width="100%">
                <tr>
                    <td><br><center><b>CERTIFICADO DE REGISTRO DEL CASO<br>{!! $info->resultado_padre !!} </b> - {!! $info->tiporesultado !!} <br></center>
                    </td>
                </tr>
            </table>
            <br>
            <table width="100%">
                <tr>
                    <td>
                        <b>No Sinproc: </b> {!! $sinproc !!}<br>
                        <b>Número del Caso en el centro: </b> {!! $info->conciliadorcaso !!}<br>
                        <b>Sede: </b> {!! $info->nomsede !!}  <br>
                        <b>Cuantía: </b> {!! $info->cuantia !!}  <br>
                        <b>Fecha de solicitud: {!! $info->fecsol !!} </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <b>Fecha del resultado: </b> {!! $info->fechasesion !!} <br>
                    </td>
                </tr>
            </table>
            <br><hr><br>
            <table width="100%">
                <tr>
                    <td>
                        <b>Tema de la Conciliación</b><br>
                        <b>Area:</b> {!! $info->area !!} <br>
                        <b>Tema:</b> {!! $info->asunto !!} <br>
                        <b>Subtema:</b> {!! $info->subtema !!}
                    </td>
                </tr>
            </table>
            <br>
            <table width="100%" border="1">
                <tr>
                    <td><center><b>CONVOCANTE(S)</b></center></td>
                    <td><center><b>CONVOCADO(S)</b></center></td>
                </tr>
                <tr>
                    <td>
                        <table width="100%">
                            <tr style="text-align: center;">
                                <td colspan="2">Nombre e Identifiación</td>
                            </tr>
                        </table>
                        <table>
                            <tr style="text-align: center;">
                                @foreach ($arrayDatosConvocanteNatural as $infoSol)
                                    <b>{!! $infoSol->datos !!}</b>
                                @endforeach
                                @foreach ($arrayDatosConvocanteOrganizacion as $infoSol)
                                    <b>{!! $infoSol->datos !!}</b>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table width="100%">
                            <tr style="text-align: center;">
                                <td colspan="2">Nombre e Identifiación</td>
                            </tr>
                        </table>
                        <table>
                            <tr style="text-align: center;">
                                @foreach ($arrayDatosConvocadosNatural as $infoSol)
                                    <b>{!! $infoSol->datos !!}</b>
                                @endforeach
                                @foreach ($arrayDatosConvocadosOrganizacion as $infoSol)
                                    <b>{!! $infoSol->datos !!}</b>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br><br>
            <table width="100%">
                <tr>
                    <td>
                        <b>Conciliador:{!! $info->conciliadorcaso !!} </b><br>
                        <b>
                            <img src="{{ public_path('imagen/conciliaciones/firmaConciliadores/'.$info->firmaconciliador) }}" class="img-fluid" alt=""><br>

                        </b>
                        <b>Identificación:  {!! $info->ccconciliador !!} </b>
                    </td>
                </tr>
            </table>
        @endforeach
    </div>
</body>