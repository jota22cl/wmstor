<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Unimedida;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnidadmedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa = new Empresa;
        $EmpId=$empresa->select('id')->where('sigla','=','Storage')->get();
        //$data->empresa_id = $EmpId[0]->id;

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "UN";
        $data->descripcion  = "Unidad";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "CJ";
        $data->descripcion  = "Caja";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "PLL";
        $data->descripcion  = "Pallet";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "SC";
        $data->descripcion  = "Saco";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "BUL";
        $data->descripcion  = "Bulto";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "BINS";
        $data->descripcion  = "Bins";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "MT";
        $data->descripcion  = "Metro";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "KG";
        $data->descripcion  = "Kilogramo";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "TN";
        $data->descripcion  = "Tonelada";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "HR";
        $data->descripcion  = "Hora";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "MIN";
        $data->descripcion  = "Minuto";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "KW";
        $data->descripcion  = "Kilo Watt";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "MT3";
        $data->descripcion  = "Metro Cubico";
        $data->vigente = true;
        $data->save();

        $data=new Unimedida; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "CONT";
        $data->descripcion  = "Contenedor";
        $data->vigente = true;
        $data->save();

    }
}
