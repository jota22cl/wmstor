<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Valorservicio;
//use App\Models\Gcomun;
//use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContratoController extends Controller
{
    /**
     * Genera en PDF el recibo del pago de garantia
     * ********************************************
     */
    public function generarRecibo($id)
    {
        //set_time_limit(120); // Aumenta el límite a 120 segundos
        // Obtener el contrato basado en el ID
        $contrato = Contrato::with(['cliente', 'bodega', 'empresa', 'ccosto'])->findOrFail($id);
        //dd($contrato,$contrato->empresa->logo);

        // Generar el PDF usando la vista y pasando los datos necesarios
        $pdf_view = PDF::setPaper('letter')->loadView('pdf.recibopagogarantia', compact('contrato'));
        $pdf_save = PDF::setPaper('letter')->loadView('pdf.recibopagogarantia', compact('contrato'));

        // Define el path donde se guardará el PDF
        //$path = storage_path('app/public/documentos/contratos/'.$contrato->ccosto->codigo.'-'.$contrato->folioContrato.'-ReciboPagoGarantia.pdf');
        $path = storage_path('app/public/'.auth()->user()->empresa->directorio.'/contratos/'.$contrato->ccosto->codigo.'-'.$contrato->folioContrato.'-ReciboPagoGarantia.pdf');
        // Guarda el PDF en el servidor y actualiza campo
        DB::transaction(function () use ($pdf_save, $path, $contrato) {
            // Guarda el PDF
            //dd($path);
            $pdf_save->save($path);
            // Actualiza el campo en el contrato
            $contrato->garantiaReciboGenerado = 1;
            $contrato->save();
        });
        // Retorna el PDF como una transmisión al navegador
        //return $pdf->download('recibopagogarantia.pdf'); // permite bajar en el PC el PDF generado
        return $pdf_view->stream('recibopagogarantia.pdf'); // muestra en el navegador el PDF generado
    }


    /**
     * Genera en PDF el contrato correspondiente segun sea el Centro de Costo
     * **********************************************************************
     */
    public function generarContrato($id)
    {
        //set_time_limit(120); // Aumenta el límite a 120 segundos
        // Obtener el contrato basado en el ID
        $contrato = Contrato::with([
            'cliente', 
            'bodega', 
            'empresa', 
            'ccosto', 
            'contratoreplegals', 
            'contratopagoproveedors', 
            'contratodtemails', 
            'contratocoordinadors', 
            'contratoautretiros', 
            'gcomun', 
            'gadmin', 
            'pseguro'
            ])->findOrFail($id);

        //  Obtiene los valores de servicio respecto a la (1) fecha de contrato v/s (2) fecha anterior de valores de los servicios
        $lafecha = Valorservicio::where('empresa_id',auth()->user()->empresa_id)
                                ->where('fecha', '<=', $contrato->fecha_ini)
                                ->orderBy('fecha', 'desc')
                                ->first();
        $lafecha = $lafecha->fecha;
        $valores = Valorservicio::where('empresa_id',auth()->user()->empresa_id)
                                ->where('fecha', '=', $lafecha)
                                ->where('ccosto_id','=',$contrato->ccosto->id)
                                ->where('valor', '>', 0.0)
                                ->get();
        
        // Generar el PDF usando la vista y pasando los datos necesarios
        //$pdf_view = PDF::setPaper('letter')->set_option('defaultFont', 'Verdana ')->loadView('pdf.contratoLLM', compact('contrato','valores'));
        //dd(storage_path('app/public/'.auth()->user()->empresa->directorio.'/'.$contrato->empresa->logo));

        $pdf_view = PDF::setPaper('letter')->loadView('pdf.contrato'.$contrato->ccosto->codigo, compact('contrato','valores'));
        $pdf_save = PDF::setPaper('letter')->loadView('pdf.contrato'.$contrato->ccosto->codigo, compact('contrato','valores'));
        $path = storage_path('app/public/'.auth()->user()->empresa->directorio.'/contratos/'.$contrato->ccosto->codigo.'-'.$contrato->folioContrato.'-Contrato.pdf');
        DB::transaction(function () use ($pdf_save, $path, $contrato) {
            // Guarda el PDF
            //dd($path);
            $pdf_save->save($path);
        });



        // Define el path donde se guardará el PDF
        $path = storage_path('app/public/'.auth()->user()->empresa->directorio.'/contratos/'.$contrato->ccosto->codigo.'-'.$contrato->folioContrato.'-Contrato.pdf');
        // Guarda el PDF en el servidor y actualiza campo
        //DB::transaction(function () use ($pdf_save, $path, $contrato) {
            // Guarda el PDF
            //$pdf_save->save($path);
        //    // Actualiza el campo en el contrato
        //    $contrato->garantiaReciboGenerado = 1;
        //    $contrato->save();
        //});
        // Retorna el PDF como una transmisión al navegador
        //return $pdf->download('contratoLLM.pdf'); // permite bajar en el PC el PDF generado
        return $pdf_view->stream('contrato'.$contrato->ccosto->codigo.'.pdf'); // muestra en el navegador el PDF generado
    }










}
