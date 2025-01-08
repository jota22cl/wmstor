<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago de Garantía</title>
    
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 0px solid; text-align: center; }

        @page{
            margin: 2.9cm 0.8cm 1.2cm 0.8cm;
        }
        #header{
            position: fixed;
            top: -2.2cm;
            left: 0cm;
        }
        .imgHeader{
            float: left;
            width: 3cm;
        }
        .infoHeader{
            float: right;
            width: 19.5cm;
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
    </style>

</head>
<body>
    <div class="watermark">
        <img src="{{ storage_path('app/public/'.auth()->user()->empresa->directorio.'/'.$contrato->empresa->logo) }}" alt="Watermark">
    </div>

    @php
        //$xxdir = 'app/public/'.auth()->user()->empresa->directorio ;
        //$xxlogo = $contrato->empresa->logo ;
        //$xxpath = 'app/public/'.auth()->user()->empresa->directorio.'/'.$contrato->empresa->logo ;
        //dd($xxdir,$xxlogo,$xxpath);
    @endphp
    <img src="{{ storage_path('app/public/'.auth()->user()->empresa->directorio.'/'.$contrato->empresa->logo) }}" alt="Logo de la Empresa" width="200px">
    <p></p>
    <h2 align='center'>RECIBO MES DE GARANTÍA</h2>
    <p></p>
    <p>MEDIANTE LA PRESENTE, <b>{{auth()->user()->empresa->sigla }}</b> RECIBE DE PARTE DE: <b><u>{{ $contrato->cliente->nombre }}</u></b>
    RUT <b>{{ $contrato->cliente->rut }}</b> LA CANTIDAD DE: <b><u>${{ number_format($contrato->garantiaMontoPago, 0) }}</u></b>
    POR CONCEPTO DE GARANTIA CORRESPONDIENTE AL ARRIENDO DEL MODULO <b><u>{{ $contrato->bodega->codigo }}</u></b>
    </p>
    <p>DICHA GARANTIA SERA DEVUELTA POR <b>{{auth()->user()->empresa->sigla }}</b> UNA VEZ QUE SE HAYAN CUMPLIDO SATISFACTORIAMENTE 
    LAS CONDICIONES ESTABLECIDAS EN EL CONTRATO.</p>
    <p></p>
    <P>OBSERVACIONES DEL PAGO: <b>{{ $contrato->garantiaObservacionPago }}</b></p>
    <p></p><p></p><p></p><p></p><p></p>
    <table>
        <tbody>
            <tr>
                <td>_________________________<br>FIRMA CLIENTE</td>
                <td>_________________________<br>FIRMA {{auth()->user()->empresa->sigla }}</td>
            </tr>
            <!-- Agrega más filas si es necesario -->
        </tbody>
    </table>
    <p></p>
    <p><b>Santiago: {{ \Carbon\Carbon::parse($contrato->garantiaFechaPago)->translatedFormat('d \d\e F \d\e Y') }}</b></p>
    <p></p>
</body>
</html>
