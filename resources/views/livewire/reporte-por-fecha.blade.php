<div>

    <div class="card">
        <div class="card-body">
            <div class="row mt-4">
                <div class="col-md-4">
                    <label for="fechaInicio" class="form-label">Fecha de Inicio:</label>
                    <input type="date" id="fechaInicio" class="form-control" wire:model="fecha">
                    @error('fecha')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="fechaFin" class="form-label">Fecha de Fin:</label>
                    <input type="date" id="fechaFin" class="form-control" wire:model="fecha2">
                    @error('fecha2')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <button class="btn btn-primary" wire:click="buscarFechas">Buscar</button>





                    <a href="{{ route('generarPorFecha.pdf', ['fecha' => $fecha ,'fecha2'=>$fecha2]) }}" target="_blank" class="btn btn-danger ms-2">
                        <i class="fas fa-file-pdf " style="color: #ffffff;"></i>
                    </a>

                    <a class="btn ms-2" href="{{ route('generarPorFechaExcel', ['fecha' => $fecha ,'fecha2'=>$fecha2]) }}" style="background-color: #15ca20;">
                        <i class="fas fa-file-excel" style="color: #ffffff;"></i>
                    </a>

                </div>
            </div>
        </div>
    </div>




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
            @foreach($ventas as $venta)
            <tr>
                <td>
                    <span class="badge" style="background-color: #7266ba; font-size: 14px;">{{ $venta->nboleta }}</span>
                </td>
                <td>{{ $venta->cliente->nombreCliente }}</td>
                <td>{{ $venta->total }}</td>
                <td>{{ $venta->created_at->format('d-m-Y - H:i:s') }} </td>

                <td><a type="button" href="{{ route('venta.GenerarPDF', ['boleta' => $venta->nboleta, 'numero' => 1] ) }}" target="_blank"><i class="fas fa-file-invoice-dollar fa-2x"></i>
                        </button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $ventas->links() }}
</div>