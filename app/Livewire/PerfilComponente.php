<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\empresaDatos;

class PerfilComponente extends Component
{

    public $nombre;
    public $correo;

    public $nombreEmpresa;
    public $direccion;
    public $telefono;
    public $rup;
    public $correoEmpresa;


    public function mount()
    {
        $empresa = empresaDatos::first();
        $this->nombreEmpresa = $empresa->nombre_empresa;
        $this->direccion = $empresa->direccion;
        $this->telefono = $empresa->telefono;
        $this->rup = $empresa->rup;
        $this->correoEmpresa = $empresa->correo_empresa;
    }

    public function render()
    {

        return view('livewire.perfil-componente');
    }

    public function actualizarEmpresa()
    {
        $empresa = empresaDatos::first();
        $empresa->nombre_empresa = $this->nombreEmpresa;
        $empresa->direccion = $this->direccion;
        $empresa->telefono = $this->telefono;
        $empresa->rup = $this->rup;
        $empresa->correo_empresa = $this->correoEmpresa;
        $empresa->save();
        redirect()->route('principal.index');
    }
}
