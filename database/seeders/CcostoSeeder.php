<?php

namespace Database\Seeders;

use App\Models\Ccosto;
use App\Models\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CcostoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa = new Empresa;
        $EmpId=$empresa->select('id')->where('sigla','=','Storage')->get();
        //$data->empresa_id = $EmpId[0]->id;

        $data=new Ccosto; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "ADM";
        $data->descripcion = "Administracion";
        $data->vigente = true;
        $data->save();

        $data=new Ccosto; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "LLM";
        $data->descripcion = "Llave  en mano";
        $data->vigente = true;
        $data->save();

        $data=new Ccosto; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "ISP";
        $data->descripcion = "Bodegas con resolución ISP";
        $data->vigente = true;
        $data->save();

        $data=new Ccosto; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "FRIO";
        $data->descripcion = "Refrigerado";
        $data->vigente = true;
        $data->save();

        $data=new Ccosto; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "CONG";
        $data->descripcion = "Congelado";
        $data->vigente = true;
        $data->save();
    }
}
