<?php

namespace Database\Seeders;

use App\Models\Moneda;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=new Moneda; 
        $data->codigo  = "Peso";
        $data->simbolo = "$";
        $data->vigente = true;
        $data->save();

        $data=new Moneda; 
        $data->codigo  = "Dolar Americano";
        $data->simbolo = "US$";
        $data->vigente = true;
        $data->save();

        $data=new Moneda; 
        $data->codigo  = "Unidad de Fomento";
        $data->simbolo = "UF";
        $data->vigente = true;
        $data->save();
    }
}
