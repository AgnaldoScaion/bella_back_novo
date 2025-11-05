<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PontoTuristicoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========== ROTAS DE AUTENTICAÇÃO ==========
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/password/reset', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/password/email', [LoginController::class, 'forgotPassword'])->name('password.email');
});

// ========== ROTAS PROTEGIDAS (REQUER AUTENTICAÇÃO) ==========
Route::middleware('auth')->group(function () {
    // Autenticação
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Reservas
    Route::prefix('reservas')->group(function () {
        Route::get('/create/{hotel}', [ReservaController::class, 'create'])->name('reservas.create');
        Route::post('/', [ReservaController::class, 'store'])->name('reservas.store');
        Route::get('/minhas-reservas', [ReservaController::class, 'minhasReservas'])->name('reservas.minhas');
        Route::post('/{id}/cancelar', [ReservaController::class, 'cancelar'])->name('reservas.cancelar');
    });

    // Chat
    Route::prefix('chat')->group(function () {
        Route::get('/', [ChatController::class, 'index'])->name('chat.index');
        Route::get('/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
        Route::post('/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    });

    // API Routes
    Route::prefix('api')->group(function () {
        Route::get('/feedbacks', [FeedbackController::class, 'index']);
        Route::post('/feedbacks', [FeedbackController::class, 'store']);
        Route::post('/chat-tutorial-close', [ChatController::class, 'closeTutorial']);
    });
});

// ========== ROTAS PÚBLICAS DE RESERVAS ==========
Route::prefix('reservas')->group(function () {
    Route::get('/sucesso/{id}', [ReservaController::class, 'sucesso'])->name('reservas.sucesso');
    Route::get('/confirmar/{codigo}', [ReservaController::class, 'confirmar'])->name('reservas.confirmar');
});

// ========== PÁGINAS PRINCIPAIS ==========
Route::get('/', fn() => redirect('home'))->name('home');
Route::get('/home', fn() => view('home'))->name('home');
Route::get('/termos', fn() => view('termos'))->name('termos');
Route::get('/sobre-nos', fn() => view('sobre-nos'))->name('sobre-nos');
Route::get('/destinos', fn() => view('destinos'))->name('destinos');
Route::get('/feedbacks', fn() => view('feedbacks'))->name('feedbacks');
Route::get('/profile', fn() => view('profile.show'))->name('profile.show');

// ========== ROTAS DE DESTINOS ==========

// Pontos Turísticos
Route::prefix('destinos/pontos-turisticos')->group(function () {
    Route::get('/{id}', [PontoTuristicoController::class, 'show'])->name('pontos-turisticos.show');
    
    $pontosTuristicos = [
        'beco-do-batman' => 'BecodoBatman',
        'cataratas-do-iguacu' => 'Cataratasdolguacu',
        'catedral-da-se' => 'CatedraldaS',
        'centro-historico-sao-luis' => 'CentroHistoricodeSaoLuis',
        'cristo-redentor' => 'CristoRedentor',
        'parque-ibirapuera' => 'IbirapueraPark',
        'igreja-sao-francisco' => 'IgrejadeSaoFranciscodeAssis',
        'ilha-campeche' => 'IlhaCampeche',
        'ilha-do-campeche' => 'IlhadoCampeche',
        'lago-negro' => 'LagoNegro',
        'lencois-maranhenses' => 'LencoisMaranhenses',
        'mina-da-passagem' => 'MinadaPassagem',
        'mini-mundo' => 'MiniMundo',
        'mirante-morro-cruz' => 'MirantedoMorrodaCruz',
        'museu-inconfidencia' => 'Museudainconfidencia',
        'palacio-dos-leoes' => 'PalaciodosLeoes',
        'pao-de-acucar' => 'PaodeAcucar',
        'parque-das-aves' => 'ParquedasAves',
        'praia-copacabana' => 'PraiaCopacabana',
        'praia-joaquina' => 'Praidaloaquina',
        'rua-coberta' => 'Ruacoberta',
        'turismo-ma' => 'TurismoMA',
        'turismo-mg' => 'TurismoMG',
        'turismo-pr' => 'TurismoPR',
        'turismo-ru' => 'TurismoRU',
        'turismo-rs' => 'TurismoRS',
        'turismo-sc' => 'TurismoSC',
        'turismo-sp' => 'TurismoSP',
        'usina-hidreletrica-itaipu' => 'UsinalHidreletricadeItaipu'
    ];

    foreach ($pontosTuristicos as $slug => $view) {
        Route::get("/{$slug}", fn() => view("destinos.pontos-turisticos.{$view}"))->name("pontos-turisticos.{$slug}");
    }
});
Route::get('/pontos-turisticos', fn() => view('pontos-turisticos'))->name('pontos-turisticos.alternative');

// Hotéis
Route::prefix('destinos/hoteis')->group(function () {
    Route::get('/{id}', [HotelController::class, 'show'])->name('hoteis.show');
    
    $hoteis = [
        'atlantico-business-rj' => 'AtlanticoBussinesRJ',
        'atlantico-copacabana-rj' => 'AtlanticoCopacabanaRJ',
        'atlantico-praia-rj' => 'AtlanticoPraiaRJ',
        'blue-tree-towers-ma' => 'BlueTreeTowersMA',
        'capsula-hotel-sp' => 'CapsulaHotelsP',
        'colline-rs' => 'CollineRS',
        'continental-rs' => 'ContinentalRS',
        'goldmen-express-pr' => 'GoldMenExpressClanortePR',
        'gran-villagio-sp' => 'GranVillagiosP',
        'ingleses-palace-sc' => 'InglesesPalacesC',
        'life-infinity-rs' => 'LifelnfinityRS',
        'minas-garden-mg' => 'MinasGardenMG',
        'oceania-park-sc' => 'OceaniaParkSC',
        'por-do-sol-mg' => 'PorDoSolMG',
        'pousada-agua-marinha-pr' => 'PousadaguavarinhaPR',
        'pousada-canto-vigia-sc' => 'PousadaCantodaVigiasC',
        'pousada-universal-ma' => 'PousadaluhversalMA',
        'rios-ma' => 'RiosMA',
        'san-michel-sp' => 'SanMichelSP',
        'viale-cataratas-pr' => 'VialeCataratasPR',
        'villa-lobos-mg' => 'VillaLobosSpaRomantikMG'
    ];

    foreach ($hoteis as $slug => $view) {
        Route::get("/{$slug}", fn() => view("destinos.hoteis.{$view}"))->name("hoteis.{$slug}");
    }
});
Route::get('/hoteis', fn() => view('hoteis'))->name('hoteis.alternative');

// Restaurantes
Route::prefix('destinos/restaurantes')->group(function () {
    Route::get('/', fn() => view('restaurante'))->name('restaurantes.index');
    Route::get('/{id}', [RestauranteController::class, 'show'])->name('restaurantes.show');
    
    $restaurantes = [
        'alameda' => 'Alameda',
        'bene-da-flauta' => 'BenédaFlauta',
        'canoa' => 'Canoa',
        'cantina-pastasciutta' => 'CantinaPastasciutta',
        'capim-santo' => 'CapimSanto',
        'casa-terracota' => 'CasaTerraccia',
        'cipriani' => 'Cipriani',
        'contos-dos-reis' => 'ContosdosReis',
        'dolce-vita' => 'DolceVita',
        'el-fuego' => 'ElFuego',
        'fasano' => 'Fasano',
        'gastro-pub' => 'GastroPub',
        'jamile' => 'Jamile',
        'la-mafia-trattoria' => 'LaMafiaTrattoria',
        'mangue' => 'Mangue',
        'olivia-cucina' => 'OliviaCucina',
        'oro' => 'Oro',
        'porto-canoas' => 'PortoCanoas',
        'rafain' => 'Rafain',
        'terraco-italia' => 'TerraçoItália',
        'terral' => 'Terral'
    ];

    foreach ($restaurantes as $slug => $view) {
        Route::get("/{$slug}", fn() => view("destinos.restaurantes.{$view}"))->name("restaurantes.{$slug}");
    }

    // Restaurantes por estado
    $estados = ['ma', 'mg', 'pr', 'rl', 'rs', 'sc', 'sp'];
    foreach ($estados as $estado) {
        Route::get("/{$estado}", fn() => view("destinos.restaurantes.Restaurante" . strtoupper($estado)))
            ->name("restaurantes.{$estado}");
    }
});
Route::get('/restaurantes', fn() => view('restaurante'))->name('restaurantes.alternative');
