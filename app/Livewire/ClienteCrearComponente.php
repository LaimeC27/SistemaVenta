<?php

namespace App\Livewire;

use App\Models\Clientes;
use Livewire\Component;
use Illuminate\Validation\Rule;

class ClienteCrearComponente extends Component
{
    public $identidad;
    public $nombre;
    public $correo;
    public $telefono;
    public $direccion;
    public $clienteid;
    public $botonVisible = false;


    public function render()
    {
        return view('livewire.cliente-crear-componente');

    }

    public function mount(){
        if(session()->has('clientes')){
            $clientes = session()->get('clientes');
            $this->clienteid=$clientes['id'];
            $this->identidad = $clientes['identidad'];
            $this->nombre = $clientes['nombre'];
            $this->correo = $clientes['correo'];
            $this->telefono = $clientes['telefono'];
            $this->direccion = $clientes['direccion'];
            session()->forget('clientes');
            $this->ocultarBoton();
        }
        
    }

    public function actualizar(){
        $cliente = Clientes::find($this->clienteid);

        $this->validate([
            'identidad' => ['required', Rule::unique('clientes', 'IndenficacionCliente')->ignore($cliente->id)],
            'nombre' => 'required',
            'correo' => 'required',
            'telefono' => 'required',
            'direccion' => 'required'
        ]); 

        $cliente->update([
            'IndenficacionCliente' => $this->identidad,
            'nombreCliente' => $this->nombre,
            'emailCliente' => $this->correo,
            'telefonoCliente' => $this->telefono,
            'direccionCliente' => $this->direccion
        ]);

        $this->dispatch('CreacionCorrecta', 'Se ha actualizado el cliente correctamente');
        $this->inicioCliente();
    }

    public function save()
    {
        $this->validate([
            'identidad' => ['required', 'unique:clientes,IndenficacionCliente'],
            'nombre' => 'required',
            'correo' => 'required',
            'telefono' => 'required',
            'direccion' => 'required'
        ]); 

       Clientes::create([
            'IndenficacionCliente' => $this->identidad,
            'nombreCliente' => $this->nombre,
            'emailCliente' => $this->correo,
            'telefonoCliente' => $this->telefono,
            'direccionCliente' => $this->direccion
        ]);

    

        $this->dispatch('CreacionCorrecta', 'Se ha creado el cliente correctamente');
        $this->inicioCliente();

    }

    public function iniciocliente(){
        return redirect()->route('clientes.index');
    }

    public function ocultarBoton()
    {
        $this->botonVisible  = true;
    }

    public function mostrarBoton()
    {
        $this->botonVisible  = false;
    }


}
