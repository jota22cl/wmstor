<?php

namespace Database\Seeders;

use App\Models\Ccosto;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CcostoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=new Ccosto; 
        $data->codigo  = "ADM";
        $data->descripcion = "Administracion";
        $data->vigente = true;
        $data->save();

        $data=new Ccosto; 
        $data->codigo  = "LLM";
        $data->descripcion = "Llave  en mano";
        $data->vigente = true;
        $data->save();

        $data=new Ccosto; 
        $data->codigo  = "ISP";
        $data->descripcion = "Bodegas con resolución ISP";
        $data->vigente = true;
        $data->save();

        $data=new Ccosto; 
        $data->codigo  = "FRIO";
        $data->descripcion = "Refrigerado";
        $data->vigente = true;
        $data->save();

        $data=new Ccosto; 
        $data->codigo  = "CONG";
        $data->descripcion = "Congelado";
        $data->vigente = true;
        $data->save();
    }
}
