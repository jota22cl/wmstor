<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $region = new Region;

        $nid=$region->select('id')->where('codigo','=','I REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Iquique";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Tamarugal";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','II REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Antofagasta";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "El Loa";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Tocopilla";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','III REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Chañaral";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Copiapó";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Huasco";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','IV REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Choapa";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Elqui";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Limarí";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','V REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Isla de Pascua";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Los Andes";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Marga Marga";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Petorca";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Quillota";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "San Antonio";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "San Felipe de Aconcagua";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Valparaíso";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','VI REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Cachapoal";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Cardenal Caro";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Colchagua";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','VII REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Cauquenes";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Curicó";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Linares";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Talca";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','VIII REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Arauco";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Bío Bío";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Concepción";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','IX REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Cautín";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Malleco";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','X REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Chiloé";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Llanquihue";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Osorno";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Palena";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','XI REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Aysén";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Capitán Prat";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Coyhaique";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "General Carrera";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','XII REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Antártica Chilena";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Magallanes";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Tierra del Fuego";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Última Esperanza";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','RM')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Chacabuco";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Cordillera";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Maipo";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Melipilla";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Santiago";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Talagante";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','XIV REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Ranco";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Valdivia";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','XV REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Arica";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Parinacota";$ciudad->save();

        $nid=$region->select('id')->where('codigo','=','XVI REG')->get();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Diguillín";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Itata";$ciudad->save();
        $ciudad = new Ciudad;$ciudad->region_id=$nid[0]->id;$ciudad->nombre = "Punilla";$ciudad->save();
    }
}
