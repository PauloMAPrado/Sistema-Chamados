<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TecnicoController;

Route::get('/', fn() => redirect()->route('chamados.index'));

Route::resource('chamados', ChamadoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('tecnicos', TecnicoController::class);
