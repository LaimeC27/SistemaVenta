<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
          
            /* Ajusta el margen general */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            /* Agrega un espacio entre el título y la tabla */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            /* Ajusta el margen superior de la tabla */
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px;
            /* Reducir el espaciado interno de las celdas */
            text-align: center;
            font-size: 12px;
            /* Reduce el tamaño de la fuente */
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Documento de Identificación</th>
                <th>Cliente</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{$cliente->id}}</td>
                <td>{{$cliente->IdenficacionCliente}}</td>
                <td>{{$cliente->nombreCliente}}</td>
                <td>{{$cliente->emailCliente}}</td>
                <td>{{$cliente->telefonoCliente}}</td>
                <td>{{$cliente->direccionCliente}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>