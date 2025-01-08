<?php

namespace Database\Seeders;

use App\Models\Moneda;
use App\Models\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa = new Empresa;
        $EmpId=$empresa->select('id')->where('sigla','=','Storage')->get();
        //$data->empresa_id = $EmpId[0]->id;

        $data=new Moneda; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "Peso";
        $data->simbolo = "$";
        $data->vigente = true;
        $data->save();

        $data=new Moneda; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "Dolar Americano";
        $data->simbolo = "US$";
        $data->vigente = true;
        $data->save();

        $data=new Moneda; 
        $data->empresa_id = $EmpId[0]->id;
        $data->codigo  = "Unidad de Fomento";
        $data->simbolo = "UF";
        $data->vigente = true;
        $data->save();
    }
}
