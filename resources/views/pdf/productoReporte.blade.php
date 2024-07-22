<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;

        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;

        }

        th,
        td {
            border: 1px solid #ddd;
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
                <th>ID</th>
                <th>Código Producto</th>
                <th>Descripción</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Stock Producto</th>
                <th>Stock Mínimo </th>
            </tr>
        </thead>
        <tbody>

            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->codigoProducto }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->precio_compra }}</td>
                <td>{{ $producto->precio_venta }}</td>
                <td>{{ $producto->stock_producto }}</td>
                <td>{{ $producto->stockMinimo_producto }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>