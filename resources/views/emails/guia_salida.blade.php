<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guía de Salida</title>
</head>
<body>
    @php
        //dd($GuiaSalida);
    @endphp
    <p>Estimado cliente, {{ $GuiaSalida->contrato->cliente->nombre }}</p>
    <p>Adjunto encontrará la guía de salida número {{ $GuiaSalida->numeroGuia }} generada en bodega, asociada al centro de costos de {{ $GuiaSalida->contrato->ccosto->descripcion }}.</p>
    <p>Saludos cordiales,</p>
    <p>{{ auth()->user()->empresa->sigla }}</p>
    <p></p>
    <p style="font-size: 12px;"><i><b>Nota:</b> Favor de no responder éste correo, es generado y enviado automaticamente por el sistema.</i></p>
</body>
</html>
