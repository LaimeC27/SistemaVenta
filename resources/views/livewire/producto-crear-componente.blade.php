<div>

    <div class="mt-4">

        <form wire:submit.prevent enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">

                    <div class="form-group">
                        <label for="descripcion">codigo:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-file-alt"></i>
                            </span>
                            <input wire:model="codigo" type="text" class="form-control" placeholder="Ingrese el codigo" aria-label="codigo" aria-describedby="basic-addon1" id="codigo">
                        </div>
                        <div class="mt-2">
                            @error('codigo')
                            <small>
                                <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <label for="idCategoria" class="form-label">Categoría:</label>
                        <div class="input-group" wire:ignore>

                            <select wire:model="categoria" style="width: 100%" class="form-select" aria-label="Categoría" id="idCategoria">
                                <option selected>Selecciona una categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-2">
                            @error('categoria')
                            <small>
                                <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-file-alt"></i>
                            </span>
                            <input wire:model="descripcion" type="text" class="form-control" id="descripcion" placeholder="Ingrese la Descripción" aria-label="Descripción" aria-describedby="basic-addon1">
                        </div>
                        <div class="mt-2">
                            @error('descripcion')
                            <small>
                                <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="precioCompra">Precio de Compra:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            <input wire:model="precioCompra" type="text" class="form-control" id="precioCompra" placeholder="Ingrese el Precio de Compra" aria-label="Precio de Compra" aria-describedby="basic-addon1">

                        </div>
                    </div>
                    <div class="mt-2">
                        @error('precioCompra')
                        <small>
                            <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                        </small>
                        @enderror
                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label for="precioVenta">Precio de Venta:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            <input wire:model="precioVenta" type="text" class="form-control" id="precioVenta" placeholder="Ingrese el Precio de Venta" aria-label="Precio de Venta" aria-describedby="basic-addon1">
                        </div>
                        <div class="mt-2">
                            @error('precioVenta')
                            <small>
                                <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stockProducto">Stock Producto:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-cubes"></i>
                            </span>
                            <input wire:model="stockProducto" type="text" class="form-control" id="stockProducto" placeholder="Ingrese el Stock del Producto" aria-label="Stock Producto" aria-describedby="basic-addon1">
                        </div>
                        <div>
                            @error('stockProducto')
                            <small>
                                <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stockMinimo">Stock Mínimo Producto:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-cube"></i>
                            </span>
                            <input wire:model="stockMinimo" type="text" class="form-control" id="stockMinimo" placeholder="Ingrese el Stock Mínimo del Producto" aria-label="Stock Mínimo Producto" aria-describedby="basic-addon1">
                        </div>
                        <div>
                            @error('stockMinimo')
                            <small>
                                <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="imagen">Imagen:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-image"></i>
                            </span>
                            <input wire:model="imagenProducto" type="file" class="form-control" aria-describedby="basic-addon1" id="imagen-input">
                        </div>
                        @error('imagenProducto')
                        <small>
                            <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                        </small>
                        @enderror
                    </div>

                    <div>
                        <div id="imagen-preview" class="mt-2" style="max-width: 200px;">
                            <img src="" alt="Vista previa" style="width: 100%; display: none;">
                        </div>

                        @if ($imagenProducto)

                        @if ($imagenProducto instanceof \Illuminate\Http\UploadedFile)
                        <img src="{{ $imagenProducto->temporaryUrl() }}" width="250" height="300">
                        @else
                        <img src="{{ $imagenProducto }}" width="250" height="300">
                        @endif
                        @endif
                    </div>

                </div>
            </div>

            <button wire:click="inicioProducto" class="btn btn-danger mt-4">Cancelar</button>

            <button type="submit" wire:click="save" class="btn btn-primary mt-4 ms-2" @if ($botonVisible) hidden @endif>Agregar</button>

            <button wire:click="actualizar" class="btn btn-primary mt-4 ms-2" @if (!$botonVisible) hidden @endif>Actualizar</button>

        </form>

    </div>

    <script>
        $(document).ready(function() {
            $('#idCategoria').select2();

            $('#idCategoria').on('change', function(e) {
                let data = $('#idCategoria').select2("val");
                @this.set('categoria', data);
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            const inputImagen = document.getElementById('imagen-input');
            const previewImagen = document.querySelector('#imagen-preview img');
    
            inputImagen.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        previewImagen.src = e.target.result;
                        previewImagen.style.display = 'block';
                    }
                    
                    reader.readAsDataURL(file);
                } else {
                    previewImagen.src = '';
                    previewImagen.style.display = 'none';
                }
            });
        });
    </script>
    
</div>