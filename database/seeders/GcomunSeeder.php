<?php

namespace Database\Seeders;

use App\Models\Gcomun;
use App\Models\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GcomunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa = new Empresa;
        $EmpId=$empresa->select('id')->where('sigla','=','Storage')->get();
        //$data->empresa_id = $EmpId[0]->id;

        $data=new Gcomun; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "05";
        $data->descripcion = "5% de gasto común";
        $data->valor = 5;
        $data->vigente = true;
        $data->save();

        $data=new Gcomun; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "10";
        $data->descripcion = "10% de gasto común";
        $data->valor = 10;
        $data->vigente = true;
        $data->save();

        $data=new Gcomun; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "15";
        $data->descripcion = "15% de gasto común";
        $data->valor = 15;
        $data->vigente = true;
        $data->save();

        $data=new Gcomun; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "20";
        $data->descripcion = "20% de gasto común";
        $data->valor = 20;
        $data->vigente = true;
        $data->save();

    }
}
