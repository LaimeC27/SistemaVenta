<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Stock Mínimo</title>
    <style>
        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;

        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }
    </style>
</head>

<body>
  
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Stock Producto</th>
                <th>Stock Mínimo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->stock_producto }}</td>
                <td>{{ $producto->stockMinimo_producto }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>