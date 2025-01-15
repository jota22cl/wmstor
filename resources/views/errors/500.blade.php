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
            font-size: 35px;
            color: #ff0000;
        }
        p {
            font-size: 15px;
            color: #4e97d3;
        }
        a {
            color: #0011ff;
            text-decoration: none;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <img src="{{ asset('images/WMStor-logo2.png') }}" alt="WMStor">
    <h1>¡Oops! Algo salió mal. 😓</h1>
    <p>@yield('message', 'Lo sentimos, estamos trabajando en solucionar este problema.')</p>
    <p align="center">(Error 500)</p>
    <a href="/">Volver al inicio</a>
</body>
</html>
