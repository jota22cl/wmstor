<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductosTabla extends Component
{
    public $productos = []; // Propiedad pública para recibir los productos

    public function render()
    {
        // Asegúrate de que los productos estén siendo enviados a la vista
        dd("Renderizando ProductosTabla", $this->productos);
        return view('livewire.productos-tabla', [
            'productos' => $this->productos,
        ]);
    }
}

//
//namespace App\Http\Livewire;
//
//use Livewire\Component;
//
//class ProductosTabla extends Component
//{
//    public $productos = []; // Propiedad pública para recibir los productos
//
//    // Método que se ejecuta cuando se monta el componente
//    public function mount($productos)
//    {
//        // Inicializamos la propiedad productos con los datos recibidos
//        dd("por aqui pase 1");
//        $this->productos = $productos;
//    }
//    
//    public function render()
//    {
//        dd("por aqui pase 2");
//        return view('livewire.productos-tabla');
//    }
//}
//