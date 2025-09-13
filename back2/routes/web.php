<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\HotelController;

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

Route::get('/pontos-turisticos', function () {
    return view('pontos-turisticos');
})->name('pontos-turisticos');

// Rotas para hotéis
Route::prefix('destinos/hoteis')->group(function () {
    // Rota principal de listagem
    Route::get('/', function () {
        return view('hoteis');
    })->name('hoteis.index');

    // Rota para detalhes do hotel
    Route::get('/{id}', [HotelController::class, 'show'])->name('hoteis.show');

    // Rotas para páginas específicas de hotéis (baseado na lista da imagem)
    Route::get('/hotel-atlantico-business-rj', function () {
        return view('destinos.hoteis.Hotel_Atlantico_BussinesRJ');
    })->name('hoteis.atlantico-business-rj');

    Route::get('/hotel-atlantico-copacabana-rj', function () {
        return view('destinos.hoteis.Hotel_Atlantico_CopacabanaRJ');
    })->name('hoteis.atlantico-copacabana-rj');

    Route::get('/hotel-atlantico-praia-rj', function () {
        return view('destinos.hoteis.Hotel_Atlantico_PraiaRJ');
    })->name('hoteis.atlantico-praia-rj');

    Route::get('/hotel-blue-tree-towers-ma', function () {
        return view('destinos.hoteis.Hotel_Blue_Tree_TowersMA');
    })->name('hoteis.blue-tree-towers-ma');

    Route::get('/hotel-capsula-sp', function () {
        return view('destinos.hoteis.Hotel_Capsula_HotelSP');
    })->name('hoteis.capsula-sp');

    Route::get('/hotel-colline-rs', function () {
        return view('destinos.hoteis.Hotel_CollineRS');
    })->name('hoteis.colline-rs');

    Route::get('/hotel-continental-rs', function () {
        return view('destinos.hoteis.Hotel_ContinentalRS');
    })->name('hoteis.continental-rs');

    Route::get('/hotel-goldmen-express-pr', function () {
        return view('destinos.hoteis.Hotel_GoldMen_Express_CianortePR');
    })->name('hoteis.goldmen-express-pr');

    Route::get('/hotel-gran-villagio-sp', function () {
        return view('destinos.hoteis.Hotel_Gran_VillagioSP');
    })->name('hoteis.gran-villagio-sp');

    Route::get('/hotel-ingleses-palace-sc', function () {
        return view('destinos.hoteis.Hotel_Ingleses_PalacesC');
    })->name('hoteis.ingleses-palace-sc');

    Route::get('/hotel-life-infinity-rs', function () {
        return view('destinos.hoteis.Hotel_Life_InfinityRS');
    })->name('hoteis.life-infinity-rs');

    Route::get('/hotel-minas-garden-mg', function () {
        return view('destinos.hoteis.Hotel_Minas_GardenMG');
    })->name('hoteis.minas-garden-mg');

    Route::get('/hotel-oceania-park-sc', function () {
        return view('destinos.hoteis.Hotel_Oceania_ParksC');
    })->name('hoteis.oceania-park-sc');

    Route::get('/hotel-por-do-sol-mg', function () {
        return view('destinos.hoteis.Hotel_Por_Do_SolMG');
    })->name('hoteis.por-do-sol-mg');

    Route::get('/hotel-pousada-agua-marinha-pr', function () {
        return view('destinos.hoteis.Hotel_Pousada_Agua_MarinhaPR');
    })->name('hoteis.pousada-agua-marinha-pr');

    Route::get('/hotel-pousada-canto-vigia-sc', function () {
        return view('destinos.hoteis.Hotel_Pousada_Canto_da_VigiasC');
    })->name('hoteis.pousada-canto-vigia-sc');

    Route::get('/hotel-pousada-universal-ma', function () {
        return view('destinos.hoteis.Hotel_Pousada_UniversalMA');
    })->name('hoteis.pousada-universal-ma');

    Route::get('/hotel-rios-ma', function () {
        return view('destinos.hoteis.Hotel_RiosMA');
    })->name('hoteis.rios-ma');

    Route::get('/hotel-san-michel-sp', function () {
        return view('destinos.hoteis.Hotel_San_MichelSP');
    })->name('hoteis.san-michel-sp');

    Route::get('/hotel-viale-cataratas-pr', function () {
        return view('destinos.hoteis.Hotel_Viale_CataratasPR');
    })->name('hoteis.viale-cataratas-pr');

    Route::get('/hotel-villa-lobos-mg', function () {
        return view('destinos.hoteis.Hotel_Villa_Lobos_Spa_RomanitkMG');
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
