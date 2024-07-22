<div>

    <div class="mt-4">

        <form wire:submit.prevent>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="identidad">Identidad:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-id-card"></i>
                            </span>
                            <input wire:model="identidad" type="text" class="form-control" id="identidad" placeholder="Ingrese la Identidad" aria-label="Identidad" aria-describedby="basic-addon1">
                        </div>
                        @error('identidad')
                        <small>
                            <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese el Nombre" aria-label="Nombre" aria-describedby="basic-addon1">
                        </div>
                        @error('nombre')
                        <small>
                            <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input wire:model="correo" type="text" class="form-control" id="correo" placeholder="Ingrese el Correo" aria-label="Correo" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    @error('correo')
                    <small>
                        <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                    </small>
                    @enderror
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </span>
                            <input wire:model="telefono" type="text" class="form-control" id="telefono" placeholder="Ingrese el Teléfono" aria-label="Teléfono" aria-describedby="basic-addon1">
                        </div>
                        @error('telefono')
                        <small>
                            <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <input wire:model="direccion" type="text" class="form-control" id="direccion" placeholder="Ingrese la Dirección" aria-label="Dirección" aria-describedby="basic-addon1">
                        </div>
                        @error('direccion')
                        <small>
                            <strong class="text-danger" style="position: relative; top:-10px">{{$message}}</strong>
                        </small>
                        @enderror
                    </div>
                </div>
            </div>

            <button wire:click="iniciocliente" class="btn btn-danger mt-4">Cancelar</button>
            
            <button wire:click="save" class="btn btn-primary mt-4 ms-2" @if ($botonVisible)
                hidden @endif>Agregar</button>

            <button wire:click="actualizar" class="btn btn-primary mt-4 ms-2" @if (!$botonVisible)
                hidden @endif>Actualizar</button>

        </form>

    </div>


</div>