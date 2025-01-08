<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago de Garantía</title>

    <style>
        body { font-family: Arial Narrow, Normal; font-size:11; text-align: justify; }
        .clearfix::after { content: ""; display: table; clear: both; }
        @page { margin: 2.9cm 0.8cm 1.2cm 0.8cm; }

        /* Header */
        #header { position: fixed; top: -2.2cm; left: 0cm; }
        .imgHeader { float: left; width: 3cm; }
        .infoHeader { float: right; width: 19.5cm; }

        /* Footer */
        #footer { position: fixed; bottom: -1cm; left: 0cm; width: 100%; }

        /* Tablas generales */
        .table-container { width: 100%; }
        .table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        .table th { text-align: center; font-size: 12px; text-decoration: underline; }
        .table td { padding: 5px; font-size: 10px; }
        .celda-titulo { width: 2cm; }

        /* Detalle */
        .main-box { width: 20cm; height: 15cm; border: 1px solid black; border-radius: 15px; position: relative; }
        .line-top { position: absolute; top: 0.5cm; left: 0; width: 20cm; height: 1px; background-color: black; }
        .line-bottom { position: absolute; bottom: 2cm; left: 0; width: 20cm; height: 1px; background-color: black; }
        .line-vertical-1 { position: absolute; top: 0; bottom: 2cm; left: 4cm; width: 1px; background-color: black; }
        .line-vertical-2 { position: absolute; top: 0; bottom: 2cm; left: 15.5cm; width: 1px; background-color: black; }
        .line-vertical-3 { position: absolute; top: 0; bottom: 2cm; left: 17.5cm; width: 1px; background-color: black; }

        /* Textos */
        .text { position: absolute; font-size: 10px; }
        .text-codigo { top: 0.2cm; left: 1cm; }
        .text-descripcion { top: 0.2cm; left: 8cm; }
        .text-unidad { top: 0.2cm; left: 15.8cm; }
        .text-cantidad { top: 0.2cm; left: 17.7cm; }
        .text-observaciones { bottom: 1.5cm; left: 0.2cm; }

        /* Encabezados de tablas */
        .table-left-title, .table-right-title {
            font-weight: bold;
            text-align: center;
            margin-top: -12px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <!-- Watermark -->
    <div class="watermark">
        <img src="{{ storage_path('app/public/'.$GuiaIngreso->empresa->logo) }}" alt="Watermark">
    </div>

    <!-- Header -->
    <div id="header">
        <img class="imgHeader" src="{{ storage_path('app/public/'.$GuiaIngreso->empresa->logo) }}" alt="Logo de la Empresa" width="100px">
        <div class="infoHeader">
            <p align="right">{{ $GuiaIngreso->contrato->ccosto->codigo }}<br>
                {{ $GuiaIngreso->contrato->bodega->codigo }}</p>
        </div>
        <div class="infoHeader">
            <h1 align='center'>GUÍA DE INGRESO #{{ $GuiaIngreso->numeroGuia }}</h1>
        </div>
    </div>

    <!-- Tablas -->
    <div class="table-container clearfix">
        <!-- Tabla izquierda -->
        <div class="table-left">
            <div class="table-left-title">IDENTIFICACIÓN CLIENTE</div>
            <table class="table">
                <tbody>
                    <tr><td class="celda-titulo">SEÑOR(ES)</td><td>: <b>{{ $GuiaIngreso->contrato->cliente->nombre }}</b></td></tr>
                    <tr><td class="celda-titulo">DOMICILIO</td><td>: <b>{{ $GuiaIngreso->contrato->cliente->direccion }}</b></td></tr>
                    <tr><td class="celda-titulo">COMUNA/CIUDAD</td><td>: <b>{{ $GuiaIngreso->contrato->cliente->comuna->nombre }}, {{ $GuiaIngreso->contrato->cliente->comuna->ciudad->nombre }}</b></td></tr>
                    <tr><td class="celda-titulo">R.U.T.</td><td>: <b>{{ $GuiaIngreso->contrato->cliente->rut }}</b></td></tr>
                </tbody>
            </table>
        </div>
        <!-- Tabla derecha -->
        <div class="table-right">
            <div class="table-right-title">IDENTIFICACIÓN INGRESO</div>
            <table class="table">
                <tbody>
                    <tr><td class="celda-titulo">TRANSPORTE</td><td>: <b>{{ $GuiaIngreso->empresatransporte }}</b></td></tr>
                    <tr><td class="celda-titulo">PATENTE</td><td>: <b>{{ $GuiaIngreso->patente }}</b></td></tr>
                    <tr><td class="celda-titulo">CHOFER</td><td>: <b>{{ $GuiaIngreso->choferNombre }}</b></td></tr>
                    <tr>
                        <td class="celda-titulo">DOC.CLIENTE</td>
                        <td>: 
                            @if ($GuiaIngreso->guiaCliente) Guía <b>{{ $GuiaIngreso->guiaCliente }}</b> @endif
                            @if ($GuiaIngreso->factCliente) Fact. <b>{{ $GuiaIngreso->factCliente }}</b> @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Detalle -->
    <div class="main-box">
        <div class="line-top"></div>
        <div class="line-bottom"></div>
        <div class="line-vertical-1"></div>
        <div class="line-vertical-2"></div>
        <div class="line-vertical-3"></div>

        <!-- Títulos -->
        <div class="text text-codigo">CÓDIGO</div>
        <div class="text text-descripcion">DESCRIPCIÓN</div>
        <div class="text text-unidad">UN.MED.</div>
        <div class="text text-cantidad">CANTIDAD</div>

        <!-- Detalle de productos -->
        <table style="margin-top: 1cm; margin-left: 0.5cm; width: 19cm;">
<!--
            @ foreach ($GuiaIngreso->detalle as $detalle)
            <tr>
                <td style="width: 4cm;">{ { $detalle->codigo }}</td>
                <td style="width: 11.5cm;">{ { $detalle->descripcion }}</td>
                <td style="width: 2cm;">{ { $detalle->unidad }}</td>
                <td style="width: 2cm; text-align: right;">{ { $detalle->cantidad }}</td>
            </tr>
            @ endforeach
-->
        </table>

        <!-- Observaciones -->
        <div class="text text-observaciones">OBSERVACIONES: {{ $GuiaIngreso->observacion }}</div>
    </div>
</body>
</html>
