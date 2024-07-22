<?php

namespace App\Livewire;

use App\Models\Clientes;
use Livewire\Component;
use Livewire\WithPagination;

class ClienteComponente extends Component
{
    use WithPagination;

    public $identidad;
    public $nombre;
    public $correo;
    public $telefono;
    public $direccion;
    public $cliente;
    public $search = "";

    public function render()
    {
        $clientes = Clientes::where('nombreCliente', 'like', '%' . $this->search . '%')
            ->orWhere('id', 'like', '%' . $this->search . '%')
            ->orWhere('IdenficacionCliente', 'like', '%' . $this->search . '%')
            ->orWhere('emailCliente', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')
            ->paginate(8);
        return view('livewire.cliente-componente', ['clientes' => $clientes]);
    }



    public function edit($id)
    {
        $cliente = Clientes::find($id);

        session()->put('clientes', [
            'id' => $cliente->id,
            'identidad' => $cliente->IndenficacionCliente,
            'nombre' => $cliente->nombreCliente,
            'correo' => $cliente->emailCliente,
            'telefono' => $cliente->telefonoCliente,
            'direccion' => $cliente->direccionCliente
        ]);
        return redirect()->route('clientes.create');
    }

    public function deleteConfirm($id)
    {
        $this->cliente = $id;
        $this->dispatch('deleteConfirm');
    }

    public function delete()
    {
        clientes::find($this->cliente)->delete();
    }
}
