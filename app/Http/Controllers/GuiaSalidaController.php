<?php

namespace App\Http\Controllers;

use App\Models\Guia;
use App\Models\ContratoGuiaMail;
//use App\Models\Guiadetalle;
//use App\Models\Ccosto;
//use App\Models\Contrato;
//use App\Models\Gcomun;
//use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\GuiaSalidaMailable;
use Illuminate\Support\Facades\Mail;

class GuiaSalidaController extends Controller
{

    public function GuiaSalida($id)
    {
        //set_time_limit(120); // Aumenta el límite a 120 segundos
        $GuiaSalida = Guia::with(['guiadetalles','contrato','contrato.ccosto','contrato.bodega'])->findOrFail($id);
        //dd($GuiaSalida);
        // Generar el PDF usando la vista y pasando los datos necesarios
        $pdf_view = PDF::setPaper('letter')->loadView('pdf.GuiaSalida', compact('GuiaSalida'));
        $pdf_save = PDF::setPaper('letter')->loadView('pdf.GuiaSalida', compact('GuiaSalida'));
        $origcp = $GuiaSalida->estado == 'd' ? 'Original' : 'Copia';
        $nombrepdf = 'GuiaSalida-'.$GuiaSalida->numeroGuia.'-'.$origcp;
        $path = storage_path('app/public/'.auth()->user()->empresa->directorio.'/guias/'.$nombrepdf.'.pdf');
        $pdf_save->save($path);
        // actualiza campo estado de Digitado a Emitido solo cuando esta Digitado.
        DB::transaction(function () use ($pdf_save, $path, $GuiaSalida) {
            if($GuiaSalida->estado == 'd'){
                //cambia el etado de Digitado a Emitido en la guia.
                $GuiaSalida->estado = 'e';
                $GuiaSalida->fechaEmision = now();
                $GuiaSalida->save();
                foreach ($GuiaSalida->guiadetalles as $detalle) {
                    // Actualizar el registro correspondiente en productoperiodos
                    DB::table('productos')
                        ->where('id', $detalle->producto_id) // Asegurarte de que el producto existe
                        ->increment('totalSalidas', $detalle->cantidad); // Incrementar el campo entradas
                    //DB::table('productoperiodos')
                    //    ->where('producto_id', $detalle->producto_id) // Asegurarte de que el producto existe
                    //    ->where('periodo', auth()->user()->empresa->periodo) // Asume que el periodo actual es relevante
                    //    ->increment('entradas', $detalle->cantidad); // Incrementar el campo entradas
                }
                //Envia la guia OCIGINAL a los destinatarios del contrato
                $destinatarios = ContratoGuiaMail::where('contrato_id',$GuiaSalida->contrato_id)
                    ->pluck('email')
                    ->toArray();
                //dd($destinatarios);
                Mail::to($destinatarios)
                   ->send(new GuiaSalida($path, $GuiaSalida));
            }
        });
        return $pdf_view->stream($nombrepdf.'.pdf'); // muestra en el navegador el PDF generado
    }

}
