<?php

namespace Database\Seeders;

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
        $data=new Pseguro; 
        $data->codigo  = "1.48%";
        $data->descripcion = "Prima de seguros 1.48%";
        $data->valor = 1.48;
        $data->vigente = true;
        $data->save();
    }
}
