<style type="text/css">
    .table{
        border-collapse: separate;
        border-spacing: 1px;
        font-size:14px;
    }
</style>

<body style="margin-bottom:0px; margin-top:0px; font-size: 14px;">

<div class="container"><br>
    <div class="contentTabla">
        @foreach ($datosDelConflicto as $info)
            <table width="100%" class="table">
                <tbody>
                <tr>
                    <td>
                        <img src="{{ public_path('imagen/logo.png') }}" class="img-fluid" alt=""><br>
                    </td>
                    <td colspan="2" style="text-align:left;" >
                        <div style="text-align:center; color:#000000;"><br>
                            <font size=2><b> PERSONERÍA DE BOGOTÁ D.C. CENTRO DE CONCILIACIÓN</b><br/><b>Autorizado Resolución 2449 del 24 de diciembre de 2003<br/>Ministerio del Interior y de Justicia<br/>Código No. 3186</b><br/></font>
                        </div>
                    </td>
                </tr>
                <tr> <td> <br>Bogotá D.C {!! $fechaActual !!}</td> </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">
                        Señor(a):<br>
                        @foreach ($datosBasicosConvocado as $infoCon)
                            <b>{!! $infoCon->convocadonombre !!}</b><br><br>
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <td colspan="3" style="text-align: center;">
                        ASUNTO: UNICA CITACIÓN AUDIENCIA DE CONCILIACIÓN EXTRAJUDICIAL<br>
                        Solicitud de Conciliación <b>No. {!! $info->numreg !!} el {!! $info->fecsolicitud !!}</b>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: justify;" colspan="3">
                        Respetado Señor(a)<br><br>
                        Mediante petición radicada en la fecha indicada en el asunto,
                        el(a) Sr(a) <b>
                            @foreach ($arrayDatosConvocanteNatural as $infoCon)
                                <b>{!! $infoCon->datos !!}</b>&nbsp;
                            @endforeach
                            @foreach ($arrayDatosConvocanteOrganizacion as $infoCon)
                                <b>{!! $infoCon->datosorg !!}</b>&nbsp;
                            @endforeach
                        </b> presento(aron) una solicitud con el fin de celebrar una audiencia de conciliación,
                        cuyo objeto es llegar a un acuerdo prejudicial o en su defecto
                        agotar requisito de procedibilidad, para resolver sobre:
                        <b>"{!! $info->pretensiones !!}"</b>.<br><br>

                        Conforme a lo anterior lo invitamos a comparecer el día <b>{!! $info->fecaudi !!}
                        </b>, en nuestra sede ubicada en la {!! $info->direc !!}.
                        Podrá asistir con su apoderado, si lo considera necesario.
                        <b>Favor presentarse quince (15) minutos antes de la hora de la audiencia</b>.<br><br>
                        Se le advierte que su inasistencia a esta diligencia da lugar a las sanciones
                        jurídicas y pecuniarias dispuestas en los
                        artículos 22 y 35 (parágrafo) de la Ley 640 de 2001, así: La inasistencia podrá ser
                        considerada como indicio grave
                        en contra de sus pretensiones o de sus excepciones de mérito en un eventual proceso
                        judicial que verse sobre los mismos hechos. La sanción pecuniaria consiste en multa
                        equivalente hasta por valor de dos (2) salarios mínimos
                        legales mensuales vigentes.<br><br>
                        En caso de no comparecer, deberá justificar su inasistencia dentro de los <b>
                            tres (3) días hábiles</b> siguientes a la fecha
                        fijada para la celebración de la audiencia. Se procederá a expedir la
                        constancia prevista en el Art.2 Num.2 de la ley
                        640 del 2001.
                        Para presentarse a la audiencia de conciliación debe traer:<br><br>
                        1. Cédula de ciudadanía en original.<br>
                        2. La presente citación.<br>
                        3. Si asiste como Representante Legal de persona jurídica, deberá aportar la
                        documentación que lo acredite como tal y lo faculte para conciliar.<br>
                        4. En los casos previstos en el parágrafo 2 del artículo 1° de la Ley 640 de 2001,
                        Las partes deberán asistir personalmente a la audiencia de conciliación y
                        podrán hacerlo junto con su apoderado. En aquellos eventos en los
                        que el domicilio de alguna de las partes no esté en el municipio del lugar donde se
                        vaya a celebrar la audiencia o alguna de ellas se encuentre por fuera del territorio
                        nacional, la audiencia de conciliación podrá celebrarse con la
                        comparecencia de su apoderado debidamente facultado para conciliar, aun sin la
                        asistencia de su representado. Aportará los documentos que lo acrediten como tal
                        (PODER CON PRESENTACION PERSONAL).<br>
                        5. Todos los documentos que considere necesarios de acuerdo con el conflicto a tratar.<br><br>
                        Finalmente le informamos que este servicio es <b>TOTALMENTE GRATUITO</b> y que la
                        solicitud de conciliación presentada por el citante y los anexos se encuentran a su
                        disposición en el Despacho para su consulta.<br><br>
                        <b>Atentamente:</b><br>
                    </td>
                </tr>
                <tr>
                    <td style="position: relative; top: -27px; left: 52px; text-align: left;">
                        <b>
                            @foreach ($datosConciliador as $infoCon)
                                <b>{!! $infoCon->conciliador !!}</b>
                            @endforeach
                            <br> Abogado Conciliador
                        </b>
                    </td>
                    <td colspan="2" style="text-align: right;">
                        <img src="{{ public_path('imagen/conciliaciones/sedes/Comprometo.png') }}" width="300" height="65">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center;">
                        <br><br> <img src="{{ public_path('imagen/conciliaciones/sedes/'.$imgSede.'') }}" height="15"><br>
                    </td>
                </tr>
                </tbody>
            </table>
        @endforeach
    </div>
</div>

</body>