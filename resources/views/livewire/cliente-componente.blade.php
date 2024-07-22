<div>
    <div class="mt-4">
        <div class="row mb-4">

            <div>
                <a href="{{ route('clientes.create') }}" class="btn mb-4" style="background-color: #22b24c; color: #ffffff;">
                    <i class="fas fa-plus" style="color: #ffffff;"></i> Agregar Cliente
                </a>
            </div>

            <div class="col-6">
                <a class="btn" href="{{ route('pdf.clientePDF') }}" target="_blank" style="background-color: #fd3550;">
                    <i class="fas fa-file-pdf" style="color: #ffffff;"></i>
                </a>

                <a class="btn " href="{{ route('pdf.clienteExcel') }}" style="background-color: #15ca20;">
                    <i class="fas fa-file-excel" style="color: #ffffff;"></i>
                </a>


            </div>
            <div class="col-6">
                <input type="text" wire:model.live="search" class="form-control" placeholder="Buscar por id, identificacion, nombre o correo">
            </div>

        </div>

        <table class="table text-center table-striped table-hover ">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Documento de Identificación</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente )
                <tr>
                    <td>
                        <span class="badge" style="background-color: #7266ba;">{{$cliente->id}}</span>
                    </td>
                    <td>{{$cliente->IdenficacionCliente}}</td>
                    <td>{{$cliente->nombreCliente}}</td>
                    <td>{{$cliente->emailCliente}}</td>
                    <td>{{$cliente->telefonoCliente}}</td>
                    <td>{{$cliente->direccionCliente}}</td>
                    <td>
                        <button wire:click="edit({{ $cliente->id }})" class="btn btn-link ms-2">
                            <i class="fas fa-edit fa-lg"></i>
                        </button>

                        <button wire:click="deleteConfirm({{ $cliente->id }})" class="btn btn-link text-danger">
                            <i class="fas fa-trash fa-lg "></i>
                        </button>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center ">
            {{ $clientes->links() }}
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