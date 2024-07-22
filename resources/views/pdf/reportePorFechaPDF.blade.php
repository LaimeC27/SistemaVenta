<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #dddddd;
            padding: 5px;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        table td {
            text-align: center;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Número de Boleta</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->nboleta }}</td>
                <td>{{ $venta->cliente->nombreCliente }}</td>
                <td>{{ $venta->total }}</td>
                <td>{{ $venta->created_at->format('d-m-Y - H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>