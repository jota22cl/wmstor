<?php
namespace App\Filament\Resources\ValorservicioResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ValorservicioResource;
//use Illuminate\Support\Facades\Request\Facades\DB;
use App\Models\Valorservicio;
use Illuminate\Support\Facades\Request; // Asegúrate de importar Request correctamente


class EditValorservicio extends EditRecord
{
    protected static string $resource = ValorservicioResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $requestData0 = Request::input('valores'); //, []);
        $requestData1 = 'da error'; //$this->getForm()->getState()['valores'] ?? [];
        $requestData2 = $this->data['valores'] ?? [];
        $requestData3 = Request::all();
        $requestData4 = Request::input('valores[1][1]',[]);
        //dd($requestData0, $requestData1, $requestData2, $requestData3, $requestData4);

        //dd($data['fecha']);
        //dd('1-$requestData', $requestData, '2-$data', $data, '3-Request::all()', Request::all());
        //dd('1-$requestData', $requestData, '2-$data', $data, '3-Request::all()', Request::all(), '4-$data[fecha]',$data['fecha']);



        /*
        foreach ($requestData as $servicioId => $ccostos) {
            foreach ($ccostos as $ccostoId => $monto) {
                Valorservicio::updateOrCreate(
                    [
                        'empresa_id' => auth()->user()->empresa_id,
                        'fecha' => $data['fecha'],
                        'ccosto_id' => $ccostoId,
                        'servicio_id' => $servicioId,
                    ],
                    ['valor' => $monto]
                );
            }
        }
        */

        return [];
    }

    /*--------------no funciona, revisar despues-------------
    protected function beforeSave()
    {   
        $deleted = Valorservicio::where('empresa_id',auth()->user()->empresa_id)->where('ccosto_id',null)->delete();
    }
    */

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }

}
