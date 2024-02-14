<?php

namespace Database\Seeders;

use App\Models\Role;
use Spatie\Permissions\Models\model_has_roles;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=new Role; $data->name = "Administrador"; $data->save();

        /*
        $data=new model_has_roles;
        $data->role_id=1;
        $data->model_type=1;
        $data->model_id=1;
        $data->save();
        */
    }
}
