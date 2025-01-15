<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error @yield('code')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        h1 {
            font-size: 50px;
            color: #1100ff;
        }
        p {
            font-size: 20px;
        }
        a {
            color: #3498db;
            text-decoration: none;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <img src="{{ asset('images/WMStor-logo2.png') }}" alt="WMStor">
    <h3>La página solicitada no existe.</h3>
    <p align="center">(Error 404)</p>
    <a href="/">Volver al inicio</a>
</body>
</html>
