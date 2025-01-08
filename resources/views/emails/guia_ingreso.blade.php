<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guía de Ingreso</title>
</head>
<body>
    @php
        //dd($GuiaIngreso);
    @endphp
    <p>Estimado cliente, {{ $GuiaIngreso->contrato->cliente->nombre }}</p>
    <p>Adjunto encontrará la guía de ingreso número {{ $GuiaIngreso->numeroGuia }} generada en bodega, asociada al centro de costos de {{ $GuiaIngreso->contrato->ccosto->descripcion }}.</p>
    <p>Saludos cordiales,</p>
    <p>{{ auth()->user()->empresa->sigla }}</p>
    <p></p>
    <p style="font-size: 12px;"><i><b>Nota:</b> Favor de no responder éste correo, es generado y enviado automaticamente por el sistema.</i></p>
</body>
</html>
