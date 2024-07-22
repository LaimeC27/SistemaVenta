<div >


    <div class="card" >
        <div class="card-body">
            <form wire:submit.prevent>
                <div class="row mt-2">
                    <div class="col-4">
                        <h4 for="categoria" class="mb-2">Categoría:</h4>
                        <div class="input-group ">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-folder"></i></span>
                            <input wire:model="CategoriaNombre" type="text" class="form-control" placeholder="Ingrese la categoría">
                        </div>
                        <div class="mt-2">
                            @error('CategoriaNombre')
                            <strong class="text-danger ">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4 mt-2 ">
                        <div class="mt-4 d-flex">
                            <button type="submit" class="btn btn-success " wire:click="save" @if($botonVisible ) hidden @endif>Agregar</button>
                            <button type="submit" class="btn btn-primary " wire:click="actualizar;" @if(!$botonVisible ) hidden @endif>Actualizar</button>
                            <button type="submit" class="btn btn-danger ms-2" wire:click="cancelar;">Cancelar</button>

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>


    <div class="card">
        <div class="card-body mt-3">
            <div class="row">
                <div class="col-6">
                    <a class="btn" href="{{ route('pdf.categoriaPDF') }}" target="_blank" style="background-color: #fd3550;">
                        <i class="fas fa-file-pdf" style="color: #ffffff;"></i>
                    </a>

                    <a class="btn" href="{{ route('pdf.categoriaExcel') }}" style="background-color: #15ca20;">
                        <i class="fas fa-file-excel" style="color: #ffffff;"></i>
                    </a>

                </div>
                <div class="col-6">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Buscar...">
                </div>
            </div>

            <table class="table table-striped table-hover text-center mt-2">
                <thead>
                    <tr>
                        <th>N-</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                    <tr>
                        <td>
                            <span class="badge" style="background-color: #7266ba;">{{$categoria->id}}</span>
                        </td>
                        <td>{{$categoria->nombre}}</td>
                        <td>
                            <button wire:click="edit({{ $categoria->id }})" class="btn btn-link">
                                <i class="fas fa-edit fa-lg"></i>
                            </button>

                            <button wire:click="deleteConfirm({{ $categoria->id }})" class="btn btn-link text-danger ">
                                <i class="fas fa-trash fa-lg "></i>
                            </button>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="d-flex justify-content-center ">
                {{ $categorias->links() }}
            </div>
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

    <div>