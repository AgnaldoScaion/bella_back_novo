<?php
// Rota para registrar fechamento do tutorial do chat
Route::post('/api/chat-tutorial-close', [ChatController::class, 'closeTutorial'])->middleware('auth');
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PontoTuristicoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\ChatController;

// Rotas de autenticação
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/password/reset', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/password/email', [LoginController::class, 'forgotPassword'])->name('password.email');
});

// Rotas protegidas
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Rotas de Reservas (protegidas - requer autenticação)
    Route::get('/reservas/create/{hotel}', [ReservaController::class, 'create'])->name('reservas.create');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
    Route::get('/minhas-reservas', [ReservaController::class, 'minhasReservas'])->name('reservas.minhas');
    Route::post('/reservas/{id}/cancelar', [ReservaController::class, 'cancelar'])->name('reservas.cancelar');

    // Rotas de feedback multiusuário
    Route::get('/api/feedbacks', [FeedbackController::class, 'index']);
    Route::post('/api/feedbacks', [FeedbackController::class, 'store']);

    // Rotas do chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});

// Rotas públicas de Reservas (não requerem autenticação)
Route::get('/reservas/sucesso/{id}', [ReservaController::class, 'sucesso'])->name('reservas.sucesso');
Route::get('/reservas/confirmar/{codigo}', [ReservaController::class, 'confirmar'])->name('reservas.confirmar');

// Rotas públicas
Route::get('/', function () {
    return redirect('home');
})->name('home');
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

// Rotas para pontos turísticos (mantendo o mesmo padrão das outras rotas)
Route::prefix('destinos/pontos-turisticos')->group(function () {
    // Rota para detalhes do hotel via controller
    Route::get('/{id}', [PontoTuristicoController::class, 'show'])->name('pontos-turisticos.alternative');

    // Rotas específicas para cada ponto turístico
    Route::get('/beco-do-batman', function () {
        return view('destinos.pontos-turisticos.BecodoBatman');
    })->name('pontos-turisticos.beco-do-batman');

    Route::get('/cataratas-do-iguacu', function () {
        return view('destinos.pontos-turisticos.Cataratasdolguacu');
    })->name('pontos-turisticos.cataratas-do-iguacu');

    Route::get('/catedral-da-se', function () {
        return view('destinos.pontos-turisticos.CatedraldaS');
    })->name('pontos-turisticos.catedral-da-se');

    Route::get('/centro-historico-sao-luis', function () {
        return view('destinos.pontos-turisticos.CentroHistoricodeSaoLuis');
    })->name('pontos-turisticos.centro-historico-sao-luis');

    Route::get('/cristo-redentor', function () {
        return view('destinos.pontos-turisticos.CristoRedentor');
    })->name('pontos-turisticos.cristo-redentor');

    Route::get('/parque-ibirapuera', function () {
        return view('destinos.pontos-turisticos.IbirapueraPark');
    })->name('pontos-turisticos.parque-ibirapuera');

    Route::get('/igreja-sao-francisco', function () {
        return view('destinos.pontos-turisticos.IgrejadeSaoFranciscodeAssis');
    })->name('pontos-turisticos.igreja-sao-francisco');

    Route::get('/ilha-campeche', function () {
        return view('destinos.pontos-turisticos.IlhaCampeche');
    })->name('pontos-turisticos.ilha-campeche');

    Route::get('/ilha-do-campeche', function () {
        return view('destinos.pontos-turisticos.IlhadoCampeche');
    })->name('pontos-turisticos.ilha-do-campeche');

    Route::get('/lago-negro', function () {
        return view('destinos.pontos-turisticos.LagoNegro');
    })->name('pontos-turisticos.lago-negro');

    Route::get('/lencois-maranhenses', function () {
        return view('destinos.pontos-turisticos.LencoisMaranhenses');
    })->name('pontos-turisticos.lencois-maranhenses');

    Route::get('/mina-da-passagem', function () {
        return view('destinos.pontos-turisticos.MinadaPassagem');
    })->name('pontos-turisticos.mina-da-passagem');

    Route::get('/mini-mundo', function () {
        return view('destinos.pontos-turisticos.MiniMundo');
    })->name('pontos-turisticos.mini-mundo');

    Route::get('/mirante-morro-cruz', function () {
        return view('destinos.pontos-turisticos.MirantedoMorrodaCruz');
    })->name('pontos-turisticos.mirante-morro-cruz');

    Route::get('/museu-inconfidencia', function () {
        return view('destinos.pontos-turisticos.Museudainconfidencia');
    })->name('pontos-turisticos.museu-inconfidencia');

    Route::get('/palacio-dos-leoes', function () {
        return view('destinos.pontos-turisticos.PalaciodosLeoes');
    })->name('pontos-turisticos.palacio-dos-leoes');

    Route::get('/pao-de-acucar', function () {
        return view('destinos.pontos-turisticos.PaodeAcucar');
    })->name('pontos-turisticos.pao-de-acucar');

    Route::get('/parque-das-aves', function () {
        return view('destinos.pontos-turisticos.ParquedasAves');
    })->name('pontos-turisticos.parque-das-aves');

    Route::get('/praia-copacabana', function () {
        return view('destinos.pontos-turisticos.PraiaCopacabana');
    })->name('pontos-turisticos.praia-copacabana');

    Route::get('/praia-joaquina', function () {
        return view('destinos.pontos-turisticos.Praidaloaquina');
    })->name('pontos-turisticos.praia-joaquina');

    Route::get('/rua-coberta', function () {
        return view('destinos.pontos-turisticos.Ruacoberta');
    })->name('pontos-turisticos.rua-coberta');

    Route::get('/turismo-ma', function () {
        return view('destinos.pontos-turisticos.TurismoMA');
    })->name('pontos-turisticos.turismo-ma');

    Route::get('/turismo-mg', function () {
        return view('destinos.pontos-turisticos.TurismoMG');
    })->name('pontos-turisticos.turismo-mg');

    Route::get('/turismo-pr', function () {
        return view('destinos.pontos-turisticos.TurismoPR');
    })->name('pontos-turisticos.turismo-pr');

    Route::get('/turismo-ru', function () {
        return view('destinos.pontos-turisticos.TurismoRU');
    })->name('pontos-turisticos.turismo-ru');

    Route::get('/turismo-rs', function () {
        return view('destinos.pontos-turisticos.TurismoRS');
    })->name('pontos-turisticos.turismo-rs');

    Route::get('/turismo-sc', function () {
        return view('destinos.pontos-turisticos.TurismoSC');
    })->name('pontos-turisticos.turismo-sc');

    Route::get('/turismo-sp', function () {
        return view('destinos.pontos-turisticos.TurismoSP');
    })->name('pontos-turisticos.turismo-sp');

    Route::get('/usina-hidreletrica-itaipu', function () {
        return view('destinos.pontos-turisticos.UsinalHidreletricadeItaipu');
    })->name('pontos-turisticos.usina-hidreletrica-itaipu');
});
Route::get('/pontos-turisticos', function () {
    return view('pontos-turisticos');
})->name('pontos-turisticos.alternative');

// Rotas para hotéis individuais
Route::prefix('destinos/hoteis')->group(function () {
    // Rota para detalhes do hotel via controller
    Route::get('/{id}', [HotelController::class, 'show'])->name('hoteis.show');

    // Rotas específicas para cada hotel
    Route::get('/atlantico-business-rj', function () {
        return view('destinos.hoteis.AtlanticoBussinesRJ');
    })->name('hoteis.atlantico-business-rj');

    Route::get('/atlantico-copacabana-rj', function () {
        return view('destinos.hoteis.AtlanticoCopacabanaRJ');
    })->name('hoteis.atlantico-copacabana-rj');

    Route::get('/atlantico-praia-rj', function () {
        return view('destinos.hoteis.AtlanticoPraiaRJ');
    })->name('hoteis.atlantico-praia-rj');

    Route::get('/blue-tree-towers-ma', function () {
        return view('destinos.hoteis.BlueTreeTowersMA');
    })->name('hoteis.blue-tree-towers-ma');

    Route::get('/capsula-hotel-sp', function () {
        return view('destinos.hoteis.CapsulaHotelsP');
    })->name('hoteis.capsula-hotel-sp');

    Route::get('/colline-rs', function () {
        return view('destinos.hoteis.CollineRS');
    })->name('hoteis.colline-rs');

    Route::get('/continental-rs', function () {
        return view('destinos.hoteis.ContinentalRS');
    })->name('hoteis.continental-rs');

    Route::get('/goldmen-express-pr', function () {
        return view('destinos.hoteis.GoldMenExpressClanortePR');
    })->name('hoteis.goldmen-express-pr');

    Route::get('/gran-villagio-sp', function () {
        return view('destinos.hoteis.GranVillagiosP');
    })->name('hoteis.gran-villagio-sp');

    Route::get('/ingleses-palace-sc', function () {
        return view('destinos.hoteis.InglesesPalacesC');
    })->name('hoteis.ingleses-palace-sc');

    Route::get('/life-infinity-rs', function () {
        return view('destinos.hoteis.LifelnfinityRS');
    })->name('hoteis.life-infinity-rs');

    Route::get('/minas-garden-mg', function () {
        return view('destinos.hoteis.MinasGardenMG');
    })->name('hoteis.minas-garden-mg');

    Route::get('/oceania-park-sc', function () {
        return view('destinos.hoteis.OceaniaParkSC');
    })->name('hoteis.oceania-park-sc');

    Route::get('/por-do-sol-mg', function () {
        return view('destinos.hoteis.PorDoSolMG');
    })->name('hoteis.por-do-sol-mg');

    Route::get('/pousada-agua-marinha-pr', function () {
        return view('destinos.hoteis.PousadaguavarinhaPR');
    })->name('hoteis.pousada-agua-marinha-pr');

    Route::get('/pousada-canto-vigia-sc', function () {
        return view('destinos.hoteis.PousadaCantodaVigiasC');
    })->name('hoteis.pousada-canto-vigia-sc');

    Route::get('/pousada-universal-ma', function () {
        return view('destinos.hoteis.PousadaluhversalMA');
    })->name('hoteis.pousada-universal-ma');

    Route::get('/rios-ma', function () {
        return view('destinos.hoteis.RiosMA');
    })->name('hoteis.rios-ma');

    Route::get('/san-michel-sp', function () {
        return view('destinos.hoteis.SanMichelSP');
    })->name('hoteis.san-michel-sp');

    Route::get('/viale-cataratas-pr', function () {
        return view('destinos.hoteis.VialeCataratasPR');
    })->name('hoteis.viale-cataratas-pr');

    Route::get('/villa-lobos-mg', function () {
        return view('destinos.hoteis.VillaLobosSpaRomantikMG');
    })->name('hoteis.villa-lobos-mg');
});
Route::get('/hoteis', function () {
    return view('hoteis');
})->name('hoteis.alternative');


// Rotas para restaurantes
Route::prefix('destinos/restaurantes')->group(function () {
    // Rota principal de listagem (restaurante.blade.php está na views raiz)
    Route::get('/', function () {
        return view('restaurante');
    })->name('restaurantes.index');

    // Rota para detalhes do restaurante (show.blade.php está em destinos/restaurantes/)
    Route::get('/{id}', [RestauranteController::class, 'show'])->name('restaurantes.show');

    // Rotas para páginas específicas de restaurantes
    Route::get('/alameda', function () {
        return view('destinos.restaurantes.Alameda');
    })->name('restaurantes.alameda');

    Route::get('/bene-da-flauta', function () {
        return view('destinos.restaurantes.BenédaFlauta');
    })->name('restaurantes.bene-da-flauta');

    Route::get('/canoa', function () {
        return view('destinos.restaurantes.Canoa');
    })->name('restaurantes.canoa');

    Route::get('/cantina-pastasciutta', function () {
        return view('destinos.restaurantes.CantinaPastasciutta');
    })->name('restaurantes.cantina-pastasciutta');

    Route::get('/capim-santo', function () {
        return view('destinos.restaurantes.CapimSanto');
    })->name('restaurantes.capim-santo');

    Route::get('/casa-terracota', function () {
        return view('destinos.restaurantes.CasaTerraccia');
    })->name('restaurantes.casa-terracota');

    Route::get('/cipriani', function () {
        return view('destinos.restaurantes.Cipriani');
    })->name('restaurantes.cipriani');

    Route::get('/contos-dos-reis', function () {
        return view('destinos.restaurantes.ContosdosReis');
    })->name('restaurantes.contos-dos-reis');

    Route::get('/dolce-vita', function () {
        return view('destinos.restaurantes.DolceVita');
    })->name('restaurantes.dolce-vita');

    Route::get('/el-fuego', function () {
        return view('destinos.restaurantes.ElFuego');
    })->name('restaurantes.el-fuego');

    Route::get('/fasano', function () {
        return view('destinos.restaurantes.Fasano');
    })->name('restaurantes.fasano');

    Route::get('/gastro-pub', function () {
        return view('destinos.restaurantes.GastroPub');
    })->name('restaurantes.gastro-pub');

    Route::get('/jamile', function () {
        return view('destinos.restaurantes.Jamile');
    })->name('restaurantes.jamile');

    Route::get('/la-mafia-trattoria', function () {
        return view('destinos.restaurantes.LaMafiaTrattoria');
    })->name('restaurantes.la-mafia-trattoria');

    Route::get('/mangue', function () {
        return view('destinos.restaurantes.Mangue');
    })->name('restaurantes.mangue');

    Route::get('/olivia-cucina', function () {
        return view('destinos.restaurantes.OliviaCucina');
    })->name('restaurantes.olivia-cucina');

    Route::get('/oro', function () {
        return view('destinos.restaurantes.Oro');
    })->name('restaurantes.oro');

    Route::get('/porto-canoas', function () {
        return view('destinos.restaurantes.PortoCanoas');
    })->name('restaurantes.porto-canoas');

    Route::get('/rafain', function () {
        return view('destinos.restaurantes.Rafain');
    })->name('restaurantes.rafain');

    // Rotas para restaurantes por estado
    Route::get('/ma', function () {
        return view('destinos.restaurantes.RestauranteMA');
    })->name('restaurantes.ma');

    Route::get('/mg', function () {
        return view('destinos.restaurantes.RestauranteMG');
    })->name('restaurantes.mg');

    Route::get('/pr', function () {
        return view('destinos.restaurantes.RestaurantePR');
    })->name('restaurantes.pr');

    Route::get('/rl', function () {
        return view('destinos.restaurantes.RestauranteRL');
    })->name('restaurantes.rl');

    Route::get('/rs', function () {
        return view('destinos.restaurantes.RestauranteRS');
    })->name('restaurantes.rs');

    Route::get('/sc', function () {
        return view('destinos.restaurantes.RestauranteSC');
    })->name('restaurantes.sc');

    Route::get('/sp', function () {
        return view('destinos.restaurantes.RestauranteSP');
    })->name('restaurantes.sp');

    Route::get('/terraco-italia', function () {
        return view('destinos.restaurantes.TerraçoItália');
    })->name('restaurantes.terraco-italia');

    Route::get('/terral', function () {
        return view('destinos.restaurantes.Terral');
    })->name('restaurantes.terral');
});

// Rota para a view restaurante.blade.php que está na raiz das views
// Esta é uma rota alternativa caso você queira manter o arquivo na raiz
Route::get('/restaurantes', function () {
    return view('restaurante');
})->name('restaurantes.alternative');

// Rotas de login admin "escondido"
Route::get('/admin-login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin-login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('/admin-password', [AdminLoginController::class, 'showPasswordForm'])->name('admin.password');
Route::post('/admin-password', [AdminLoginController::class, 'verifyPassword'])->name('admin.password.verify');
Route::middleware(['auth', 'admin'])->get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->name('admin.dashboard');
