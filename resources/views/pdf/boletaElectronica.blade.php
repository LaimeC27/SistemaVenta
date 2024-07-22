<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta Electrónica</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }



    div,
    p,
    table,
    th,
    td {
        font-size: 6px;
    }

    h1 {
        font-size: 8px;
    }
</style>

<body>
    <div style="text-align:center;">
        <h1 style="margin: 5px 0;">{{ $empresa->nombre_empresa }}</h1>
        <p>RUP: {{ $empresa->rup }}</p>
        <p>Teléfono: {{ $empresa->telefono }}</p>
        <p>Dirección: {{ $empresa->direccion }}</p>
        <p>Correo: {{ $empresa->correo_empresa }}</p>
    </div>
    <div style="margin: 5px  8px">
        <p><strong>Cliente:</strong> {{ $cliente->nombreCliente }}</p>
        <p><strong>Boleta:</strong> {{ $venta->nboleta }}</p>
        <p><strong>Fecha:</strong> {{ $venta->created_at->format('d-m-Y - H:i:s') }}</p>
    </div>
    <table style="margin-bottom: 5px;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th style="text-align: center;">Producto</th>
                <th style="text-align: center;">Ud</th>
                <th style="text-align: center;">Precio</th>
                <th style="text-align: center;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalle_ventas as $detalle_venta)
            <tr>
                <td style="text-align: center;">{{ $detalle_venta->producto->descripcion }}</td>
                <td style="text-align: center;">{{ $detalle_venta->cantidad }}</td>
                <td style="text-align: center;">{{ $detalle_venta->producto->precio_venta }}</td>
                <td style="text-align: center;">{{ $detalle_venta->cantidad * $detalle_venta->producto->precio_venta }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin: 8px  8px">
        <p style="margin: 3px 0 0 0;"><strong>SUBTOTAL:</strong> {{$detalle_venta->subtotal }} /S</p>
        <p style="margin: 3px 0 0 0;"><strong>I.V.A. 18%:</strong> {{ $venta->igv }} /S</p>
        <p style="margin: 3px 0 0 0;"><strong>TOTAL:</strong> {{ $venta->total }} /S</p>
    </div>
    <div style="text-align: center;">
        <p>¡Gracias por tu compra!</p>
        <p>Vuelve pronto.</p>
    </div>
</body>

</html>