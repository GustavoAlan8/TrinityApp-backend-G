<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[EventoController::class, 'index'])->name('Evento.index');
Route::get('/create',[EventoController::class, 'create'])->name('Evento.create');

Route::get('/fotografias', [FotografiaController::class, 'index']);
Route::get('/fotografias/create', [FotografiaController::class, 'create']);
Route::get('/fotografias/{fotografia}/edit', [FotografiaController::class, 'edit']);