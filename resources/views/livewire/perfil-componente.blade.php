<div class="container">
    <div class="row">
        <!-- Columna para el perfil y contraseña -->
        <div class="col-md-6">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="mb-6">

                    @livewire('profile.update-profile-information-form')
                </div>
                <div>
                    @livewire('profile.update-password-form')
                </div>
            </div>
        </div>

        <!-- Columna para los datos de la empresa -->
        <div class="col-md-6">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Datos de la Empresa</h2>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent>
                            <div class="mb-3">
                                <label for="nombreEmpresa" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombreEmpresa" wire:model="nombreEmpresa">
                            </div>
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección:</label>
                                <input type="text" class="form-control" id="direccion" wire:model="direccion">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" id="telefono" wire:model="telefono">
                            </div>
                            <div class="mb-3">
                                <label for="rup" class="form-label">RUP:</label>
                                <input type="text" class="form-control" id="rup" wire:model="rup">
                            </div>
                            <div class="mb-3">
                                <label for="correoEmpresa" class="form-label">Correo:</label>
                                <input type="text" class="form-control" id="correoEmpresa" wire:model="correoEmpresa">
                            </div>
                            <button class="btn btn-primary" wire:click="actualizarEmpresa">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>