<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestauranteController extends Controller
{
    // Array com dados dos restaurantes (igual ao do JavaScript)
    private $restaurantes = [
        [
            'id' => 1,
            'nome' => "Jamile",
            'tipos' => ["brasileira", "contemporanea", "gourmet"],
            'avaliacao' => 4.9,
            'endereco' => "R. Treze de Maio, 647 - Bela Vista, São Paulo",
            'horario' => "Segunda a Domingo: 12:00 - 23:00",
            'preco' => "luxo",
            'precoTexto' => "$$$$",
            'cidade' => "sao-paulo",
            'imagem' => "https://i.ibb.co/wNDYyrGF/image.png",
            'badge' => "Premium",
            'promocao' => false,
            'link' => "jamile",
            'lat' => -23.5505,
            'lng' => -46.6333
        ],
        [
            'id' => 2,
            'nome' => "Casa Terracota",
            'tipos' => ["gourmet", "inovador", "elegante"],
            'avaliacao' => 4.7,
            'endereco' => "Av. das Flores, 456 - Gramado, RS",
            'horario' => "Terça a Sábado: 19:00 - 23:00",
            'preco' => "alto",
            'precoTexto' => "$$$",
            'cidade' => "rio-grande-do-sul",
            'imagem' => "https://i.ibb.co/sJyf79Pw/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "casa-terracota",
            'lat' => -29.3739,
            'lng' => -50.8811
        ],
        [
            'id' => 3,
            'nome' => "El Fuego",
            'tipos' => ["fondue", "carne", "queijo"],
            'avaliacao' => 4.6,
            'endereco' => "Rua dos Pinheiros, 789 - Gramado, RS",
            'horario' => "Quarta a Domingo: 18:00 - 22:00",
            'preco' => "alto",
            'precoTexto' => "$$$",
            'cidade' => "rio-grande-do-sul",
            'imagem' => "https://i.ibb.co/p6CszR4h/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "el-fuego",
            'lat' => -29.3749,
            'lng' => -50.8821
        ],
        [
            'id' => 4,
            'nome' => "Oro",
            'tipos' => ["brasileira", "gourmet", "contemporanea"],
            'avaliacao' => 4.9,
            'endereco' => "Av. Gen. San Martin, 889 - Leblon, Rio de Janeiro",
            'horario' => "Terça a Sábado: 19:00 - 23:00",
            'preco' => "luxo",
            'precoTexto' => "$$$$",
            'cidade' => "rio-de-janeiro",
            'imagem' => "https://i.ibb.co/wNDYyrGF/image.png",
            'badge' => "Premium",
            'promocao' => false,
            'link' => "oro",
            'lat' => -22.9792,
            'lng' => -43.2236
        ],
        [
            'id' => 5,
            'nome' => "Cipriani",
            'tipos' => ["italiana", "contemporanea", "gourmet"],
            'avaliacao' => 4.9,
            'endereco' => "Av. Atlântica, 1702 - Copacabana, Rio de Janeiro",
            'horario' => "Segunda a Domingo: 19:00 - 21:00",
            'preco' => "luxo",
            'precoTexto' => "$$$$",
            'cidade' => "rio-de-janeiro",
            'imagem' => "https://i.ibb.co/NnswBt5Q/image.png",
            'badge' => "Premium",
            'promocao' => false,
            'link' => "cipriani",
            'lat' => -22.9711,
            'lng' => -43.1828
        ],
        [
            'id' => 6,
            'nome' => "Fasano",
            'tipos' => ["italiana", "gourmet", "contemporanea"],
            'avaliacao' => 4.9,
            'endereco' => "Av. Vieira Souto, 80 - Ipanema, Rio de Janeiro",
            'horario' => "Segunda a Domingo: 12:00 - 23:00",
            'preco' => "luxo",
            'precoTexto' => "$$$$",
            'cidade' => "rio-de-janeiro",
            'imagem' => "https://i.ibb.co/Rk9CXfxM/image.png",
            'badge' => "Premium",
            'promocao' => false,
            'link' => "fasano",
            'lat' => -22.9785,
            'lng' => -43.2089
        ],
        [
            'id' => 7,
            'nome' => "Terraço Itália",
            'tipos' => ["italiana", "gourmet"],
            'avaliacao' => 4.8,
            'endereco' => "Rua Floriano Peixoto, 158, São Paulo, SP",
            'horario' => "Segunda a Sexta: 11:00 - 19:30",
            'preco' => "alto",
            'precoTexto' => "$$$",
            'cidade' => "sao-paulo",
            'imagem' => "https://i.ibb.co/n8syZSDs/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "terraco-italia",
            'lat' => -23.5505,
            'lng' => -46.6333
        ],
        [
            'id' => 8,
            'nome' => "Porto Canoas",
            'tipos' => ["frutos-do-mar", "peixes"],
            'avaliacao' => 4.5,
            'endereco' => "Av. das Cataratas, 202 - Foz do Iguaçu, PR",
            'horario' => "Todos os dias: 11:00 - 23:00",
            'preco' => "alto",
            'precoTexto' => "$$$",
            'cidade' => "parana",
            'imagem' => "https://i.ibb.co/YBXdWS3Q/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "porto-canoas",
            'lat' => -25.5478,
            'lng' => -54.5873
        ],
        [
            'id' => 9,
            'nome' => "Rafain",
            'tipos' => ["churrasco", "cultural"],
            'avaliacao' => 4.3,
            'endereco' => "Rua das Danças, 303 - Foz do Iguaçu, PR",
            'horario' => "Quinta a Domingo: 19:00 - 00:00",
            'preco' => "medio",
            'precoTexto' => "$$",
            'cidade' => "parana",
            'imagem' => "https://i.ibb.co/B50ZTNgP/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "rafain",
            'lat' => -25.5488,
            'lng' => -54.5883
        ],
        [
            'id' => 10,
            'nome' => "La Mafia Trattoria",
            'tipos' => ["italiana", "tradicional"],
            'avaliacao' => 4.4,
            'endereco' => "Rua das Tradições, 101 - Foz do Iguaçu, PR",
            'horario' => "Segunda a Sábado: 18:00 - 23:00",
            'preco' => "medio",
            'precoTexto' => "$$",
            'cidade' => "parana",
            'imagem' => "https://i.ibb.co/ZpcfkT9f/120736342-945661575912829-652691859883304712-n.jpg",
            'badge' => null,
            'promocao' => false,
            'link' => "la-mafia-trattoria",
            'lat' => -25.5498,
            'lng' => -54.5893
        ],
        [
            'id' => 11,
            'nome' => "Bené da Flauta",
            'tipos' => ["tradicional", "brasileira"],
            'avaliacao' => 4.5,
            'endereco' => "Rua das Tradições, 101 - Ouro Preto, MG",
            'horario' => "Segunda a Sábado: 18:00 - 23:00",
            'preco' => "medio",
            'precoTexto' => "$$",
            'cidade' => "minas-gerais",
            'imagem' => "https://lh3.googleusercontent.com/gps-cs-s/AC9h4npAFzSInmryDEoV82CI7lJHUv9hBubTuYzOLuzfpf9xlrPt4hRDz-6oxNZB-2zXsuoe1MA3qMje5Z_3iI6TyIiD1spmJd98YSTItd3J_ittauvVea60ljzy2YnL1gEo2T0gmZLnWA=s680-w680-h510",
            'badge' => null,
            'promocao' => false,
            'link' => "bene-da-flauta",
            'lat' => -20.3822,
            'lng' => -43.5039
        ],
        [
            'id' => 12,
            'nome' => "Gastro Pub",
            'tipos' => ["moderna", "pub"],
            'avaliacao' => 4.4,
            'endereco' => "Rua dos Ingleses, 118 - Ouro Preto, MG",
            'horario' => "Segunda a Sábado: 12:00 - 23:00",
            'preco' => "medio",
            'precoTexto' => "$$",
            'cidade' => "minas-gerais",
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/24/c6/4c/e4/salao-1.jpg?w=900&h=500&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "gastro-pub",
            'lat' => -20.3832,
            'lng' => -43.5049
        ],
        [
            'id' => 13,
            'nome' => "Contos dos Reis",
            'tipos' => ["tradicional", "brasileira"],
            'avaliacao' => 4.3,
            'endereco' => "Rua das Danças, 303 - Ouro Preto, MG",
            'horario' => "Quinta a Domingo: 19:00 - 00:00",
            'preco' => "medio",
            'precoTexto' => "$$",
            'cidade' => "minas-gerais",
            'imagem' => "https://lh3.googleusercontent.com/p/AF1QipOkHJiEMiwiP1IJFBn9O1wZcrXG_xcyUUoqn-FW=s680-w680-h510",
            'badge' => null,
            'promocao' => false,
            'link' => "contos-dos-reis",
            'lat' => -20.3842,
            'lng' => -43.5059
        ],
        [
            'id' => 14,
            'nome' => "Mangue",
            'tipos' => ["regional", "frutos-do-mar"],
            'avaliacao' => 4.5,
            'endereco' => "Rua das Tradições, 101 - Barreirinhas, MA",
            'horario' => "Segunda a Sábado: 18:00 - 23:00",
            'preco' => "medio",
            'precoTexto' => "$$",
            'cidade' => "maranhao",
            'imagem' => "https://i.ibb.co/wNDYyrGF/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "mangue",
            'lat' => -2.7478,
            'lng' => -42.8297
        ],
        [
            'id' => 15,
            'nome' => "A Canoa",
            'tipos' => ["regional", "frutos-do-mar"],
            'avaliacao' => 4.4,
            'endereco' => "Rua dos Ingleses, 118 - Barreirinhas, MA",
            'horario' => "Segunda a Sábado: 12:00 - 23:00",
            'preco' => "medio",
            'precoTexto' => "$$",
            'cidade' => "maranhao",
            'imagem' => "https://i.ibb.co/NnswBt5Q/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "canoa",
            'lat' => -2.7488,
            'lng' => -42.8307
        ],
        [
            'id' => 16,
            'nome' => "Terral",
            'tipos' => ["regional", "frutos-do-mar"],
            'avaliacao' => 4.3,
            'endereco' => "Rua das Danças, 303 - Barreirinhas, MA",
            'horario' => "Quinta a Domingo: 19:00 - 00:00",
            'preco' => "medio",
            'precoTexto' => "$$",
            'cidade' => "maranhao",
            'imagem' => "https://i.ibb.co/Rk9CXfxM/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "terral",
            'lat' => -2.7498,
            'lng' => -42.8317
        ],
        [
            'id' => 17,
            'nome' => "Alameda - Jurerê",
            'tipos' => ["contemporânea", "gourmet"],
            'avaliacao' => 4.7,
            'endereco' => "Rua das Praias, 101 - Florianópolis, SC",
            'horario' => "Segunda a Domingo: 18:00 - 23:00",
            'preco' => "alto",
            'precoTexto' => "$$$",
            'cidade' => "santa-catarina",
            'imagem' => "https://i.ibb.co/cGRyypv/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "alameda",
            'lat' => -27.4500,
            'lng' => -48.5490
        ],
        [
            'id' => 18,
            'nome' => "Olivia Cucina",
            'tipos' => ["italiana", "tradicional"],
            'avaliacao' => 4.6,
            'endereco' => "Rua dos Ingleses, 118 - Florianópolis, SC",
            'horario' => "Segunda a Sábado: 12:00 - 23:00",
            'preco' => "medio",
            'precoTexto' => "$$",
            'cidade' => "santa-catarina",
            'imagem' => "https://i.ibb.co/Y4KQnVm6/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "olivia-cucina",
            'lat' => -27.4510,
            'lng' => -48.5500
        ],
        [
            'id' => 19,
            'nome' => "Dolce Vita",
            'tipos' => ["italiana", "gourmet"],
            'avaliacao' => 4.5,
            'endereco' => "Rua das Danças, 303 - Florianópolis, SC",
            'horario' => "Quinta a Domingo: 19:00 - 00:00",
            'preco' => "alto",
            'precoTexto' => "$$$",
            'cidade' => "santa-catarina",
            'imagem' => "https://i.ibb.co/nqHsNL4R/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "dolce-vita",
            'lat' => -27.4520,
            'lng' => -48.5510
        ],
        [
            'id' => 20,
            'nome' => "Capim Santo",
            'tipos' => ["brasileira", "contemporânea"],
            'avaliacao' => 4.5,
            'endereco' => "Av. Brig. Faria Lima, 2705 - Jardim Paulistano, São Paulo - SP, 01451-000",
            'horario' => "Terça a Segunda: 10:00 - 18:00",
            'preco' => "alto",
            'precoTexto' => "$$$",
            'cidade' => "sao-paulo",
            'imagem' => "https://i.ibb.co/B2sZMYRW/image.png",
            'badge' => null,
            'promocao' => false,
            'link' => "capim-santo",
            'lat' => -23.5688,
            'lng' => -46.6824
        ]
    ];

    public function show($id)
    {
        // Encontra o restaurante pelo ID
        $restaurante = null;
        foreach ($this->restaurantes as $r) {
            if ($r['id'] == $id) {
                $restaurante = $r;
                break;
            }
        }

        // Se não encontrar, retorna erro 404
        if (!$restaurante) {
            abort(404, 'Restaurante não encontrado');
        }

        // Converte array para objeto para facilitar o uso na view
        return view('destinos.restaurantes.show', ['restaurante' => (object)$restaurante]);
    }

    // Método para API (caso precise no futuro)
    public function index(Request $request)
    {
        // Filtros
        $filtrados = $this->restaurantes;

        if ($request->has('tipo_cozinha') && $request->tipo_cozinha) {
            $filtrados = array_filter($filtrados, function($r) use ($request) {
                return in_array($request->tipo_cozinha, $r['tipos']);
            });
        }

        if ($request->has('preco') && $request->preco) {
            $filtrados = array_filter($filtrados, function($r) use ($request) {
                return $r['preco'] === $request->preco;
            });
        }

        if ($request->has('avaliacao') && $request->avaliacao) {
            $filtrados = array_filter($filtrados, function($r) use ($request) {
                return $r['avaliacao'] >= floatval($request->avaliacao);
            });
        }

        if ($request->has('localizacao') && $request->localizacao) {
            $filtrados = array_filter($filtrados, function($r) use ($request) {
                return $r['cidade'] === $request->localizacao;
            });
        }

        // Se for requisição AJAX, retorna JSON
        if ($request->ajax()) {
            return response()->json(array_values($filtrados));
        }

        // Se for requisição normal, retorna a view principal
        return view('restaurante');
    }
}
