<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            /* ------ migracion 1 ------ */
            RegionSeeder::Class,
            CiudadSeeder::Class,
            ComunaSeeder::Class,

            EmpresaSeeder::class,

            UsersTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            /* ------ migracion 1 ------*/

            /*------ migracion 2 ------*/
            MonedaSeeder::class,
            CcostoSeeder::Class,
            GcomunSeeder::Class,
            GadminSeeder::Class,
            PseguroSeeder::Class,
            TipoportonSeeder::Class,
            TipocontruccionSeeder::Class,
            UnidadmedidaSeeder::Class,
            /*------ migracion 2 ------*/

        ]);
    }
}
