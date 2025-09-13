<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RestauranteController;

// Rotas de autenticação
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Rotas protegidas
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Rotas públicas
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
Route::get('/feedbacks', function () {
    return view('feedbacks');
})->name('feedbacks');
Route::get('/profile', function () {
    return view('profile.show');
})->name('profile.show');


Route::get('/hoteis', function () {
    return view('hoteis');
})->name('hoteis');
Route::get('/pontos-turisticos', function () {
    return view('pontos-turisticos');
})->name('pontos-turisticos');


// Rotas para restaurantes (que estão dentro de destinos)
Route::get('/destinos/restaurantes', [RestauranteController::class, 'index'])->name('restaurantes.index');
Route::get('/destinos/restaurantes/{id}', [RestauranteController::class, 'show'])->name('restaurantes.show');

// Rotas para páginas específicas de restaurantes (dentro de destinos)
Route::get('/destinos/restaurantes/alameda', function () {
    return view('destinos.restaurantes.Alameda');
})->name('restaurantes.alameda');

Route::get('/destinos/restaurantes/bene-da-flauta', function () {
    return view('destinos.restaurantes.BenédaFlauta');
})->name('restaurantes.bene-da-flauta');

Route::get('/destinos/restaurantes/canoa', function () {
    return view('destinos.restaurantes.Canoa');
})->name('restaurantes.canoa');

Route::get('/destinos/restaurantes/cantina-pastasciutta', function () {
    return view('destinos.restaurantes.CantinaPastasciutta');
})->name('restaurantes.cantina-pastasciutta');

Route::get('/destinos/restaurantes/capim-santo', function () {
    return view('destinos.restaurantes.CapimSanto');
})->name('restaurantes.capim-santo');

Route::get('/destinos/restaurantes/casa-terracota', function () {
    return view('destinos.restaurantes.CasaTerraccia');
})->name('restaurantes.casa-terracota');

Route::get('/destinos/restaurantes/cipriani', function () {
    return view('destinos.restaurantes.Cipriani');
})->name('restaurantes.cipriani');

Route::get('/destinos/restaurantes/contos-dos-reis', function () {
    return view('destinos.restaurantes.ContosdosReis');
})->name('restaurantes.contos-dos-reis');

Route::get('/destinos/restaurantes/dolce-vita', function () {
    return view('destinos.restaurantes.DolceVita');
})->name('restaurantes.dolce-vita');

Route::get('/destinos/restaurantes/el-fuego', function () {
    return view('destinos.restaurantes.ElFuego');
})->name('restaurantes.el-fuego');

Route::get('/destinos/restaurantes/fasano', function () {
    return view('destinos.restaurantes.Fasano');
})->name('restaurantes.fasano');

Route::get('/destinos/restaurantes/gastro-pub', function () {
    return view('destinos.restaurantes.GastroPub');
})->name('restaurantes.gastro-pub');

Route::get('/destinos/restaurantes/jamile', function () {
    return view('destinos.restaurantes.Jamile');
})->name('restaurantes.jamile');

Route::get('/destinos/restaurantes/la-mafia-trattoria', function () {
    return view('destinos.restaurantes.LaMafiaTrattoria');
})->name('restaurantes.la-mafia-trattoria');

Route::get('/destinos/restaurantes/mangue', function () {
    return view('destinos.restaurantes.Mangue');
})->name('restaurantes.mangue');

Route::get('/destinos/restaurantes/olivia-cucina', function () {
    return view('destinos.restaurantes.OliviaCucina');
})->name('restaurantes.olivia-cucina');

Route::get('/destinos/restaurantes/oro', function () {
    return view('destinos.restaurantes.Oro');
})->name('restaurantes.oro');

Route::get('/destinos/restaurantes/porto-canoas', function () {
    return view('destinos.restaurantes.PortoCanoas');
})->name('restaurantes.porto-canoas');

Route::get('/destinos/restaurantes/rafain', function () {
    return view('destinos.restaurantes.Rafain');
})->name('restaurantes.rafain');

// Rotas para restaurantes por estado
Route::get('/destinos/restaurantes/ma', function () {
    return view('destinos.restaurantes.RestauranteMA');
})->name('restaurantes.ma');

Route::get('/destinos/restaurantes/mg', function () {
    return view('destinos.restaurantes.RestauranteMG');
})->name('restaurantes.mg');

Route::get('/destinos/restaurantes/pr', function () {
    return view('destinos.restaurantes.RestaurantePR');
})->name('restaurantes.pr');

Route::get('/destinos/restaurantes/rl', function () {
    return view('destinos.restaurantes.RestauranteRL');
})->name('restaurantes.rl');

Route::get('/destinos/restaurantes/rs', function () {
    return view('destinos.restaurantes.RestauranteRS');
})->name('restaurantes.rs');

Route::get('/destinos/restaurantes/sc', function () {
    return view('destinos.restaurantes.RestauranteSC');
})->name('restaurantes.sc');

Route::get('/destinos/restaurantes/sp', function () {
    return view('destinos.restaurantes.RestauranteSP');
})->name('restaurantes.sp');

Route::get('/destinos/restaurantes/terraco-italia', function () {
    return view('destinos.restaurantes.TerraçoItália');
})->name('restaurantes.terraco-italia');

Route::get('/destinos/restaurantes/terral', function () {
    return view('destinos.restaurantes.Terral');
})->name('restaurantes.terral');
