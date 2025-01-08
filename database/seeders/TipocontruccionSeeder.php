<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;
use App\Models\Tipoconstruccion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipocontruccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa = new Empresa;
        $EmpId=$empresa->select('id')->where('sigla','=','Storage')->get();
        //$data->empresa_id = $EmpId[0]->id;

        $data=new Tipoconstruccion; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "Panel";
        $data->vigente = true;
        $data->save();

        $data=new Tipoconstruccion; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "Lata";
        $data->vigente = true;
        $data->save();

    }
}
