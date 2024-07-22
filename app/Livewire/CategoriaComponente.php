<?php

namespace App\Livewire;

use App\Models\Categorias;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class CategoriaComponente extends Component
{
    use WithPagination;

    public $CategoriaNombre;
    public $categoriaId;
    public $categoria;
    public $botonVisible = false;
    public $search = "";



    public function render()
    {
        $categoria = Categorias::where('nombre', 'like', '%' . $this->search . '%')
            ->orWhere('id', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')
            ->paginate(9);
        return view('livewire.categoria-componente', ['categorias' => $categoria]);
    }



    public function save()
    {
        $this->validate([
            'CategoriaNombre' => [
                'required',
                Rule::unique('Categorias', 'nombre'),
            ],
        ]);

        Categorias::create([
            'nombre' => $this->CategoriaNombre
        ]);

        $this->limpiar();
     
        $this->dispatch('CreacionCorrecta', 'Se ha creado la categoria correctamente');
    }


    public function deleteConfirm($id)
    {
        $this->categoria = $id;
        $this->dispatch('deleteConfirm');
    }

    public function delete()
    {
        Categorias::find($this->categoria)->delete();
    }

    public function edit($id)
    {
        $categoria = Categorias::find($id);
        $this->CategoriaNombre = $categoria->nombre;
        $this->categoriaId = $categoria->id;
        $this->ocultarBoton();
    }

    public function actualizar()
    {
        $categoria = Categorias::find($this->categoriaId);
        $this->validate([
            'CategoriaNombre' => [
                'required',
                Rule::unique('Categorias', 'nombre'),
            ],
        ]);
        $categoria->update(['nombre' => $this->CategoriaNombre]);
        $this->limpiar();
        $this->mostrarBoton();

        $this->dispatch('ActualizacionCorrecta', 'Se ha actualizado la categoria correctamentee');
    }

    public function limpiar()
    {
        $this->CategoriaNombre = "";
    }

    public function ocultarBoton()
    {
        $this->botonVisible  = true;
    }

    public function mostrarBoton()
    {
        $this->botonVisible  = false;
    }

    public function cancelar()
    {
        $this->limpiar();
        $this->mostrarBoton();
    }
}
