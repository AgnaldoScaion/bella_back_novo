<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    // Array com dados dos hotéis (baseado na imagem fornecida)
    private $hoteis = [
        [
            'id' => 1,
            'nome' => "Capsula Hotel",
            'avaliacao' => 4.8,
            'localizacao' => "Consolação, São Paulo",
            'preco' => 650,
            'precoTexto' => "R$ 650",
            'cidade' => "sp",
            'imagem' => "https://i.ibb.co/VYFJ1p3n/capsula-hotel.jpg",
            'avaliacoes' => 2378,
            'link' => "capsula-hotel-sp",
            'categoria' => "medio",
            'lat' => -23.5505,
            'lng' => -46.6333,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Ar Condicionado", "Café da Manhã"]
        ],
        [
            'id' => 2,
            'nome' => "Hotel Atlântico Business",
            'avaliacao' => 4.9,
            'localizacao' => "Dantas, Rio de Janeiro",
            'preco' => 850,
            'precoTexto' => "R$ 850",
            'cidade' => "rj",
            'imagem' => "https://i.ibb.co/7NYJH7rM/Hotel-atalntico.webp",
            'avaliacoes' => 1975,
            'link' => "atlantico-business-rj",
            'categoria' => "premium",
            'lat' => -22.9068,
            'lng' => -43.1729,
            'estrelas' => 5,
            'comodidades' => ["Wi-Fi", "Piscina", "Academia", "Restaurante"]
        ],
        [
            'id' => 3,
            'nome' => "Minas Garden Hotel",
            'avaliacao' => 4.7,
            'localizacao' => "Poços de Caldas, Minas Gerais",
            'preco' => 550,
            'precoTexto' => "R$ 550",
            'cidade' => "mg",
            'imagem' => "https://i.ibb.co/3yLL6n1c/Minas-Garden-Hotel.jpg",
            'avaliacoes' => 1526,
            'link' => "minas-garden-mg",
            'categoria' => "medio",
            'lat' => -21.7874,
            'lng' => -46.5693,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Estacionamento", "Café da Manhã"]
        ],
        [
            'id' => 4,
            'nome' => "Blue Tree Towers",
            'avaliacao' => 4.8,
            'localizacao' => "São Luís, Maranhão",
            'preco' => 580,
            'precoTexto' => "R$ 580",
            'cidade' => "ma",
            'imagem' => "https://i.ibb.co/tTWQd0GW/Blue-Tree-Towers.jpg",
            'avaliacoes' => 3494,
            'link' => "blue-tree-ma",
            'categoria' => "medio",
            'lat' => -2.5307,
            'lng' => -44.3068,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Piscina", "Academia", "Restaurante"]
        ],
        [
            'id' => 5,
            'nome' => "Ingleses Palace Hotel",
            'avaliacao' => 4.9,
            'localizacao' => "Florianópolis, Santa Catarina",
            'preco' => 980,
            'precoTexto' => "R$ 980",
            'cidade' => "sc",
            'imagem' => "https://i.ibb.co/1YHgJM9K/ingleses-palace-hotel.jpg",
            'avaliacoes' => 1550,
            'link' => "ingleses-palace-sc",
            'categoria' => "premium",
            'lat' => -27.5954,
            'lng' => -48.5480,
            'estrelas' => 5,
            'comodidades' => ["Wi-Fi", "Piscina", "Spa", "Restaurante", "Praia Privativa"]
        ],
        [
            'id' => 6,
            'nome' => "Hotel Colline de France-Gramado",
            'avaliacao' => 4.6,
            'localizacao' => "Gramado, Rio Grande do Sul",
            'preco' => 480,
            'precoTexto' => "R$ 480",
            'cidade' => "rs",
            'imagem' => "https://i.ibb.co/VWH7mcc8/hotel-colline-france-gramado.jpg",
            'avaliacoes' => 1526,
            'link' => "colline-france-rs",
            'categoria' => "medio",
            'lat' => -29.3739,
            'lng' => -50.8811,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Lareira", "Restaurante", "Estacionamento"]
        ],
        [
            'id' => 7,
            'nome' => "Hotel Atlântico Copacabana",
            'avaliacao' => 4.6,
            'localizacao' => "Copacabana, Rio de Janeiro",
            'preco' => 880,
            'precoTexto' => "R$ 880",
            'cidade' => "rj",
            'imagem' => "https://i.ibb.co/V0DXvrSj/hotel-atlantico-business.jpg",
            'avaliacoes' => 6362,
            'link' => "atlantico-copacabana-rj",
            'categoria' => "premium",
            'lat' => -22.9711,
            'lng' => -43.1828,
            'estrelas' => 5,
            'comodidades' => ["Wi-Fi", "Piscina", "Academia", "Restaurante", "Vista para o Mar"]
        ],
        [
            'id' => 8,
            'nome' => "Hotel Atlântico Praia",
            'avaliacao' => 4.8,
            'localizacao' => "Copacabana, Rio de Janeiro",
            'preco' => 780,
            'precoTexto' => "R$ 780",
            'cidade' => "rj",
            'imagem' => "https://i.ibb.co/NgCYTM38/praia-hotel.jpg",
            'avaliacoes' => 3695,
            'link' => "atlantico-praia-rj",
            'categoria' => "premium",
            'lat' => -22.9721,
            'lng' => -43.1838,
            'estrelas' => 5,
            'comodidades' => ["Wi-Fi", "Piscina", "Restaurante", "Vista para o Mar"]
        ],
        [
            'id' => 9,
            'nome' => "Hotel Continental",
            'avaliacao' => 4.8,
            'localizacao' => "Floresta, Porto Alegre",
            'preco' => 680,
            'precoTexto' => "R$ 680",
            'cidade' => "rs",
            'imagem' => "https://i.ibb.co/Pzj4B8sY/hotel-continental.jpg",
            'avaliacoes' => 3281,
            'link' => "continental-rs",
            'categoria' => "medio",
            'lat' => -30.0346,
            'lng' => -51.2177,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Estacionamento", "Restaurante", "Business Center"]
        ],
        [
            'id' => 10,
            'nome' => "Hotel GoldMen Express Cianorte",
            'avaliacao' => 4.3,
            'localizacao' => "Zona 3, Cianorte - PR",
            'preco' => 680,
            'precoTexto' => "R$ 680",
            'cidade' => "pr",
            'imagem' => "https://i.ibb.co/5Xr5wYRn/hotel-gold.jpg",
            'avaliacoes' => 58,
            'link' => "goldmen-express-pr",
            'categoria' => "medio",
            'lat' => -23.6633,
            'lng' => -52.6108,
            'estrelas' => 3,
            'comodidades' => ["Wi-Fi", "Estacionamento", "Café da Manhã"]
        ],
        [
            'id' => 11,
            'nome' => "Gran Villagio Hotel",
            'avaliacao' => 4.6,
            'localizacao' => "Consolação, São Paulo",
            'preco' => 980,
            'precoTexto' => "R$ 980",
            'cidade' => "sp",
            'imagem' => "https://i.ibb.co/CRj4cTP/Gran-Villagio-Hotel.png",
            'avaliacoes' => 1425,
            'link' => "gran-villagio-sp",
            'categoria' => "premium",
            'lat' => -23.5515,
            'lng' => -46.6343,
            'estrelas' => 5,
            'comodidades' => ["Wi-Fi", "Piscina", "Spa", "Restaurante", "Academia"]
        ],
        [
            'id' => 12,
            'nome' => "Life Infinity - Hotel",
            'avaliacao' => 4.2,
            'localizacao' => "Carniel, Gramado",
            'preco' => 870,
            'precoTexto' => "R$ 870",
            'cidade' => "rs",
            'imagem' => "https://i.ibb.co/1YkDLFzJ/infinity-hotel.jpg",
            'avaliacoes' => 205,
            'link' => "life-infinity-rs",
            'categoria' => "premium",
            'lat' => -29.3749,
            'lng' => -50.8821,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Lareira", "Hidromassagem", "Estacionamento"]
        ],
        [
            'id' => 13,
            'nome' => "Oceania Park Hotel Spa & Convention Center",
            'avaliacao' => 4.5,
            'localizacao' => "Ingleses Centro, Florianópolis",
            'preco' => 630,
            'precoTexto' => "R$ 630",
            'cidade' => "sc",
            'imagem' => "https://i.ibb.co/qLp1GJFc/Hotel-oceania.jpg",
            'avaliacoes' => 4103,
            'link' => "oceania-park-sc",
            'categoria' => "medio",
            'lat' => -27.4510,
            'lng' => -48.5500,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Piscina", "Spa", "Restaurante", "Centro de Convenções"]
        ],
        [
            'id' => 14,
            'nome' => "Hotel Pousada Por do Sol",
            'avaliacao' => 4.7,
            'localizacao' => "Camanducaia - MG",
            'preco' => 680,
            'precoTexto' => "R$ 680",
            'cidade' => "mg",
            'imagem' => "https://i.ibb.co/m5WpdDSv/hotel-sol.jpg",
            'avaliacoes' => 247,
            'link' => "por-do-sol-mg",
            'categoria' => "medio",
            'lat' => -22.7497,
            'lng' => -45.9911,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Lareira", "Café da Manhã", "Área de Churrasco"]
        ],
        [
            'id' => 15,
            'nome' => "Hotel Pousada Agua Marinha",
            'avaliacao' => 4.8,
            'localizacao' => "Brejatuba, Guaratuba",
            'preco' => 650,
            'precoTexto' => "R$ 650",
            'cidade' => "pr",
            'imagem' => "https://i.ibb.co/fY0nGHmw/Hotel-Pousada-Agua-Marinha.jpg",
            'avaliacoes' => 1182,
            'link' => "agua-marinha-pr",
            'categoria' => "medio",
            'lat' => -25.8800,
            'lng' => -48.5833,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Piscina", "Praia Privativa", "Restaurante"]
        ],
        [
            'id' => 16,
            'nome' => "Hotel Pousada Canto da Vigia",
            'avaliacao' => 4.9,
            'localizacao' => "Armação, Penha",
            'preco' => 580,
            'precoTexto' => "R$ 580",
            'cidade' => "sc",
            'imagem' => "https://i.ibb.co/HfPvqV9P/hotel-canto.jpg",
            'avaliacoes' => 651,
            'link' => "canto-vigia-sc",
            'categoria' => "medio",
            'lat' => -26.7833,
            'lng' => -48.6167,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Piscina", "Vista para o Mar", "Café da Manhã"]
        ],
        [
            'id' => 17,
            'nome' => "Hotel Pousada Universal",
            'avaliacao' => 4.3,
            'localizacao' => "Setor rodoviário, Riachão",
            'preco' => 580,
            'precoTexto' => "R$ 580",
            'cidade' => "ma",
            'imagem' => "https://i.ibb.co/wNdvDFv4/hotel-universal.webp",
            'avaliacoes' => 276,
            'link' => "pousada-universal-ma",
            'categoria' => "medio",
            'lat' => -7.3619,
            'lng' => -46.6744,
            'estrelas' => 3,
            'comodidades' => ["Wi-Fi", "Estacionamento", "Restaurante"]
        ],
        [
            'id' => 18,
            'nome' => "Hotel Rios",
            'avaliacao' => 4.4,
            'localizacao' => "Potosi, Balsas",
            'preco' => 550,
            'precoTexto' => "R$ 550",
            'cidade' => "ma",
            'imagem' => "https://i.ibb.co/N4tRbrF/hotel-rios.jpg",
            'avaliacoes' => 80,
            'link' => "hotel-rios-ma",
            'categoria' => "medio",
            'lat' => -7.5321,
            'lng' => -46.0355,
            'estrelas' => 3,
            'comodidades' => ["Wi-Fi", "Estacionamento", "Café da Manhã"]
        ],
        [
            'id' => 19,
            'nome' => "San Michel Hotel",
            'avaliacao' => 4.8,
            'localizacao' => "República, São Paulo",
            'preco' => 650,
            'precoTexto' => "R$ 650",
            'cidade' => "sp",
            'imagem' => "https://i.ibb.co/7Jr9J0NJ/michel-hotel.jpg",
            'avaliacoes' => 2526,
            'link' => "san-michel-sp",
            'categoria' => "medio",
            'lat' => -23.5440,
            'lng' => -46.6423,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Business Center", "Restaurante", "Estacionamento"]
        ],
        [
            'id' => 20,
            'nome' => "Hotel Viale Cataratas",
            'avaliacao' => 4.5,
            'localizacao' => "Vila Yolanda, Foz do Iguaçu",
            'preco' => 650,
            'precoTexto' => "R$ 650",
            'cidade' => "pr",
            'imagem' => "https://i.ibb.co/5xnLP14N/Viale-Cataratas-Hotel.jpg",
            'avaliacoes' => 1864,
            'link' => "viale-cataratas-pr",
            'categoria' => "medio",
            'lat' => -25.5478,
            'lng' => -54.5873,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Piscina", "Restaurante", "Translado para Cataratas"]
        ],
        [
            'id' => 21,
            'nome' => "Hotel Villa Lobos Spa Romantik",
            'avaliacao' => 4.9,
            'localizacao' => "Pte. Nova, Extrema",
            'preco' => 550,
            'precoTexto' => "R$ 550",
            'cidade' => "mg",
            'imagem' => "https://i.ibb.co/SXsj4K6f/Hotel-spa.jpg",
            'avaliacoes' => 13335,
            'link' => "villa-lobos-mg",
            'categoria' => "medio",
            'lat' => -22.8548,
            'lng' => -46.3186,
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Spa", "Piscina", "Restaurante", "Tratamentos Relaxantes"]
        ]
    ];

    public function show($id)
    {
        // Encontra o hotel pelo ID
        $hotel = null;
        foreach ($this->hoteis as $h) {
            if ($h['id'] == $id) {
                $hotel = $h;
                break;
            }
        }

        // Se não encontrar, retorna erro 404
        if (!$hotel) {
            abort(404, 'Hotel não encontrado');
        }

        // Converte array para objeto para facilitar o uso na view
        return view('destinos.hoteis.show', ['hotel' => (object)$hotel]);
    }

    // Método para API (caso precise no futuro)
    public function index(Request $request)
    {
        // Filtros
        $filtrados = $this->hoteis;

        if ($request->has('destino') && $request->destino) {
            $filtrados = array_filter($filtrados, function($h) use ($request) {
                return $h['cidade'] === $request->destino;
            });
        }

        if ($request->has('preco') && $request->preco) {
            $filtrados = array_filter($filtrados, function($h) use ($request) {
                return $h['categoria'] === $request->preco;
            });
        }

        if ($request->has('classificacao') && $request->classificacao) {
            $filtrados = array_filter($filtrados, function($h) use ($request) {
                return $h['estrelas'] >= intval($request->classificacao);
            });
        }

        // Se for requisição AJAX, retorna JSON
        if ($request->ajax()) {
            return response()->json(array_values($filtrados));
        }

        // Se for requisição normal, retorna a view principal
        return view('hoteis');
    }
}
