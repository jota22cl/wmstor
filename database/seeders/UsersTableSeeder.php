<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa = new Empresa;
        $EmpId=$empresa->select('id')->where('sigla','=','Storage')->get();

        $data=new User;
        $data->empresa_id = $EmpId[0]->id;
        $data->name = "Juan Luis Gutierrez";
        $data->email = "sistemas@storage.cl";
        $data->password = "15561556";
        $data->save();
     
        /*
        $data=new User;
        $data->name = "Usuario de Prueba";
        $data->email = "prueba1@storage.cl";
        $data->password = "15561556";
        $data->save();
        */
    }
}
