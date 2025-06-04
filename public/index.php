<?php
// Iniciar sessão para CSRF e mensagens
session_start();

// Forçar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir arquivo de configuração do banco
if (!file_exists('../config/database.php')) {
    error_log("Erro: database.php não foi encontrado.");
    die("Erro: Arquivo de configuração do banco de dados não encontrado.");
}
require_once '../config/database.php';

// Incluir todos os controladores
$controllers = [
    '../controllers/UsuarioController.php',
    '../controllers/AdmController.php',
    '../controllers/ViagemController.php',
    '../controllers/RestauranteController.php',
    '../controllers/HotelController.php',
    '../controllers/PontoTuristicoController.php',
    '../controllers/FeedbackController.php',
    '../controllers/ApiController.php',
    '../controllers/PontosController.php'
];

foreach ($controllers as $controller) {
    if (file_exists($controller)) {
        require_once $controller;
    } else {
        error_log("Erro: Controlador não encontrado: $controller");
        die("Erro: Controlador não encontrado: $controller");
    }
}

// Função para gerar e verificar tokens CSRF
function generateCsrfToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Depurar URL
$rawRequest = $_SERVER['REQUEST_URI'];
error_log("Raw REQUEST_URI: $rawRequest");

// Normalizar URL
$basePath = '/bella_back_novo/public/';
$request = parse_url($rawRequest, PHP_URL_PATH);
$request = str_replace($basePath, '/', $request);
$request = rtrim($request, '/') . '/';
error_log("Normalized Request: $request");

// Testar conexão com o banco
$database = new Database();
if (!$database->getConnection()) {
    error_log("Erro: Falha na conexão com o banco de dados.");
    die("Erro: Não foi possível conectar ao banco de dados. Verifique as credenciais em database.php.");
}

// Roteamento
try {
    switch ($request) {
        // Página inicial
        case '/':
        case '/bella_back_novo/public/':
            error_log("Rota: Página inicial (UsuarioController::showForm)");
            $controller = new UsuarioController();
            $controller->showForm();
            break;

        // Usuário
        case '/usuario_form/':
            error_log("Rota: usuario_form");
            $controller = new UsuarioController();
            $controller->showForm();
            break;
        case '/save-usuario/':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                error_log("Rota: save-usuario");
                $controller = new UsuarioController();
                if (method_exists($controller, 'saveUsuario')) {
                    $controller->saveUsuario();
                } else {
                    throw new Exception("Método saveUsuario não encontrado em UsuarioController");
                }
            } else {
                throw new Exception("Método HTTP inválido para save-usuario: " . $_SERVER['REQUEST_METHOD']);
            }
            break;
        case '/list-usuario/':
            error_log("Rota: list-usuario");
            $controller = new UsuarioController();
            if (method_exists($controller, 'listUsuario')) {
                $controller->listUsuario();
            } else {
                throw new Exception("Método listUsuario não encontrado em UsuarioController");
            }
            break;

        // ADM
        case '/adm_form/':
            error_log("Rota: adm_form");
            $controller = new AdmController();
            $controller->showForm();
            break;
        case '/save-adm/':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                error_log("Rota: save-adm");
                $controller = new AdmController();
                $controller->saveAdm();
            } else {
                throw new Exception("Método HTTP inválido para save-adm: " . $_SERVER['REQUEST_METHOD']);
            }
            break;
        case '/list-adm/':
            error_log("Rota: list-adm");
            $controller = new AdmController();
            $controller->listadm();
            break;

        // Viagem
        case '/viagem_form/':
            error_log("Rota: viagem_form");
            $controller = new ViagemController();
            $controller->showForm();
            break;
        case '/save-viagem/':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                error_log("Rota: save-viagem");
                $controller = new ViagemController();
                $controller->saveViagem();
            } else {
                throw new Exception("Método HTTP inválido para save-viagem: " . $_SERVER['REQUEST_METHOD']);
            }
            break;
        case '/list-viagem/':
            error_log("Rota: list-viagem");
            $controller = new ViagemController();
            $controller->listViagem();
            break;
        case '/delete-viagem/':
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                error_log("Rota: delete-viagem");
                $controller = new ViagemController();
                $controller->deleteViagem();
            } else {
                throw new Exception("Método HTTP inválido ou ID ausente para delete-viagem");
            }
            break;

        // Restaurante
        case '/restaurante_form/':
            error_log("Rota: restaurante_form");
            require_once '../views/restaurante_form.php';
            break;
        case '/save-restaurante/':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                error_log("Rota: save-restaurante");
                $controller = new RestauranteController();
                if (method_exists($controller, 'saveRestaurante')) {
                    $controller->saveRestaurante();
                } else {
                    throw new Exception("Método saveRestaurante não encontrado em RestauranteController");
                }
            } else {
                throw new Exception("Método HTTP inválido para save-restaurante: " . $_SERVER['REQUEST_METHOD']);
            }
            break;
        case '/list-restaurante/':
            error_log("Rota: list-restaurante");
            $controller = new RestauranteController();
            if (method_exists($controller, 'listRestaurante')) {
                $controller->listRestaurante();
            } else {
                throw new Exception("Método listRestaurante não encontrado em RestauranteController");
            }
            break;
        case '/delete-restaurante/':
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                error_log("Rota: delete-restaurante");
                $controller = new RestauranteController();
                if (method_exists($controller, 'deleteRestaurante')) {
                    $controller->deleteRestaurante();
                } else {
                    throw new Exception("Método deleteRestaurante não encontrado em RestauranteController");
                }
            } else {
                throw new Exception("Método HTTP inválido ou ID ausente para delete-restaurante");
            }
            break;

        // Hotel
        case '/hotel_form/':
            error_log("Rota: hotel_form");
            $controller = new HotelController();
            if (method_exists($controller, 'showForm')) {
                $controller->showForm();
            } else {
                throw new Exception("Método showForm não encontrado em HotelController");
            }
            break;
        case '/save-hotel/':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                error_log("Rota: save-hotel");
                $controller = new HotelController();
                if (method_exists($controller, 'saveHotel')) {
                    $controller->saveHotel();
                } else {
                    throw new Exception("Método saveHotel não encontrado em HotelController");
                }
            } else {
                throw new Exception("Método HTTP inválido para save-hotel: " . $_SERVER['REQUEST_METHOD']);
            }
            break;
        case '/list-hotel/':
            error_log("Rota: list-hotel");
            $controller = new HotelController();
            if (method_exists($controller, 'listHotel')) {
                $controller->listHotel();
            } else {
                throw new Exception("Método listHotel não encontrado em HotelController");
            }
            break;
        case '/delete-hotel/':
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                error_log("Rota: delete-hotel");
                $controller = new HotelController();
                if (method_exists($controller, 'deleteHotel')) {
                    $controller->deleteHotel();
                } else {
                    throw new Exception("Método deleteHotel não encontrado em HotelController");
                }
            } else {
                throw new Exception("Método HTTP inválido ou ID ausente para delete-hotel");
            }
            break;

        // Ponto Turístico
        case '/pontoturistico_form/':
            error_log("Rota: pontoturistico_form");
            $controller = new PontoTuristicoController();
            $controller->showForm();
            break;
        case '/save-pontoturistico/':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                error_log("Rota: save-pontoturistico");
                $controller = new PontoTuristicoController();
                if (method_exists($controller, 'savePontoTuristico')) {
                    $controller->savePontoTuristico();
                } else {
                    throw new Exception("Método savePontoTuristico não encontrado em PontoTuristicoController");
                }
            } else {
                throw new Exception("Método HTTP inválido para save-pontoturistico: " . $_SERVER['REQUEST_METHOD']);
            }
            break;
        case '/list-pontoturistico/':
            error_log("Rota: list-pontoturistico");
            $controller = new PontoTuristicoController();
            if (method_exists($controller, 'listPontoTuristico')) {
                $controller->listPontoTuristico();
            } else {
                throw new Exception("Método listPontoTuristico não encontrado em PontoTuristicoController");
            }
            break;

        // Feedback
        case '/feedback_form/':
            error_log("Rota: feedback_form");
            $controller = new FeedbackController();
            $controller->showForm();
            break;
        case '/save-feedback/':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                error_log("Rota: save-feedback");
                $controller = new FeedbackController();
                $controller->saveFeedback();
            } else {
                throw new Exception("Método HTTP inválido para save-feedback: " . $_SERVER['REQUEST_METHOD']);
            }
            break;
        case '/list-feedback/':
            error_log("Rota: list-feedback");
            $controller = new FeedbackController();
            $controller->listfeedback();
            break;

        // API
        case '/api_form/':
            error_log("Rota: api_form");
            require_once '../views/api_form.php';
            break;
        case '/save-api/':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                error_log("Rota: save-api");
                $controller = new ApiController();
                if (method_exists($controller, 'saveApi')) {
                    $controller->saveApi();
                } else {
                    throw new Exception("Método saveApi não encontrado em ApiController");
                }
            } else {
                throw new Exception("Método HTTP inválido para save-api: " . $_SERVER['REQUEST_METHOD']);
            }
            break;
        case '/list-api/':
            error_log("Rota: list-api");
            $controller = new ApiController();
            if (method_exists($controller, 'listApi')) {
                $controller->listApi();
            } else {
                throw new Exception("Método listApi não encontrado em ApiController");
            }
            break;
        case '/delete-api/':
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                error_log("Rota: delete-api");
                $controller = new ApiController();
                if (method_exists($controller, 'deleteApi')) {
                    $controller->deleteApi();
                } else {
                    throw new Exception("Método deleteApi não encontrado em ApiController");
                }
            } else {
                throw new Exception("Método HTTP inválido ou ID ausente para delete-api");
            }
            break;

        // Pontos
        case '/ponto_form/':
            error_log("Rota: ponto_form");
            require_once '../views/ponto_form.php';
            break;
        case '/save-ponto/':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                error_log("Rota: save-ponto");
                $controller = new PontosController();
                if (method_exists($controller, 'savePonto')) {
                    $controller->savePonto();
                } else {
                    throw new Exception("Método savePonto não encontrado em PontosController");
                }
            } else {
                throw new Exception("Método HTTP inválido para save-ponto: " . $_SERVER['REQUEST_METHOD']);
            }
            break;
        case '/list-ponto/':
            error_log("Rota: list-ponto");
            $controller = new PontosController();
            if (method_exists($controller, 'listPonto')) {
                $controller->listPonto();
            } else {
                throw new Exception("Método listPonto não encontrado em PontosController");
            }
            break;
        case '/delete-ponto/':
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                error_log("Rota: delete-ponto");
                $controller = new PontosController();
                if (method_exists($controller, 'deletePonto')) {
                    $controller->deletePonto();
                } else {
                    throw new Exception("Método deletePonto não encontrado em PontosController");
                }
            } else {
                throw new Exception("Método HTTP inválido ou ID ausente para delete-ponto");
            }
            break;

        default:
            error_log("Rota não encontrada: $request");
            http_response_code(404);
            if (file_exists('../views/404.php')) {
                require_once '../views/404.php';
            } else {
                echo "<h2>404 - Página Não Encontrada</h2><p>A página solicitada não existe.</p><a href='/bella_back_novo/public/'>Voltar para a página inicial</a>";
            }
            break;
    }
} catch (Exception $e) {
    error_log("Erro no index.php: " . $e->getMessage());
    http_response_code(500);
    echo "Erro interno do servidor: " . htmlspecialchars($e->getMessage());
}   