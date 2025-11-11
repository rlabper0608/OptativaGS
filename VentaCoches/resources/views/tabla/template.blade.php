<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Coches</title>
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Listado de Coches en Venta</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio (€)</th>
                    <th>Año</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coches as $coche)
                <tr>
                    <td>{{ $coche->id }}</td>
                    <td>{{ $coche->marca }}</td>
                    <td>{{ $coche->modelo }}</td>
                    <td>{{ number_format($coche->precio, 2, ',', '.') }}</td>
                    <td>{{ $coche->year }}</td>
                </tr>
                @endforeach
            
            </tbody>
        </table>
    </div>
</body>
</html>
