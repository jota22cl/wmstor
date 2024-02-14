<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=new User;
        $data->name = "Administrador";
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
