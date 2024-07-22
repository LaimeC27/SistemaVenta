<div>
    <div class="mt-4">
        <div class="row mb-4">

            <div>
                <a href="{{ route('productos.create') }}" class="btn mb-4" style="background-color: #22b24c; color: #ffffff;">
                    <i class="fas fa-plus" style="color: #ffffff;"></i> Agregar Producto
                </a>
            </div>

            <div class="col-6">
                <a class="btn" href="{{ route('pdf.productoPDF') }}" target="_blank" style="background-color: #fd3550;">
                    <i class="fas fa-file-pdf" style="color: #ffffff;"></i>
                </a>

                <a class="btn " href="{{ route('pdf.productoExcel') }}" style="background-color: #15ca20;">
                    <i class="fas fa-file-excel" style="color: #ffffff;"></i>
                </a>
                <a class="btn" href="{{ route('productos.code') }}" target="_blank" style="background-color: #212529;">
                    <i class="fas fa-barcode" style="color: #ffffff;"></i>
                </a>

            </div>
            <div class="col-6">
                <input type="text" wire:model.live="search" class="form-control" placeholder="Buscar por id, categoria, descripcion o stock">
            </div>

        </div>

        <table class="table text-center table-striped table-hover ">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Id</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td>
                        <img src="{{ asset('storage/imagenes/'.$producto->imagenProducto) }}" alt="Imagen del producto" class="rounded-circle" width="60" />
                    </td>
                    <td>
                        <span class="badge" style="background-color: #7266ba;"> {{$producto->id}}</span>
                    </td>
                    <td>{{ $producto->categorias ? $producto->categorias->nombre : 'Sin categoría' }}</td>
                    <td>{{$producto->descripcion}}</td>
                    <td>{{$producto->precio_compra}}</td>
                    <td>{{$producto->precio_venta}}</td>
                    <td>
                        <span class="badge" style="background-color: {{ $producto->stock_producto <= $producto->stockMinimo_producto ? 'red' : '#039cfd' }}">
                            {{ $producto->stock_producto }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('productos.barcode', ['id' => $producto->id]) }}" target="_blank">
                            <i class="fas fa-barcode" style="color: black;"></i>
                        </a>

                        <button wire:click="edit({{ $producto->id }})" class="btn btn-link ms-2">
                            <i class="fas fa-edit fa-lg"></i>
                        </button>

                        <button wire:click="deleteConfirm({{ $producto->id }})" class="btn btn-link text-danger">
                            <i class="fas fa-trash fa-lg "></i>
                        </button>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center ">
            {{ $productos->links() }}
        </div>
    </div>

    <script>
        window.addEventListener('deleteConfirm', () => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete');
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: "Se ha eliminado correctamente.",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });
        });
    </script>



</div>