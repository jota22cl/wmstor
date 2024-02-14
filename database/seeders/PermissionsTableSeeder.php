<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=new Permission;
        
        $data=new Permission; $data->name = "Usuario-Leer";       $data->save();
        $data=new Permission; $data->name = "Usuario-Crear";      $data->save();
        $data=new Permission; $data->name = "Usuario-Borrar";     $data->save();
        $data=new Permission; $data->name = "Usuario-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Rol-Leer";       $data->save();
        $data=new Permission; $data->name = "Rol-Crear";      $data->save();
        $data=new Permission; $data->name = "Rol-Borrar";     $data->save();
        $data=new Permission; $data->name = "Rol-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Permiso-Leer";       $data->save();
        $data=new Permission; $data->name = "Permiso-Crear";      $data->save();
        $data=new Permission; $data->name = "Permiso-Borrar";     $data->save();
        $data=new Permission; $data->name = "Permiso-Actualizar"; $data->save();
    }
}
