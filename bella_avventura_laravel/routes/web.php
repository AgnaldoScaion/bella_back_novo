<?php
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('usuarios.form'));
Route::get('/usuario_form', [UsuarioController::class, 'showForm'])->name('usuarios.form');
Route::post('/save-usuario', [UsuarioController::class, 'saveUsuario'])->name('usuarios.save');
Route::get('/list-usuario', [UsuarioController::class, 'listUsuario'])->name('usuarios.list');
