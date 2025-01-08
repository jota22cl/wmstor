<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Pseguro;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PseguroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa = new Empresa;
        $EmpId=$empresa->select('id')->where('sigla','=','Storage')->get();
        //$data->empresa_id = $EmpId[0]->id;

        $data=new Pseguro; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "1.48%";
        $data->descripcion = "Prima de seguros 1.48%";
        $data->valor = 1.48;
        $data->vigente = true;
        $data->save();
    }
}
