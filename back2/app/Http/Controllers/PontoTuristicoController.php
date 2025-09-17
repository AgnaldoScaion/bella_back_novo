<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PontoTuristicoController extends Controller
{
    // Array com dados dos pontos turísticos
    private $pontosTuristicos = [
        [
            'id' => 1,
            'nome' => "Beco do Batman",
            'tipo' => "cultural",
            'avaliacao' => 4.9,
            'localizacao' => "São Paulo, SP • Brasil",
            'preco' => "gratis",
            'precoTexto' => "Gratuito",
            'cidade' => "sp",
            'imagem' => "https://i.ibb.co/BK3tM0Q6/Beco-do-Batman.png",
            'avaliacoes' => 12500,
            'link' => "beco-do-batman",
            'lat' => -23.5505,
            'lng' => -46.6333
        ],
        [
            'id' => 2,
            'nome' => "Museu da Inconfidência",
            'tipo' => "historico",
            'avaliacao' => 3.8,
            'localizacao' => "Praça Tiradentes, 139, Centro, Ouro Preto - MG",
            'preco' => "medio",
            'precoTexto' => "Médio",
            'cidade' => "mg",
            'imagem' => "https://i.ibb.co/1tYjyVFY/Museu-da-Inconfidencia.png",
            'avaliacoes' => 9800,
            'link' => "museu-inconfidencia",
            'lat' => -20.3855,
            'lng' => -43.5033
        ],
        [
            'id' => 3,
            'nome' => "Pão de Açúcar",
            'tipo' => "natural",
            'avaliacao' => 4.7,
            'localizacao' => "Urca, Rio de Janeiro",
            'preco' => "gratis",
            'precoTexto' => "Gratuito",
            'cidade' => "rj",
            'imagem' => "https://i.ibb.co/DPYLP3Tz/pao-de-acucar-principal.jpg",
            'avaliacoes' => 8200,
            'link' => "pao-de-acucar",
            'lat' => -22.9519,
            'lng' => -43.1655
        ],
        [
            'id' => 4,
            'nome' => "Parque das Aves",
            'tipo' => "natural",
            'avaliacao' => 4.6,
            'localizacao' => "Foz do Iguaçu, Paraná",
            'preco' => "gratis",
            'precoTexto' => "Gratuito",
            'cidade' => "pr",
            'imagem' => "https://i.ibb.co/7xHYWJgC/Parque-das-Aves.png",
            'avaliacoes' => 7500,
            'link' => "parque-das-aves",
            'lat' => -25.5163,
            'lng' => -54.5854
        ],
        [
            'id' => 5,
            'nome' => "Palácio dos Leões",
            'tipo' => "historico",
            'avaliacao' => 4.9,
            'localizacao' => "São Luís, MA",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "ma",
            'imagem' => "https://i.ibb.co/605Jtfp9/Palacio-dos-Leoes.png",
            'avaliacoes' => 10200,
            'link' => "palacio-dos-leoes",
            'lat' => -2.5307,
            'lng' => -44.3068
        ],
        [
            'id' => 6,
            'nome' => "Mina da Passagem",
            'tipo' => "historico",
            'avaliacao' => 3.9,
            'localizacao' => "Mariana, MG",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "mg",
            'imagem' => "https://i.ibb.co/CrRHrzy/Mina-da-Passagem.png",
            'avaliacoes' => 10200,
            'link' => "mina-da-passagem",
            'lat' => -20.3772,
            'lng' => -43.4163
        ],
        [
            'id' => 7,
            'nome' => "Catedral da Sé",
            'tipo' => "religioso",
            'avaliacao' => 4.9,
            'localizacao' => "São Paulo, SP",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "sp",
            'imagem' => "https://i.ibb.co/5XLKDyhC/Catedral-da-S.png",
            'avaliacoes' => 10200,
            'link' => "catedral-da-se",
            'lat' => -23.5505,
            'lng' => -46.6333
        ],
        [
            'id' => 8,
            'nome' => "Centro Histórico de São Luís",
            'tipo' => "historico",
            'avaliacao' => 4.9,
            'localizacao' => "São Luís, MA",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "ma",
            'imagem' => "https://i.ibb.co/LzsHKZSR/Centro-Hist-rico-de-S-o-Lu-s.png",
            'avaliacoes' => 10200,
            'link' => "centro-historico-sao-luis",
            'lat' => -2.5307,
            'lng' => -44.3068
        ],
        [
            'id' => 9,
            'nome' => "Praia da Joaquina",
            'tipo' => "natural",
            'avaliacao' => 4.9,
            'localizacao' => "Florianópolis, SC",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "sc",
            'imagem' => "https://i.ibb.co/ZRMkQCrw/Praia-da-Joaquina.png",
            'avaliacoes' => 10200,
            'link' => "praia-joaquina",
            'lat' => -27.6355,
            'lng' => -48.4462
        ],
        [
            'id' => 10,
            'nome' => "Mirante do Morro da Cruz",
            'tipo' => "natural",
            'avaliacao' => 4.9,
            'localizacao' => "Florianópolis, SC",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "sc",
            'imagem' => "https://i.ibb.co/tMc9JSjv/Mirante-do-Morro-da-Cruz.png",
            'avaliacoes' => 10200,
            'link' => "mirante-morro-cruz",
            'lat' => -27.5969,
            'lng' => -48.5496
        ],
        [
            'id' => 11,
            'nome' => "Cataratas do Iguaçu",
            'tipo' => "natural",
            'avaliacao' => 4.9,
            'localizacao' => "Foz do Iguaçu, PR",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "pr",
            'imagem' => "https://i.ibb.co/4nwCr50p/cataratas-do-iguacu-principal.jpg",
            'avaliacoes' => 10200,
            'link' => "cataratas-do-iguacu",
            'lat' => -25.6953,
            'lng' => -54.4367
        ],
        [
            'id' => 12,
            'nome' => "Cristo Redentor",
            'tipo' => "religioso",
            'avaliacao' => 4.9,
            'localizacao' => "Rio de Janeiro, RJ",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "rj",
            'imagem' => "https://i.ibb.co/tpFRvZ6Y/cristo-redentor-principal.jpg",
            'avaliacoes' => 10200,
            'link' => "cristo-redentor",
            'lat' => -22.9519,
            'lng' => -43.2105
        ],
        [
            'id' => 13,
            'nome' => "Ilha do Campeche",
            'tipo' => "natural",
            'avaliacao' => 4.9,
            'localizacao' => "Florianópolis, SC",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "sc",
            'imagem' => "https://i.ibb.co/nMhtHm77/Ilha-do-Campeche.png",
            'avaliacoes' => 10200,
            'link' => "ilha-do-campeche",
            'lat' => -27.6892,
            'lng' => -48.4754
        ],
        [
            'id' => 14,
            'nome' => "Lençóis Maranhenses",
            'tipo' => "natural",
            'avaliacao' => 4.9,
            'localizacao' => "Parque Nacional dos Lençóis Maranhenses, MA",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "ma",
            'imagem' => "https://i.ibb.co/BK4v8LsX/Len-ois-Maranhenses.png",
            'avaliacoes' => 10200,
            'link' => "lencois-maranhenses",
            'lat' => -2.5469,
            'lng' => -43.1235
        ],
        [
            'id' => 15,
            'nome' => "Mini Mundo",
            'tipo' => "cultural",
            'avaliacao' => 4.9,
            'localizacao' => "Gramado, RS",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "rs",
            'imagem' => "https://i.ibb.co/jvNDDqdk/mini-mundo-principal.png",
            'avaliacoes' => 10200,
            'link' => "mini-mundo",
            'lat' => -29.3739,
            'lng' => -50.8811
        ],
        [
            'id' => 16,
            'nome' => "Praia de Copacabana",
            'tipo' => "natural",
            'avaliacao' => 4.9,
            'localizacao' => "Copacabana, RJ",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "rj",
            'imagem' => "https://i.ibb.co/RpspQCJb/praia-copacabanaprincipal.jpg",
            'avaliacoes' => 10200,
            'link' => "praia-copacabana",
            'lat' => -22.9712,
            'lng' => -43.1823
        ],
        [
            'id' => 17,
            'nome' => "Rua Coberta",
            'tipo' => "cultural",
            'avaliacao' => 4.9,
            'localizacao' => "Gramado, RS",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "rs",
            'imagem' => "https://i.ibb.co/RGPQnFfQ/Foto-Rua-Coberta.png",
            'avaliacoes' => 10200,
            'link' => "rua-coberta",
            'lat' => -29.3785,
            'lng' => -50.8754
        ],
        [
            'id' => 18,
            'nome' => "Usina Hidrelétrica de Itaipu",
            'tipo' => "cultural",
            'avaliacao' => 4.9,
            'localizacao' => "Foz do Iguaçu, PR",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "pr",
            'imagem' => "https://i.ibb.co/bgFwbx4F/usina-hidreletrica-itaipu-principal.png",
            'avaliacoes' => 10200,
            'link' => "usina-hidreletrica-itaipu",
            'lat' => -25.4086,
            'lng' => -54.5888
        ],
        [
            'id' => 19,
            'nome' => "Igreja de São Francisco de Assis",
            'tipo' => "religioso",
            'avaliacao' => 4.9,
            'localizacao' => "Ouro Preto, MG",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "mg",
            'imagem' => "https://i.ibb.co/DTSkvSy/Igreja-de-S-o-Francisco-de-Assis.png",
            'avaliacoes' => 10200,
            'link' => "igreja-sao-francisco",
            'lat' => -20.3855,
            'lng' => -43.5033
        ],
        [
            'id' => 20,
            'nome' => "Parque Ibirapuera",
            'tipo' => "natural",
            'avaliacao' => 4.9,
            'localizacao' => "São Paulo, SP",
            'preco' => "alto",
            'precoTexto' => "Alto",
            'cidade' => "sp",
            'imagem' => "https://i.ibb.co/dJWhkRQ5/Ibirapuera-Park.png",
            'avaliacoes' => 10200,
            'link' => "parque-ibirapuera",
            'lat' => -23.5878,
            'lng' => -46.6580
        ],
        [
            'id' => 21,
            'nome' => "Lago Negro",
            'tipo' => "natural",
            'avaliacao' => 4.5,
            'localizacao' => "Gramado, Rio Grande do Sul",
            'preco' => "medio",
            'precoTexto' => "Médio",
            'cidade' => "rs",
            'imagem' => "https://i.ibb.co/k2x0S05T/Lago-Negro.png",
            'avaliacoes' => 6800,
            'link' => "lago-negro",
            'lat' => -29.3769,
            'lng' => -50.8764
        ]
    ];

    public function show($id)
    {
        // Encontra o ponto turístico pelo ID
        $ponto = null;
        foreach ($this->pontosTuristicos as $pt) {
            if ($pt['id'] == $id) {
                $ponto = $pt;
                break;
            }
        }

        // Se não encontrar, retorna erro 404
        if (!$ponto) {
            abort(404, 'Ponto turístico não encontrado');
        }

        // Converte array para objeto para facilitar o uso na view
        return view('destinos.pontos-turisticos.show', ['ponto' => (object)$ponto]);
    }

    public function index(Request $request)
    {
        // Se for requisição AJAX, retorna JSON
        if ($request->ajax()) {
            $filtrados = $this->pontosTuristicos;

            // Aplicar filtros
            if ($request->has('tipo') && $request->tipo) {
                $filtrados = array_filter($filtrados, function($pt) use ($request) {
                    return $pt['tipo'] === $request->tipo;
                });
            }

            if ($request->has('localizacao') && $request->localizacao) {
                $filtrados = array_filter($filtrados, function($pt) use ($request) {
                    return $pt['cidade'] === $request->localizacao;
                });
            }

            if ($request->has('avaliacao') && $request->avaliacao) {
                $filtrados = array_filter($filtrados, function($pt) use ($request) {
                    return $pt['avaliacao'] >= floatval($request->avaliacao);
                });
            }

            if ($request->has('preco') && $request->preco) {
                $filtrados = array_filter($filtrados, function($pt) use ($request) {
                    return $pt['preco'] === $request->preco;
                });
            }

            return response()->json(array_values($filtrados));
        }

        // Se for requisição normal, retorna a view principal
        return view('pontos-turisticos');
    }
}
