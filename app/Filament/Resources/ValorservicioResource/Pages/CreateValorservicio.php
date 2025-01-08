<?php
namespace App\Filament\Resources\ValorservicioResource\Pages;

use App\Filament\Resources\ValorservicioResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Valorservicio;

class CreateValorservicio extends CreateRecord
{
    protected static string $resource = ValorservicioResource::class;
    protected static bool $canCreateAnother = false;
 
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $empresa_id = auth()->user()->empresa_id;
        $fecha = $data['fecha'];
        $ccostos = \App\Models\Ccosto::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->get();
        $servicios = \App\Models\Servicio::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->get();
        $ultimaFecha = Valorservicio::where('empresa_id',auth()->user()->empresa_id)->max('fecha');
        if ($ultimaFecha == null) {
            $lafecha = 1;
            foreach ($ccostos as $ccosto) {
                foreach ($servicios as $servicio) {
                    Valorservicio::create([
                        'empresa_id' => $empresa_id,
                        'fecha' => $fecha,
                        'ccosto_id' => $ccosto->id,
                        'servicio_id' => $servicio->id,
                        'valor' => 0,
                        'lafecha' => $lafecha,
                    ]);
                    $lafecha = 0;
                }
            }
        } else {
            $registros = Valorservicio::where('empresa_id',auth()->user()->empresa_id)->where('fecha', $ultimaFecha)->where('ccosto_id', '<>', null)->get();
            foreach ($registros as $registro) {
                $nuevoRegistro = $registro->replicate();
                $nuevoRegistro->fecha = $fecha;
                $nuevoRegistro->save();
            }
        }
        return $data;
    }


    protected function beforeCreate() //: void
    {
        return $this->getResource()::getUrl('index');
    }


    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }

}

