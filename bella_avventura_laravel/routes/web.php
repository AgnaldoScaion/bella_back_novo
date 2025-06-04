<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', fn() => view('welcome'))->name('home');

// Cadastro
Route::get('/cadastro', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/cadastro', [RegisterController::class, 'register'])->name('register');

// Perfil
Route::get('/perfil', [ProfileController::class, 'show'])->name('perfil')->middleware('auth');
Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Páginas Estáticas
Route::get('/sobre-nos', fn() => view('sobre-nos'))->name('sobre-nos');
Route::get('/termos', fn() => view('termos'))->name('termos');

// Páginas Placeholder (para menus)
Route::get('/restaurantes', fn() => view('placeholder', ['title' => 'Restaurantes']))->name('restaurantes')->middleware('auth');
Route::get('/hoteis', fn() => view('placeholder', ['title' => 'Hotéis']))->name('hoteis')->middleware('auth');
Route::get('/pontos-turisticos', fn() => view('placeholder', ['title' => 'Pontos Turísticos']))->name('pontos-turisticos')->middleware('auth');
Route::get('/feedbacks', fn() => view('placeholder', ['title' => 'Meus Feedbacks']))->name('feedbacks')->middleware('auth');

// Autenticação
Auth::routes(['register' => false]); // Desativa o registro padrão do Laravel
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
