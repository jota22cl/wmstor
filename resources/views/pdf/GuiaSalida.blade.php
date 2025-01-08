<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guía de Salida</title>

    <!--- **************************************************************************************** --->
    <style>

        body { font-family: Arial Narrow, Normal; font-size:11; text-align: justify;}
        xxxtable { width: 100%; border-collapse: collapse; }
        yy_table { border-collapse: collapse; }
        yy_th, yy_td { padding: 1px; border: 0px solid; text-align: left; vertical-align: top;}
        @page{
            margin: 2.9cm 0.8cm 1.2cm 0.8cm;
        }
        #header{
            position: fixed;
            top: -2.2cm;
            left: 0cm;
        }
        .imgHeader{
            float: center;
            width: 3cm;
        }
        .infoHeader{
            float: right;
            /* width: 19.5cm; */
            width: 21.6cm;
        }
        #footer{
            position: fixed;
            bottom: -1cm;
            left: 0cm;
            width: 100%;
            background-color: blueviolet;
        }
        .saltoPagina{
            page-break-after: always;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            /* transform: translate(-50%, -50%) rotate(0deg); */
            opacity: 0.12;
            font-size: 150px;
            color: #000;
            z-index: -1; /* Ensure the watermark is behind the text */
        }
        .watermark img {
            width: 600px;
            height: auto;
        }
        .content {
            position: relative;
            z-index: 1;
        }

    /* INICIO DEL CONTENEDOR DE TABLAS */

    /* Contenedor general */
    .container {
        width: 100%;
        /* font-family: 'Calibri', sans-serif; /* Cambiar la fuente a Calibri */
        font-family: 'Arial', sans-serif; /* Cambiar la fuente a Calibri */
        font-size: 10px; /* Tamaño de fuente general */
    }

/*    .table-group {
/*        margin-bottom: 10px; /* Espaciado entre las tablas */
/*        position: relative; /* Asegura que los hijos se posicionen correctamente */
/*    }
    
    /* Tabla izquierda */
    .table-left {
        float: left; /* Alinear a la izquierda */
        width: 11cm; /* Ancho de la tabla izquierda */
        border: 1px solid #000; /* Borde externo */
        border-radius: 10px; /* Bordes redondeados */
        padding: 2px 2px;
        box-sizing: border-box;
        /* margin-right: 0.05cm; /* Espacio entre las tablas */
    }

    /* Tabla derecha */
    .table-right {
        float: left; /* Alinear a la derecha */
        width: 8.5cm; /* Ancho de la tabla derecha */
        border: 1px solid #000; /* Borde externo */
        border-radius: 10px; /* Bordes redondeados */
        padding: 2px;
        box-sizing: border-box;
        margin-left: 0.2cm; /* Espacio entre las tablas */
    } */

    /* Tabla derecha */
    .table-title-right {
        float: left; /* Alinear a la derecha */
        width: 5.5cm; /* Ancho de la tabla derecha */
        border: 3px solid #000; /* Borde externo */
        border-radius: 5px; /* Bordes redondeados */
        padding: 2px;
        box-sizing: border-box;
        margin-left: 0.2cm; /* Espacio entre las tablas */
    }

    .table-title {
        font-size: 10px; /* Tamaño de fuente del título */
        /* font-weight: bold; /* Negrita para destacar */
        text-align: left; /* Alineación a la izquierda */
        margin-bottom: 5px; /* Espacio entre el título y la tabla */
        margin-left: 2px; /* Alineación con el borde de la tabla */
    }

    /* Tabla desglose detalle de productos */
    .table-detalle {
        float: left; /* Alinear a la derecha */
        width: 8.5cm; /* Ancho de la tabla derecha */
        border: 1px solid #000; /* Borde externo */
        border-radius: 10px; /* Bordes redondeados */
        padding: 2px;
        box-sizing: border-box;
        margin-left: 0cm; /* Espacio entre las tablas */
    }

    /* Estilos generales de las tablas */
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 0px; /* Espaciado entre filas */
    }

    th {
        text-align: center;
        font-weight: bold;
        text-decoration: underline;
        font-size: 12px; /* Tamaño de fuente para encabezados */
    }

    td {
        padding: 2px;
        vertical-align: top;
        font-size: 10px; /* Tamaño de fuente para celdas */
    }

    .fixed-column {
        width: 150px; /* Ancho fijo de la columna */
        white-space: nowrap; /* No permitir saltos de línea */
        overflow: hidden; /* Ocultar el texto excedente */
        text-overflow: ellipsis; /* Mostrar "..." para texto truncado */
    }
    
    .celda-titulo {
        width: 2cm;
    }

    /* Asegura que el contenido no se desborde */
    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }


    /* Contenedor del cuadroPARA EL DETALLE DE PRODUCTOS */
    .main-box {
        width: 20cm; /* Ancho del cuadro */
        height: 15.5cm; /* Alto del cuadro */
        border: 1px solid black; /* Borde del cuadro */
        border-radius: 15px; /* Esquinas redondeadas */
        position: relative; /* Posicionamiento relativo para las líneas internas */
        box-sizing: border-box; /* Incluir el borde en las dimensiones */
    }

    /* Línea superior a 0.5cm desde la parte superior */
    .line-top {
        position: absolute;
        top: 0.5cm; /* Distancia desde la parte superior */
        left: 0; /* Inicia desde el borde izquierdo */
        width: 20cm; /* Ancho igual al del cuadro */
        height: 1px; /* Grosor de la línea */
        background-color: black; /* Color de la línea */
    }

    /* Línea inferior a 2cm desde la parte inferior */
    .line-bottom {
        position: absolute;
        bottom: 1.5cm; /* Distancia desde la parte inferior */
        left: 0; /* Inicia desde el borde izquierdo */
        width: 20cm; /* Ancho igual al del cuadro */
        height: 1px; /* Grosor de la línea */
        background-color: black; /* Color de la línea */
    }

    /* Línea vertical a 4cm desde la izquierda */
    .line-vertical-1 {
        position: absolute;
        top: 0; /* Inicia desde la línea superior del cuadro */
        bottom: 1.5cm; /* Termina en la línea del punto 3 */
        left: 4cm; /* Distancia desde la izquierda */
        width: 1px; /* Grosor de la línea */
        background-color: black; /* Color de la línea */
    }

    /* Línea vertical a 11.5cm de la primera */
    .line-vertical-2 {
        position: absolute;
        top: 0; /* Inicia desde la línea superior del cuadro */
        bottom: 1.5cm; /* Termina en la línea del punto 3 */
        left: 15.5cm; /*calc(4cm + 11.5cm); /* Distancia desde la izquierda (4cm + 11.5cm) */
        width: 1px; /* Grosor de la línea */
        background-color: black; /* Color de la línea */
    }

    /* Línea vertical a 2cm de la segunda */
    .line-vertical-3 {
        position: absolute;
        top: 0; /* Inicia desde la línea superior del cuadro */
        bottom: 1.5cm; /* Termina en la línea del punto 3 */
        left: 17.5cm; /*calc(4cm + 11.5cm + 2cm); /* Distancia desde la izquierda (4cm + 11.5cm + 2cm) */
        width: 1px; /* Grosor de la línea */
        background-color: black; /* Color de la línea */
    }

    /* Estilos para los textos */
    .text {
        position: absolute;
        font-size: 10pt; /* Tamaño de fuente */
        /* font-family: Arial, sans-serif; /* Familia de fuente */
        /* font-weight: bold; /* Negrita */
    }

    /* Títulos en la línea superior */
    .text-codigo {
        top: 0cm;
        left: 1cm;
    }

    .text-descripcion {
        top: 0cm;
        left: 8cm;
    }

    .text-unidad {
        top: 0cm;
        left: 15.8cm;
    }

    .text-cantidad {
        top: 0cm;
        left: 17.7cm;
    }

    /* Texto en la parte inferior */
    .text-observaciones {
        /* bottom: 1cm; */
        top: 14cm;
        left: 0.2cm;
        /* font-size: 9pt; /* Tamaño de fuente más pequeño */
        /* font-style: italic; /* Texto en cursiva */
    }
    .text-notas {
        /* bottom: 1cm; */
        top: 15.6cm;
        left: 0.2cm;
        font-size: 9pt; /* Tamaño de fuente más pequeño */
        font-family: 'HeadingNowTrial-05Medium';
        /* font-style: italic; /* Texto en cursiva */
    }

    .text-firmas {
        /* bottom: 1cm; */
        top: 23.9cm;
        left: 0cm;
        text-align: center;
        /* font-size: 9pt; /* Tamaño de fuente más pequeño */
        /* font-style: italic; /* Texto en cursiva */
        /* float: left; /* Alinear a la derecha */
        width: 20cm; /* Ancho de la tabla derecha */
        border: 1px solid #000; /* Borde externo */
        border-radius: 10px; /* Bordes redondeados */
        padding: 2px;
        box-sizing: border-box;
        margin-left: 0cm; /* Espacio entre las tablas */
    }

    .line-text-vertical-1 {
        position: absolute;
        top: 0; /* Inicia desde la línea superior del cuadro */
        bottom: 21.5cm; /* Termina en la línea del punto 3 */
        left: 39mm; /* Distancia desde la izquierda */
        width: 1px; /* width: 1px; Grosor de la línea */  
        background-color: black; /* Color de la línea */
    }

    /* Línea vertical a 11.5cm de la primera */
    .line-text-vertical-2 {
        position: absolute;
        top: 0; /* Inicia desde la línea superior del cuadro */
        bottom: 21.5cm; /* Termina en la línea del punto 3 */
        left: 78mm; /*calc(4cm + 11.5cm); /* Distancia desde la izquierda (4cm + 11.5cm) */
        width: 1px; /* Grosor de la línea */
        background-color: black; /* Color de la línea */
    }

    /* Línea vertical a 2cm de la segunda */
    .line-text-vertical-3 {
        position: absolute;
        top: 0; /* Inicia desde la línea superior del cuadro */
        bottom: 21.5cm; /* Termina en la línea del punto 3 */
        left: 117mm; /*calc(4cm + 11.5cm + 2cm); /* Distancia desde la izquierda (4cm + 11.5cm + 2cm) */
        width: 1px; /* Grosor de la línea */
        background-color: black; /* Color de la línea */
    }

    .text-firmas-digitado {
        top: 24.8cm;
        left: 02mm; 
        font-size: 8pt;
        text-align: center;
    }
    .text-firmas-autoriza {
        top: 24.8cm;
        left: 41mm; 
        font-size: 8pt;
        text-align: center;
    }
    .text-firmas-preparado {
        top: 24.8cm;
        left: 80mm; 
        font-size: 8pt;
        text-align: center;
    }
    .text-firmas-recibido {
        top: 24.2cm;
        left: 118mm; 
        font-size: 8pt;
        /* text-align: center; */
    }





    .text-pie-original-copia {
        /* bottom: 1cm; */
        top: 26.3cm;
        left: 8cm; */
        /* margin-left: 0.2cm; */
        /* margin-right: 15cm; */
        /* text-align: center; */
        /* font-size: 9pt; /* Tamaño de fuente más pequeño */
        /* font-style: italic; /* Texto en cursiva */
    }
    .text-pie-fecha-hora {
        top: 26.3cm;
        left: 0cm;
        font-size: 7pt;
    }



    /* FIN DEL CONTENEDOR DE TABLAS */

    </style>
    <!--- **************************************************************************************** --->

    <!---
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 0px solid; text-align: center; }
    </style>
    --->

</head>


<body>
    <div class="watermark">
        <img src="{{ storage_path('app/public/'.auth()->user()->empresa->directorio.'/'.$GuiaSalida->empresa->logo) }}" alt="Watermark">
    </div>

    <div id="header">
        <table>
            <tr>
                <td style="width: 1cm;">
                    <img style="text-align: center;" src="{{ storage_path('app/public/'.auth()->user()->empresa->directorio.'/'.$GuiaSalida->empresa->logo) }}" alt="Logo de la Empresa" width="100px">
                </td>
                <td style="width: 11cm; text-align: center;">
                    <div style="font-size: 15px;"><b>{{ $GuiaSalida->empresa->razonsocial }}</b><br></div>
                    <div style="font-size: 12px;">{{ $GuiaSalida->empresa->giro }}<br></div>
                    <div style="font-size: 10px;">{{ $GuiaSalida->empresa->direccion }} - {{ $GuiaSalida->empresa->comuna->nombre }} - {{ $GuiaSalida->empresa->comuna->ciudad->nombre }}<br></div>
                    <div style="font-size: 10px;">
                        <img src="{{ public_path('icons/phone.png') }}" alt="Teléfono" style="width: 12px; height: 12px; vertical-align: middle;">
                        {{ $GuiaSalida->empresa->telefono }} -
                
                        <img src="{{ public_path('icons/mail.png') }}" alt="Correo" style="width: 12px; height: 12px; vertical-align: middle;">
                        {{ $GuiaSalida->empresa->email }} -
                
                        <img src="{{ public_path('icons/web.png') }}" alt="Web" style="width: 12px; height: 12px; vertical-align: middle;">
                        {{ $GuiaSalida->empresa->pagweb }}
                        <br>
                    </div>
                </td>
                <td style="width: 0cm;">
                    &nbsp;
                </td>
                <td>
                    <div class="table-title-right">
                        <div style="font-size: 19px; text-align: center;">R.U.T.: {{ $GuiaSalida->empresa->rut }}</div>
                        <div style="font-size: 20px; text-align: center;"><b>GUÍA DE SALIDA</b></div>
                        <div style="font-size: 20px; text-align: center;"><b>N° {{ $GuiaSalida->numeroGuia }}</b></div>
                    </div>
                </td>
            </tr>
        </table>
        
        <div class="infoHeader">
            <br>
            <table>
                <tr>
                    <td style="font-size: 14px;">
                        <b>{{ $GuiaSalida->contrato->cliente->comuna->ciudad->nombre }}, 
                            {{ \Carbon\Carbon::parse($GuiaSalida->fechaGuia)->translatedFormat('d \d\e F \d\e Y') }}
                        </b>
                    </td>
                    <td style="font-size: 9px;">
                        <br>{{ $GuiaSalida->contrato->ccosto->codigo }} / {{ $GuiaSalida->contrato->bodega->codigo }}
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="container clearfix">
            <div class="table-title">
                &nbsp;IDENTIFICACIÓN CLIENTE:
                @for ($i = 0; $i < 54; $i++) &nbsp; @endfor
                IDENTIFICACIÓN SALIDA:
            </div>
            
            <!-- Tabla izquierda -->
            <div class="table-left">
                <table>
                    <tbody>
                        <tr>
                            <td class="celda-titulo">SEÑOR(ES)</td>
                            <td class="fixed-column">: <b>{{ trim(\Illuminate\Support\Str::limit($GuiaSalida->contrato->cliente->nombre, 45)) }}</b></td>
                        </tr>
                        <tr>
                            <td class="celda-titulo">DOMICILIO</td>
                            <td class="fixed-column">: <b>{{ trim(\Illuminate\Support\Str::limit($GuiaSalida->contrato->cliente->direccion, 45)) }}</b></td>
                        </tr>
                        <tr>
                            <td class="celda-titulo">COMUNA/CIUDAD</td>
                            <td>: <b>{{ $GuiaSalida->contrato->cliente->comuna->nombre }}, {{ $GuiaSalida->contrato->cliente->comuna->ciudad->nombre }}</b></td>
                        </tr>
                        <tr>
                            <td class="celda-titulo">R.U.T.</td>
                            <td>: <b>{{ $GuiaSalida->contrato->cliente->rut }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Tabla derecha -->
            <div class="table-right">
                <table>
                    <tbody>
                        <tr>
                            <td class="celda-titulo">TRANSPORTE</td>
                            <td>: 
                                @if ($GuiaSalida->empresatransporte)
                                    <b>{{ $GuiaSalida->empresatransporte }}</b>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="celda-titulo">PATENTE</td>
                            <td>: 
                                @if ($GuiaSalida->patente)
                                    <b>{{ $GuiaSalida->patente }}</b>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="celda-titulo">CHOFER</td>
                            <td>: 
                                @if ($GuiaSalida->choferNombre)
                                    <b>{{ $GuiaSalida->choferNombre }}</b>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="celda-titulo">DOC.CLIENTE</td>
                            <td>: 
                                @if ($GuiaSalida->guiaCliente || $GuiaSalida->factCliente)
                                    @if ($GuiaSalida->guiaCliente)
                                        Guía <b>{{ $GuiaSalida->guiaCliente }}</b>
                                    @endif
                                    @if ($GuiaSalida->factCliente)
                                        Fact. <b>{{ $GuiaSalida->factCliente }}</b>
                                    @endif
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="container clearfix">
            <div class="table-title">
                &nbsp;HEMOS ENTREGADO LA SIGUIENTE MERCADERIA:
            </div>
            <div class="main-box">
                <div class="line-top"></div>
                <div class="line-bottom"></div>
                <div class="line-vertical-1"></div>
                <div class="line-vertical-2"></div>
                <div class="line-vertical-3"></div>
                
                <!-- Textos en la línea superior -->
                <div class="text text-codigo">CÓDIGO</div>
                <div class="text text-descripcion">DESCRIPCIÓN</div>
                <div class="text text-unidad">UN.MED.</div>
                <div class="text text-cantidad">CANTIDAD</div>
                
                <!-- aqui debe ir una tabla con el detalle de los productos (tabla "guiadetalles") -->
                <br><br>
                @php
                    $cuentaLineas = 0;
                    $sumaCantidad = 0;
                @endphp
                <table style="width: 100%; font-size: 10px;">
                    <tbody>
                        @foreach ($GuiaSalida->guiadetalles as $GuiaSalidaDetalle)
                        <tr>
                            <td>
                                <div style="white-space: nowrap;">
                                    <span style="display: inline-block; width: 4cm;">{{ $GuiaSalidaDetalle->producto->codigo }}</span>
                                    <span style="display: inline-block; width: 11.5cm;">{{ $GuiaSalidaDetalle->producto->descripcion }}</span>
                                    <span style="display: inline-block; width: 2cm;">{{ $GuiaSalidaDetalle->producto->unimed_salida->descripcion }}</span>
                                    <span style="display: inline-block; width: 2cm; text-align: right;">{{ number_format($GuiaSalidaDetalle->cantidad, 2) }}</span>
                                </div>
                            </tr>
                        @php
                            $cuentaLineas = $cuentaLineas + 1;
                            $sumaCantidad = $sumaCantidad + $GuiaSalidaDetalle->cantidad;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                <div style="width: 100%; border-collapse: collapse; font-size: 10px; text-align: center; font-weight: bold;">
                    ---------- TOTAL: {{ $cuentaLineas }} Producto(s)
                    ---------- Suma: {{ number_format($sumaCantidad,2) }} Cantidad(s)
                    ----------
                </div>
                <!-- Texto en la línea inferior -->
                <div class="text text-observaciones">
                    <u>OBSERVACIONES:</u> 
                    @if ($GuiaSalida->observacion)
                        {{ trim(\Illuminate\Support\Str::limit($GuiaSalida->observacion, 330)) }}
                    @else
                        N/A
                    @endif
                </div>
                <div class="text text-notas">
                    <b>NOTA 1: Nuestra responsabilidad cesa al salir la mercaderia de nuestra Bodega.- No se aceptan devoluciones sin conformidad previa nuestra.</b><br>
                    <b>NOTA 2: Por traslado de mercaderias en deposito, que no importa venta y no es objeto de la factura de servicios.</b>
                </div>
            </div>
        </div>

        <div class="text text-firmas">
            <div class="line-text-vertical-1"></div>
            <div class="line-text-vertical-2"></div>
            <div class="line-text-vertical-3"></div>
            <br><br><br><br>
        </div>


        <div class="text text-firmas-digitado">
            ____________________________<br>
            DIGITADO POR<br>
            {{ Str::limit($GuiaSalida->userDigitador->name, 25) }}
        </div>
        <div class="text text-firmas-autoriza">
            ____________________________<br>
            AUTORIZADO POR<br>
        </div>
        <div class="text text-firmas-preparado">
            ____________________________<br>
            PREPARADO Y REVISADO POR<br>
        </div>
        <div class="text text-firmas-recibido">
            RECIBO:<br>
            NOMBRE:___________________________ RUT:_______________________<br><br>
            FECHA: ____/____/______ FIRMA: __________________________________
        </div>


        <div class="text text-pie-original-copia">
            @if ($GuiaSalida->estado == 'd')
                ORIGINAL
            @else
                COPIA
            @endif
        </div>
        <div class="text text-pie-fecha-hora">
            {{ \Carbon\Carbon::parse($GuiaSalida->fechaEmision)->format('YmdHis') }}
        </div>

    </div>






</body>
</html>
