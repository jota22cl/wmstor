<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Tipoporton;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoportonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa = new Empresa;
        $EmpId=$empresa->select('id')->where('sigla','=','Storage')->get();
        //$data->empresa_id = $EmpId[0]->id;

        $data=new Tipoporton; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "Abatible 1 Hoja";
        $data->vigente = true;
        $data->save();

        $data=new Tipoporton; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "Abatible 2 Hoja2";
        $data->vigente = true;
        $data->save();

        $data=new Tipoporton; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "Corredera 1 Hoja";
        $data->vigente = true;
        $data->save();

        $data=new Tipoporton; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "Corredera 2 Hojas";
        $data->vigente = true;
        $data->save();

        $data=new Tipoporton; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "Cortina";
        $data->vigente = true;
        $data->save();
    }
}
