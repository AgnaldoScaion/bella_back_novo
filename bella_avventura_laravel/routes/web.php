<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\DestinosController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PontosTuristicosController;
use App\Http\Controllers\HoteisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/termos', function () {
    return view('termos');
})->name('termos');

Route::get('/sobre-nos', function () {
    return view('sobre-nos');
})->name('sobre-nos');

Route::get('/destinos', function () {
    return view('destinos');
})->name('destinos');

Route::get('/restaurantes', function () {
    return view('restaurantes');
})->name('restaurantes');

Route::get('/hoteis', function () {
    return view('hoteis');
})->name('hoteis');

Route::get('/pontos-turisticos', function () {
    return view('pontos-turisticos');
})->name('pontos-turisticos');

Route::get('/feedbacks', function () {
    return view('feedbacks');
})->name('feedbacks');

Route::get('/profile', function () {
    return view('profile.show');
})->name('profile.show');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');
