<div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-4 mt-4">

                <div class="col-6">
                    <a href="{{ route('ventas.index') }}" class="btn" style="background-color: #22b24c; color: #ffffff;">
                        <i class="fas fa-plus" style="color: #ffffff;"></i> Agregar Venta
                    </a>

                    <a class="btn ms-2" href="{{ route('pdf.listaVentasPDF') }}" target="_blank" style="background-color: #fd3550;">
                        <i class="fas fa-file-pdf" style="color: #ffffff;"></i>
                    </a>

                    <a class="btn ms-2" href="{{ route('pdf.listaVentasExcel') }}" style="background-color: #15ca20;">
                        <i class="fas fa-file-excel" style="color: #ffffff;"></i>
                    </a>


                </div>
                <div class="col-6">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Buscar por boleta o cliente ">
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

                <td><a type="button" href="{{ route('venta.GenerarPDF',  ['boleta' => $venta->nboleta, 'numero' => 1] ) }}" target="_blank"><i class="fas fa-file-invoice-dollar fa-2x"></i>
                        </button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $ventas->links() }}
</div>