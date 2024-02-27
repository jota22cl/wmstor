<?php

namespace Database\Seeders;

use App\Models\Comuna;
use App\Models\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comuna = new Comuna;

        $nid=$comuna->select('id')->where('nombre','=','Quinta Normal')->get();
        
        $data=new Empresa; 
        $data->razonsocial ='Almacenes Generales de Deposito Storage S.A.';
        $data->sigla ='Storage';
        $data->rut ='84.180.100-8';
        $data->giro ='Servicios Almacenamiento de Bodegas';
        $data->direccion ='Poeta Pedro Prado 1689';
        $data->comuna_id = $nid[0]->id;
        $data->telefono = '226368800';
        $data->email = 'storage@storage.cl';
        $data->repl_nombre = 'Jorge Lyon Echeverria';
        $data->repl_rut = '05.549.434-7';
        $data->repl_telefono = '226368800';
        $data->repl_email = 'jlyon@storage.cl';
        $data->save();
        
        $nid=$comuna->select('id')->where('nombre','=','Quilicura')->get();

        $data=new Empresa; 
        $data->razonsocial ='Storetek S.A.';
        $data->sigla ='Storetek';
        $data->rut ='76.163.924-2';
        $data->giro ='Servicios Almacenamiento de Bodegas';
        $data->direccion ='Av. Eduardo Frei Montalva 6004';
        $data->comuna_id = $nid[0]->id;
        $data->telefono = '226368800';
        $data->email = 'storetek@storetek.cl';
        $data->repl_nombre = 'Jorge Lyon Echeverria';
        $data->repl_rut = '05.549.434-7';
        $data->repl_telefono = '226368811';
        $data->repl_email = 'jlyon@storage.cl';
        $data->save();
    }
}
