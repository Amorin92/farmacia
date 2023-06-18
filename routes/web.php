<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\TransportadoraController;
use App\Http\Controllers\TipoController;

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
Route::get('/medicamento/busca', [MedicamentoController::class, 'busca']);
Route::get('/medicamento/detalhes', [MedicamentoController::class, 'detalhes']);
Route::get('/medicamento/busca', [MedicamentoController::class, 'busca'])->name('medicamento.busca');
Route::get('/', [MedicamentoController::class, 'index']);
Route::get('/detalhes', [MedicamentoController::class, 'detalhes']);
Route::get('/medicamento/detalhes', [MedicamentoController::class, 'detalhes'])->name('medicamento.detalhes');
Route::get('/detalhes', [MedicamentoController::class, 'detalhes'])->name('medicamento.detalhes');
Route::get('/detalhes/{id}', [MedicamentoController::class, 'detalhes'])->name('medicamento.detalhes');
Route::get('home', [MedicamentoController::class, 'index']);
Route::get('/index', [MedicamentoController::class, 'index']);


/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/listagemMedicamento', function () {
    return view('listagemMedicamento');
})->middleware(['auth', 'verified'])->name('listagemMedicamento');

Route::get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');


Route::middleware('auth')->group(function () {
Route::get('listagemMedicamento', [MedicamentoController::class, 'listar']);
Route::get('listagemMedicamento', [MedicamentoController::class, 'listar']);
Route::get('/medicamento/listar', [MedicamentoController::class, 'listar']);

Route::get('/medicamento/listarTudo', [MedicamentoController::class, 'listarTudo']);
Route::get('/medicamento/novo', [MedicamentoController::class, 'novo']);
Route::get('/medicamento/edit/{id}', [MedicamentoController::class, 'edit']);
Route::get('/medicamento/destroy/{id}', [MedicamentoController::class, 'destroy']);
Route::post('/medicamento/store', [MedicamentoController::class, 'store']);
Route::delete('/medicamento/destroy/{id}', [MedicamentoController::class, 'destroy']);
Route::get('/medicamento/relatorio', [MedicamentoController::class, 'relatorio']);

Route::get('/laboratorio/listar', [LaboratorioController::class, 'listar']);
Route::get('/laboratorio/novo', [LaboratorioController::class, 'novo']);
Route::get('/laboratorio/edit/{id}', [LaboratorioController::class, 'edit']);
Route::get('/laboratorio/destroy/{id}', [LaboratorioController::class, 'destroy']);
Route::post('/laboratorio/store', [LaboratorioController::class, 'store']);
Route::delete('/laboratorio/destroy/{id}', [LaboratorioController::class, 'destroy']);

Route::get('/transportadora/listar', [TransportadoraController::class, 'listar']);
Route::get('/transportadora/novo', [TransportadoraController::class, 'novo']);
Route::get('/transportadora/edit/{id}', [TransportadoraController::class, 'edit']);
Route::get('/transportadora/destroy/{id}', [TransportadoraController::class, 'destroy']);
Route::post('/transportadora/store', [TransportadoraController::class, 'store']);
Route::delete('/transportadora/destroy/{id}', [TransportadoraController::class, 'destroy']);

});
Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('auth')->name('profile.destroy');

Route::get('/tipo/listar', [TipoController::class, 'listar']);
Route::get('/listagemMedicamento', [MedicamentoController::class, 'listar'])->name('listagemMedicamento');
Route::get('/index', [MedicamentoController::class, 'index'])->name('index');

/*  Route::get('/', function () {
    return view('index');
});  */

require __DIR__.'/auth.php';

