<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\GuiaIngresoController;
use App\Http\Controllers\GuiaSalidaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
->middleware(['auth', 'verified'])
->name('dashboard');

Route::view('profile', 'profile')
->middleware(['auth'])
->name('profile');

// ruta para el Recibo de Garantia
Route::get('/admin/contratos/{id}/recibopagogarantia', [ContratoController::class, 'generarRecibo'])
    ->middleware(['auth'])  // Asegúrate de que esta ruta está protegida si lo necesitas
    ->name('contratos.recibopagogarantia');

// ********** ruta para el Contrato de Arriendo LLM **********
Route::get('/admin/contratos/{id}/contrato', [ContratoController::class, 'generarContrato'])
    ->middleware(['auth'])  // Asegúrate de que esta ruta está protegida si lo necesitas
    ->name('contratos.contrato');

// ruta para emtir Guia de Ingreso
Route::get('/admin/guia-ingresos/{id}/GuiaIngreso', [GuiaIngresoController::class, 'GuiaIngreso'])
    ->middleware(['auth'])  // Asegúrate de que esta ruta está protegida si lo necesitas
    ->name('guia-ingresos.GuiaIngreso');

// ruta para emtir Guia de Salida
Route::get('/admin/guia-salidas/{id}/GuiaSalida', [GuiaSalidaController::class, 'GuiaSalida'])
    ->middleware(['auth'])  // Asegúrate de que esta ruta está protegida si lo necesitas
    ->name('guia-salidas.GuiaSalida');
//Route::get('/guia-salidas/{id}', [GuiaSalidaController::class, 'GuiaSalida'])->name('guia-salidas.GuiaSalida');


/*
    // ********** ruta para el Contrato de Arriendo LLM **********
Route::get('/admin/contratos/{id}/contratoLLM', [ContratoController::class, 'generarContratoLLM'])
    ->middleware(['auth'])  // Asegúrate de que esta ruta está protegida si lo necesitas
    ->name('contratos.contratoLLM');
// ********** ruta para el Contrato de Arriendo ISP **********
Route::get('/admin/contratos/{id}/contratoISP', [ContratoController::class, 'generarContratoISP'])
    ->middleware(['auth'])  // Asegúrate de que esta ruta está protegida si lo necesitas
    ->name('contratos.contratoISP');
// ********** ruta para el Contrato de Arriendo ADM **********
Route::get('/admin/contratos/{id}/contratoADM', [ContratoController::class, 'generarContratoADM'])
    ->middleware(['auth'])  // Asegúrate de que esta ruta está protegida si lo necesitas
    ->name('contratos.contratoADM');
*/

Route::get('/prueba', function () {
    return 'Laravel está funcionando correctamente';
});


require __DIR__.'/auth.php';
