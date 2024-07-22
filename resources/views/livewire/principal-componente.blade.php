<div>

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Productos</font>
                                    </font>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $cantidadProductos }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Ventas </font>
                                    </font><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">| </font>
                                            <font style="vertical-align: inherit;">Hoy</font>
                                        </font>
                                    </span>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>S/ {{ $totalVentasHoy }}</h6>



                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Clientes </font>
                                    </font>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$cantidadClientes}}</h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Informe Semanal</font>
                                    </font><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">/Hoy </font>
                                        </font>
                                    </span>
                                </h5>

                                <!-- Line Chart -->

                                <div><canvas id="ventasPorDiaChart"></canvas></div>

                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                <script>
                                    const ctx = document.getElementById('ventasPorDiaChart');

                                    new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: {!!$labels!!}, // Etiquetas de fechas
                                            datasets: [{
                                                label: 'Ventas por día',
                                                data: {!!$data!!}, // Datos de ventas por día
                                                backgroundColor: 'rgba(128, 0, 128)',
                                                borderColor: 'rgba(128, 0, 128,1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                </script>



                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Ventas recientes </font>
                                    </font><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">| </font>
                                            <font style="vertical-align: inherit;">Hoy</font>
                                        </font>
                                    </span>
                                </h5>

                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>Número de Boleta</th>
                                            <th>Cliente</th>
                                            <th>Total</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ventasRecientes as $venta)
                                        <tr>
                                            <td>
                                                <span class="badge" style="background-color: #7266ba; font-size: 14px;">{{ $venta->nboleta }}</span>
                                            </td>
                                            <td>{{ $venta->cliente->nombreCliente }}</td>
                                            <td>{{ $venta->total }}</td>
                                            <td>{{ $venta->created_at->format('d-m-Y - H:i:s') }} </td>

                                            <td><a type="button" href="{{ route('venta.GenerarPDF', ['boleta' => $venta->nboleta , 'numero' => 1 ]) }}" target="_blank"><i class="fas fa-file-invoice-dollar fa-2x"></i>
                                                    </button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Top Selling -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;"> 10 Stock Minimos </font>
                            </font><span>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">| </font>
                                    <font style="vertical-align: inherit;">Hoy</font>
                                </font>
                            </span>
                        </h5>

                        <div class="activity">

                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Producto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stockMinimo as $producto)
                                    <tr>
                                        <td><span class="badge" style="background-color: red; font-size: 12px;">{{$producto->stock_producto}}</span></td>
                                        <td>{{$producto->descripcion}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- End Recent Activity -->
                <!-- Budget Report -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">10 Productos mas vendidos</font>
                            </font><span>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">| </font>
                                    <font style="vertical-align: inherit;">Este mes</font>
                                </font>
                            </span>
                        </h5>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($productosMasVendidosPorMes as $venta)
                                <tr>

                                    <td>{{$venta->descripcion_producto}}</td>
                                    <td>{{$venta->precio_producto}}</td>
                                    <td><span class="badge" style="background-color:#039cfd; font-size: 12px;">{{$venta->total_cantidad}}</span></td>
                                    <td><span class="badge" style="background-color:green; font-size: 12px;">{{$venta->total_cantidad * $venta->precio_producto}} /s</span></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body pb-0">
                        <div><canvas id="CantidadTotalDatos"></canvas></div>
                        <script>
                            const datosTotal = {!! json_encode($datosTotal) !!}; // Obtener los datos totales

                            new Chart(document.getElementById('CantidadTotalDatos'), {
                                type: 'pie',
                                data: {
                                    labels: ['Productos', 'Clientes', 'Categorías', 'Ventas'],
                                    datasets: [{
                                        label: 'Total de Datos',
                                        data: [datosTotal.productos, datosTotal.clientes, datosTotal.categorias, datosTotal.ventas],
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)'
                                        ],
                                        hoverOffset: 4
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>

                    </div>
                </div>
            </div><!-- End Right side columns -->

        </div>
    </section>


</div>