<?php

namespace App\Livewire;

use Livewire\Component;

class GuiaSalida extends Component
{
    public $guiadetalles = []; // Inicializa la propiedad como arreglo vacío

    //public function mount($model = null)
    public function mount()
    {
        $this->guiadetalles = []; // Si hay datos iniciales, cárgalos aquí
    }

    //public function render()
    //{
    //    return view('livewire.guia-salida');
    //}
}
