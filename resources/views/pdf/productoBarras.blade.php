<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Reporte Codigo Barras</title>
</head>

<body>
    @if (isset($barcode)) <!-- Verificar si se proporciona un único código de barras -->
    <div>
        <p>ID: {{ $producto->id }}</p>
        <p>Código de Producto: {{ $producto->codigoProducto }}</p>
        <p>Categoría: {{ $producto->categorias->nombre }}</p>
        <p>Descripción: {{ $producto->descripcion }}</p>
        <p>Precio Venta: {{ $producto->precio_venta }}</p>
        <p>Código de Barras:</p>
        {!! $barcode !!}
    </div>
    @endif

    @if (isset($barcodes)) <!-- Verificar si se proporciona un array de códigos de barras -->

    @foreach ($barcodes as $productoData)

    <p style="margin-top: 20px;">Código de Barras: {{ $productoData['producto']->codigoProducto }} </p>

    {!! $productoData['barcode'] !!}

    @endforeach

    @endif



</body>

</html>