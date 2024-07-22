<div>
    <div wire:poll.1s class="container-fluid " >
        <div class="row vh-100">
            <!-- Columna de productos -->
            <div class="col-12 lg:p-4 col-lg-8  overflow-auto"  >
                <div class="row mb-4">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" wire:model.live="search" class="form-control" placeholder="Buscar por código o descripción">
                        </div>
                    </div>
                </div>

                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">
                    @foreach ($productos as $producto)
                    <div class="col">
                        <div class="bg-white h-100 shadow-sm producto-card" 
                        wire:click="agregarProducto({{ $producto->id }})" style="border-radius:12px; cursor: pointer;">
                            <div class="position-relative">
                                <img src="{{ asset('storage/imagenes/'.$producto->imagenProducto) }}" 
                                class="card-img-top " alt="Imagen del producto">
                                <span class="position-absolute top-0 end-0 badge rounded-pill bg-danger m-2">
                                    {{ $producto->stock_producto }}
                                </span>
                            </div>
                            <div class=" d-flex flex-column" style="margin: 0 0 10px 10px">
                                <span class=" ">{{ $producto->descripcion }}</span>
                                <p class="card-text text-primary fw-bold mb-0">${{ $producto->precio_venta }}</p>
                      
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $productos->links() }}
                    </div>
                </div>
            </div>

            <!-- Columna de venta -->
            <div class="col-12 col-lg-4 p-4 bg-white shadow-sm">
                <div class="mb-4 text-center">
                    <h4 class="fw-bold text-primary">Venta #{{ str_pad($ultimaVenta ? intval($ultimaVenta->nboleta) + 1 : 1, 7, "0", STR_PAD_LEFT) }}</h4>
                </div>

                <div class="mb-4">
                    <h5 class="card-title mb-3">Datos del Cliente</h5>
                    <div wire:ignore style="border: 2px solid rgb(44, 43, 43); border-radius: 6px">
                        <select wire:model="cliente" class="form-select" id="idCliente">
                            <option selected>Selecciona Cliente</option>
                            @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombreCliente }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('cliente')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="table-responsive mb-4" style="max-height: 300px;">
                    <table class="table table-sm table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cant.</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productosSeleccionados as $producto)
                            <tr>
                                <td>{{$producto['descripcion']}}</td>
                                <td>${{$producto['precio_venta']}}</td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <button class="btn btn-outline-secondary" type="button" wire:click="decrementarCantidad({{$producto['id']}})">-</button>
                                        <input class="form-control text-center" min="0" disabled type="number" wire:model="productosSeleccionados.{{$producto['id']}}.cantidad">
                                        <button class="btn btn-outline-secondary" type="button" wire:click="incrementarCantidad({{$producto['id']}})">+</button>
                                    </div>
                                </td>
                                <td>${{$producto['precio_venta'] * ($producto['cantidad'] !== '' ? $producto['cantidad'] : 1)}}</td>
                                <td>
                                    <button wire:click="eliminarProducto({{$producto['id']}})" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mb-4">
                    <label for="efectivoRecibido" class="form-label">Efectivo recibido:</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input wire:model="efectivoRecibido" type="text" class="form-control" id="efectivoRecibido" wire:keyup="calcularTotal">
                    </div>
                </div>

                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <?php $totales = $this->calcularTotal(); ?>
                        <p class="d-flex justify-content-between mb-2"><span>Subtotal:</span> <strong>${{$totales['montoTotal']}}</strong></p>
                        <p class="d-flex justify-content-between mb-2"><span>IGV (18%):</span> <strong>${{$totales['igv']}}</strong></p>
                        <p class="d-flex justify-content-between mb-2"><span>Total:</span> <strong class="text-primary">${{$totales['total']}}</strong></p>
                        <p class="d-flex justify-content-between mb-2"><span>Vuelto:</span> <strong class="text-success">${{$totales['vuelto']}}</strong></p>
                        <p class="d-flex justify-content-between mb-0"><span>Falta:</span> <strong class="text-danger">${{$totales['falta']}}</strong></p>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button wire:click="registrarVenta" class="btn btn-primary btn-lg" id="btn-registrar-venta">
                        <i class="fas fa-check-circle me-2"></i>Realizar Venta
                    </button>
                    <button wire:click="CancelarBoleta" class="btn btn-outline-secondary">
                        <i class="fas fa-times-circle me-2"></i>Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .producto-card {
            transition: all 0.3s ease;
        }
        .producto-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
        }
        .producto-img {
            height: 150px;
            object-fit: cover;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#idCliente').select2({
                theme: "bootstrap-5"
            });
            $('#idCliente').on('change', function(e) {
                let data = $('#idCliente').select2("val");
                @this.set('cliente', data);
            });
        });

        window.addEventListener('clienteUpdated', () => {
            console.log('clienteUpdated event received');
            $('#idCliente').val(null).trigger('change');
        });

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('boletaGenerada', (data) => {
                console.log('Evento boletaGenerada recibido', data);
                
                fetch(data.url)
                    .then(response => response.blob())
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = url;
                        a.download = 'boleta.pdf';
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                    })
                    .catch(error => console.error('Error al descargar el PDF:', error));
            });
        });
    </script>
</div>
