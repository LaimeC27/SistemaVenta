@extends('dashboard')
@section('contenido')
<div class="page-content">
    <div class="card">
        <div class="card-body">

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a type="button" class="nav-link " href="{{ route('productos.index') }}">Producto</a>
                    <a type="button" class="nav-link " href="{{ route('productos.create') }}">Crear</a>
                </div>
            </nav>

            @livewire('producto-crear-componente')

        </div>
    </div>

</div>



@endsection