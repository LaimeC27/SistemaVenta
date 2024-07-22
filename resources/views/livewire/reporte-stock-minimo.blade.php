<div>
    <div class="card ">
        <div class="card-body mt-4 row">
            <div class="col-3  border">
                Stock a buscar:
                <input type="number" wire:model="stockMinimo" class="form-control mt-2">

            </div>

            <div class="col-4">
                <button wire:click="buscar" class="btn btn-primary ms-2">Buscar</button>
                @if ($stockMinimo !== null)
                <a href="{{ route('generarStockMinimo.pdf', ['stockMinimo' => $stockMinimo]) }}" target="_blank" class="btn btn-danger ms-2">
                    <i class="fas fa-file-pdf " style="color: #ffffff;"></i></a>
                @else
                <a href="{{ route('generarStockMinimo.pdf') }}" target="_blank" class="btn btn-danger ms-2">
                    <i class="fas fa-file-pdf" style="color: #ffffff;"></i>
                </a>
                @endif



                @if ($stockMinimo !== null)
                <a class="btn ms-2 " href="{{ route('generar.StockMinimoExcel', ['stockMinimo' => $stockMinimo]) }}" style="background-color: #15ca20;">
                    <i class="fas fa-file-excel" style="color: #ffffff;"></i>
                </a>
                @else
                <a class="btn ms-2" href="{{ route('generar.StockMinimoExcel') }}" style="background-color: #15ca20;">
                    <i class="fas fa-file-excel" style="color: #ffffff;"></i>
                </a>
                @endif
            </div>

        </div>
    </div>



    <table class="table text-center table-striped table-hover ">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Stock Producto</th>
                <th>Stock Minimo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->descripcion }}</td>
                <td>
                    <span class="badge" style="background-color: #7266ba; font-size: 14px"> {{ $producto->stock_producto}}</span>
                </td>
                <td>
                    <span class="badge" style="background-color:red; font-size: 14px;"> {{ $producto->stockMinimo_producto}}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center ">
        {{ $productos->links() }}
    </div>
</div>