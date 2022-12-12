<style type="text/css">
    .titleLabel{
        font-weight: bold;
        text-align: left;
    }
    .table{
        border-collapse: separate;
        border-spacing: 15px;
    }
</style>

<body style=" margin-bottom:0px; margin-top:0px;">
    <div style="position: relative; left: 680px; " >1</div>
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
            <table width="100%" border="1">
                <tbody>
                <tr>
                    <td width="40%" style="text-align: left;">CONCILIACIÓN: {!! $info->conciliadorcaso !!}</td>
                    <td width="60%" style="text-align: center;">No. SINPROC: {!! $sinproc !!} </td>
                </tr>
                <tr>
                    <td width="30%">FECHA RADICACION  :</td>
                    <td width="70%" style="text-align: center;"> {!! $info->fecsol !!} </td>
                </tr>
                <tr>
                    <td width="30%">PARTE SOLICITANTE(S)<br>(Y APODERADO SI HAY):</td>
                    <td width="70%">
                        @foreach ($arrayDatosConvocanteNatural as $infoSol)
                            <b>{!! $infoSol->datos !!}</b>
                        @endforeach
                        @foreach ($arrayDatosConvocanteOrganizacion as $infoSol)
                            <b>{!! $infoSol->datos !!}</b>
                        @endforeach
                        @foreach ($datosApoderadoConvocante as $infoSol)
                            <b>{!! $infoSol->apoderado !!}.</b>
                        @endforeach
                        <br/>
                    </td>
                </tr>
                <tr>
                    <td width="30%">PARTE SOLICITADA:</td>
                    <td width="70%">
                        @foreach ($arrayDatosConvocadosNatural as $infoSol)
                            <b>{!! $infoSol->datos !!}</b>
                        @endforeach
                        @foreach ($arrayDatosConvocadosOrganizacion as $infoSol)
                            <b>{!! $infoSol->datos !!}</b>
                        @endforeach
                        @foreach ($datosApoderadoConvocado as $infoSol)
                            <b>{!! $infoSol->apoderado !!}.</b>
                        @endforeach
                        <br/>
                    </td>
                </tr>
                <tr>
                    <td width="30%">PRETENSIÓN:</td>
                    <td width="70%"> {!! $info->pretenciones !!} </td>
                </tr>
                <tr>
                    <td width="30%">HECHOS:</td>
                    <td width="70%">{!! $info->hechos !!}</td>
                </tr>
                <tr>
                    <td width="30%">AREA:</td>
                    <td width="70%" align="justify">{!! $info->area !!}</td>
                </tr>
                <tr>
                    <td width="30%">TEMA:</td>
                    <td width="70%" align="justify">{!! $info->asunto !!}</td>
                </tr>
            </table>
            <br/>
            <table width="100%" border="1">
                <tr>
                    <td style="text-align: center;"> FECHA DE LA AUDIENCIA:{!! $info->fechasesion !!}</td>
                </tr>
            </table>
            <table width="100%" border="1">
                <tr>
                    <td width="21%" rowspan="11">ARCHIVO</td>
                    <td width="23%" rowspan="2">ACTA DE</td>
                    <td width="50%" colspan="6">CONCILIACION TOTAL</td>
                    <td width="4%">&nbsp;</td>
                </tr>
                <tr>
                    <td height="16" colspan="6">CONCILIACION  PARCIAL</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td rowspan="4">CONSTANCIA DE</td>
                    <td colspan="6">NO ACUERDO</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">INASISTENCIA DE 1 PARTE</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">INASISTENCIA DE 2 PARTE</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td height="16" colspan="6">INADMISION</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td height="16">OFICIO AL CLIENTE</td>
                    <td colspan="6">(Cuando no fue posible notificar a)</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td height="22" colspan="7">DESISTIMIENTO:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td height="22">FECHA CULMINACION</td>
                    <td colspan="6"> </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td rowspan="2">ABOGADO CONCILIADOR</td>
                    <td colspan="6" align="center" height="22">{!! $info->conciliadorcaso !!} </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td height="22" colspan="6">Vo. Bo.</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td rowspan="2">ENVIO AL ARCHIVO GENERAL:</td>
                    <td height="23">FECHA:</td>
                    <td colspan="6">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>FOLIOS:</td>
                    <td colspan="6"> </td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <br/>
        @endforeach
    </div>
</body>