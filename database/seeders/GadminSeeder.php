<?php

namespace Database\Seeders;

use App\Models\Gadmin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=new Gadmin; 
        $data->codigo  = "10";
        $data->descripcion = "10% Gastos de Administración";
        $data->valor = 10;
        $data->vigente = true;
        $data->save();

        $data=new Gadmin; 
        $data->codigo  = "20";
        $data->descripcion = "20% Gastos de Administración";
        $data->valor = 20;
        $data->vigente = true;
        $data->save();
    }
}
