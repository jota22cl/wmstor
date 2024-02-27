<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=new Region; $data->codigo = "I REG"; $data->nombre = "I Región de Tarapaca"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "II REG"; $data->nombre = "II Región de Antofagasta"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "III REG"; $data->nombre = "III Región de Atacama"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "IV REG"; $data->nombre = "IV Región de Coquimbo"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "V REG"; $data->nombre = "V región de Valparaiso"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "VI REG"; $data->nombre = "VI Región del Libertador General Bernardo O’higgins"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "VII REG"; $data->nombre = "VII Región del Maule"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "VIII REG"; $data->nombre = "VIII Región del Biobío"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "IX REG"; $data->nombre = "IX Región de la Araucanía"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "X REG"; $data->nombre = "X Región de los Lagos"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "XI REG"; $data->nombre = "XI Región Aysén del General Carlos Ibáñez del Campo"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "XII REG"; $data->nombre = "XIII Región de Magallanes y de la Antártica Chilena"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "RM"; $data->nombre = "Región Metropolitana de Santiago"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "XIV REG"; $data->nombre = "XIV Región de los Ríos"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "XV REG"; $data->nombre = "XV Región de Arica y Parinacota"; $data->vigente = true; $data->save();
        $data=new Region; $data->codigo = "XVI REG"; $data->nombre = "XVI Región de Ñuble"; $data->vigente = true; $data->save();
    }
}
