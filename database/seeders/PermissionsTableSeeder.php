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
        //$data=new Permission;

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

        $data=new Permission; $data->name = "Empresa-Leer";       $data->save();
        $data=new Permission; $data->name = "Empresa-Crear";      $data->save();
        $data=new Permission; $data->name = "Empresa-Borrar";     $data->save();
        $data=new Permission; $data->name = "Empresa-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Moneda-Leer";       $data->save();
        $data=new Permission; $data->name = "Moneda-Crear";      $data->save();
        $data=new Permission; $data->name = "Moneda-Borrar";     $data->save();
        $data=new Permission; $data->name = "Moneda-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Ccosto-Crear";      $data->save();
        $data=new Permission; $data->name = "Ccosto-Leer";       $data->save();
        $data=new Permission; $data->name = "Ccosto-Borrar";     $data->save();
        $data=new Permission; $data->name = "Ccosto-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Gcomun-Leer";       $data->save();
        $data=new Permission; $data->name = "Gcomun-Crear";      $data->save();
        $data=new Permission; $data->name = "Gcomun-Borrar";     $data->save();
        $data=new Permission; $data->name = "Gcomun-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Gadmin-Leer";       $data->save();
        $data=new Permission; $data->name = "Gadmin-Crear";      $data->save();
        $data=new Permission; $data->name = "Gadmin-Borrar";     $data->save();
        $data=new Permission; $data->name = "Gadmin-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Pseguro-Leer";       $data->save();
        $data=new Permission; $data->name = "Pseguro-Crear";      $data->save();
        $data=new Permission; $data->name = "Pseguro-Borrar";     $data->save();
        $data=new Permission; $data->name = "Pseguro-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Region-Leer";       $data->save();
        $data=new Permission; $data->name = "Region-Crear";      $data->save();
        $data=new Permission; $data->name = "Region-Borrar";     $data->save();
        $data=new Permission; $data->name = "Region-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Ciudad-Leer";       $data->save();
        $data=new Permission; $data->name = "Ciudad-Crear";      $data->save();
        $data=new Permission; $data->name = "Ciudad-Borrar";     $data->save();
        $data=new Permission; $data->name = "Ciudad-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Comuna-Leer";       $data->save();
        $data=new Permission; $data->name = "Comuna-Crear";      $data->save();
        $data=new Permission; $data->name = "Comuna-Borrar";     $data->save();
        $data=new Permission; $data->name = "Comuna-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Cliente-Leer";       $data->save();
        $data=new Permission; $data->name = "Cliente-Crear";      $data->save();
        $data=new Permission; $data->name = "Cliente-Borrar";     $data->save();
        $data=new Permission; $data->name = "Cliente-Actualizar"; $data->save();

    }
}
