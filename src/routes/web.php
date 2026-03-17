<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TecnicoController;

Route::get('/', fn() => redirect()->route('chamados.index'));

Route::resource('chamados', ChamadoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('tecnicos', TecnicoController::class);

// auth
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// status transitions
Route::post('chamados/{chamado}/atender', [ChamadoController::class, 'atender'])->name('chamados.atender');
Route::post('chamados/{chamado}/resolver', [ChamadoController::class, 'resolver'])->name('chamados.resolver');
Route::post('chamados/{chamado}/fechar', [ChamadoController::class, 'fechar'])->name('chamados.fechar');
