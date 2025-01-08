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

        $data=new Permission; $data->name = "TipoPorton-Leer";       $data->save();
        $data=new Permission; $data->name = "TipoPorton-Crear";      $data->save();
        $data=new Permission; $data->name = "TipoPorton-Borrar";     $data->save();
        $data=new Permission; $data->name = "TipoPorton-Actualizar"; $data->save();

        $data=new Permission; $data->name = "TipoContruc-Leer";       $data->save();
        $data=new Permission; $data->name = "TipoContruc-Crear";      $data->save();
        $data=new Permission; $data->name = "TipoContruc-Borrar";     $data->save();
        $data=new Permission; $data->name = "TipoContruc-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Unimed-Leer";       $data->save();
        $data=new Permission; $data->name = "Unimed-Crear";      $data->save();
        $data=new Permission; $data->name = "Unimed-Borrar";     $data->save();
        $data=new Permission; $data->name = "Unimed-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Servicio-Leer";       $data->save();
        $data=new Permission; $data->name = "Servicio-Crear";      $data->save();
        $data=new Permission; $data->name = "Servicio-Borrar";     $data->save();
        $data=new Permission; $data->name = "Servicio-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Cliente-Leer";       $data->save();
        $data=new Permission; $data->name = "Cliente-Crear";      $data->save();
        $data=new Permission; $data->name = "Cliente-Borrar";     $data->save();
        $data=new Permission; $data->name = "Cliente-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Bodega-Leer";       $data->save();
        $data=new Permission; $data->name = "Bodega-Crear";      $data->save();
        $data=new Permission; $data->name = "Bodega-Borrar";     $data->save();
        $data=new Permission; $data->name = "Bodega-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Vendedor-Leer";       $data->save();
        $data=new Permission; $data->name = "Vendedor-Crear";      $data->save();
        $data=new Permission; $data->name = "Vendedor-Borrar";     $data->save();
        $data=new Permission; $data->name = "Vendedor-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Valservicio-Leer";       $data->save();
        $data=new Permission; $data->name = "Valservicio-Crear";      $data->save();
        $data=new Permission; $data->name = "Valservicio-Borrar";     $data->save();
        $data=new Permission; $data->name = "Valservicio-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Numeral-Leer";       $data->save();
        $data=new Permission; $data->name = "Numeral-Crear";      $data->save();
        $data=new Permission; $data->name = "Numeral-Borrar";     $data->save();
        $data=new Permission; $data->name = "Numeral-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Operario-Leer";       $data->save();
        $data=new Permission; $data->name = "Operario-Crear";      $data->save();
        $data=new Permission; $data->name = "Operario-Borrar";     $data->save();
        $data=new Permission; $data->name = "Operario-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Contrato-Leer";       $data->save();
        $data=new Permission; $data->name = "Contrato-Crear";      $data->save();
        $data=new Permission; $data->name = "Contrato-Borrar";     $data->save();
        $data=new Permission; $data->name = "Contrato-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Producto-Leer";       $data->save();
        $data=new Permission; $data->name = "Producto-Crear";      $data->save();
        $data=new Permission; $data->name = "Producto-Borrar";     $data->save();
        $data=new Permission; $data->name = "Producto-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Gingreso-Leer";       $data->save();
        $data=new Permission; $data->name = "Gingreso-Crear";      $data->save();
        $data=new Permission; $data->name = "Gingreso-Borrar";     $data->save();
        $data=new Permission; $data->name = "Gingreso-Actualizar"; $data->save();

        $data=new Permission; $data->name = "Gsalida-Leer";       $data->save();
        $data=new Permission; $data->name = "Gsalida-Crear";      $data->save();
        $data=new Permission; $data->name = "Gsalida-Borrar";     $data->save();
        $data=new Permission; $data->name = "Gsalida-Actualizar"; $data->save();

        $data=new Permission; $data->name = "SelCliente-Leer";       $data->save(); // este debiera de bastar
        $data=new Permission; $data->name = "SelCliente-Crear";      $data->save();
        $data=new Permission; $data->name = "SelCliente-Borrar";     $data->save();
        $data=new Permission; $data->name = "SelCliente-Actualizar"; $data->save();





    }
}
