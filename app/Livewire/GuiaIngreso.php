<?php

namespace App\Livewire;

use Livewire\Component;

class GuiaIngreso extends Component
{
    public $guiadetalles = []; // Inicializa la propiedad como arreglo vacío

    public function mount($model = null)
    {
        // Si estás editando una guía existente, carga los detalles
        if ($model) {
            $this->guiadetalles = $model->guiadetalles->toArray(); // Relación en el modelo
        }
    }

    public function render()
    {
        return view('livewire.guia-ingreso');
    }
}
