<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class RestauranteController extends Controller
{
    public function listar(Request $request)
    {
        $restaurantes = collect([
            new Restaurante(['id_restaurante' => 1, 'nome' => 'Canoa', 'telefone' => '+55 98932102566', 'estado' => 'MA', 'cidade' => 'Barreirinhas', 'rua' => 'Av. Beira Rio', 'bairro' => '', 'numero' => '', 'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 23:00 horas', 'sobre' => 'O Restaurante A Canoa, localizado em Barreirinhas, é uma excelente opção para quem deseja saborear a culinária típica maranhense, especialmente seus pratos com frutos do mar frescos.']),
            new Restaurante(['id_restaurante' => 2, 'nome' => 'Alameda', 'telefone' => '+55 483282-1656', 'estado' => 'SC', 'cidade' => 'Florianópolis', 'rua' => 'R. Jornalista Haroldo Callado', 'bairro' => 'Jurerê', 'numero' => '25', 'horario_funcionamento' => 'Segunda a Domingo das 07:00 às 19:00 horas', 'sobre' => 'O Restaurante Alameda, em Florianópolis, é uma excelente opção para quem busca uma refeição sofisticada e cheia de sabor.']),
            new Restaurante(['id_restaurante' => 3, 'nome' => 'Bené da Flauta', 'telefone' => '+55 313551-1036', 'estado' => 'MG', 'cidade' => 'Ouro Preto', 'rua' => 'R. São Francisco de Assis', 'bairro' => 'Centro', 'numero' => '32', 'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 22:00 horas', 'sobre' => 'O Restaurante Bené da Flauta, em Ouro Preto (MG), oferece uma deliciosa culinária mineira.']),
            new Restaurante(['id_restaurante' => 4, 'nome' => 'Cantina Pastasciutta', 'telefone' => '+55 543286-2131', 'estado' => 'RS', 'cidade' => 'Gramado', 'rua' => 'Av. Borges de Medeiros', 'bairro' => 'Centro', 'numero' => '2083', 'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 23:30 horas', 'sobre' => 'A Cantina Pastasciutta, em Gramado, é um restaurante tradicional que oferece o melhor da culinária italiana.']),
            new Restaurante(['id_restaurante' => 5, 'nome' => 'Capim Santo', 'telefone' => '+55 (11) 3032-2277', 'estado' => 'SP', 'cidade' => 'São Paulo', 'rua' => 'Av. Brig. Faria Lima', 'bairro' => 'Jardim Paulistano', 'numero' => '2705', 'horario_funcionamento' => 'Terça a Segunda das 10:00 às 18:00 horas', 'sobre' => 'O Capim Santo é um restaurante de São Paulo que celebra a culinária brasileira com um toque contemporâneo.']),
            new Restaurante(['id_restaurante' => 6, 'nome' => 'Casa Terracota', 'telefone' => '+55 5499229-1078', 'estado' => 'RS', 'cidade' => 'Canela', 'rua' => 'Rua estrada morro calçado', 'bairro' => 'Linha São João', 'numero' => '', 'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 17:30 horas', 'sobre' => 'A Casa Terracota, em Gramado, é um restaurante único que combina gastronomia sofisticada e arquitetura charmosa.']),
            new Restaurante(['id_restaurante' => 7, 'nome' => 'Cipriani', 'telefone' => '+55 212548-7070', 'estado' => 'RJ', 'cidade' => 'Rio de Janeiro', 'rua' => 'Av. Atlântica', 'bairro' => 'Copacabana', 'numero' => '1702', 'horario_funcionamento' => 'Segunda a Domingo das 19:00 às 21:00 horas', 'sobre' => 'O Restaurante Cipriani, localizado no Rio de Janeiro, é uma opção sofisticada para quem aprecia a culinária italiana.']),
            new Restaurante(['id_restaurante' => 8, 'nome' => 'Dolce Vita', 'telefone' => '+55 4898427-6643', 'estado' => 'SC', 'cidade' => 'Florianópolis', 'rua' => 'R. Laurindo Januário da Silveira', 'bairro' => 'Canto da Lagoa', 'numero' => '1233', 'horario_funcionamento' => 'Segunda a Domingo das 19:00 às 23:00 horas', 'sobre' => 'O Dolce Vita, em Florianópolis, é um restaurante que traz o melhor da culinária italiana.']),
            new Restaurante(['id_restaurante' => 9, 'nome' => 'El Fuego', 'telefone' => '+55 543286-3055', 'estado' => 'RS', 'cidade' => 'Gramado', 'rua' => 'R. Garibaldi', 'bairro' => 'Centro', 'numero' => '20', 'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 22:30 horas', 'sobre' => 'O El Fuego em Gramado é um restaurante especializado em carnes e parrillas.']),
            new Restaurante(['id_restaurante' => 10, 'nome' => 'Fasano', 'telefone' => '+55 213202-4030', 'estado' => 'RJ', 'cidade' => 'Rio de Janeiro', 'rua' => 'Av. Vieira Souto', 'bairro' => 'Ipanema', 'numero' => '80', 'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 23:00 horas', 'sobre' => 'O Restaurante Fasano no Rio de Janeiro é um dos ícones da alta gastronomia italiana.']),
            new Restaurante(['id_restaurante' => 11, 'nome' => 'Gastro Pub', 'telefone' => '+55 3198312-7606', 'estado' => 'MG', 'cidade' => 'Ouro Preto', 'rua' => 'Rua Conde de Bobadela', 'bairro' => 'Centro', 'numero' => '132', 'horario_funcionamento' => 'Segunda a Domingo das 17:30 às 00:00 horas', 'sobre' => 'O Gastro Pub da Cidade de Ouro Preto oferece uma experiência única que combina gastronomia contemporânea com charme rústico.']),
        ]);

        $query = $restaurantes;
        if ($request->has('cidade')) {
            $query = $query->filter(function ($restaurante) use ($request) {
                return $restaurante->cidade === $request->cidade;
            });
        }

        $perPage = 6;
        $page = $request->input('page', 1);
        $total = $query->count();
        $items = $query->forPage($page, $perPage)->values();

        $restaurantes = new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $cidades = $restaurantes->pluck('cidade')->unique();

        return view('restaurante', compact('restaurantes', 'cidades'));
    }

    public function detalhes($id)
    {
        $restaurantes = collect([
            new Restaurante(['id_restaurante' => 1, 'nome' => 'Canoa', 'telefone' => '+55 98932102566', 'estado' => 'MA', 'cidade' => 'Barreirinhas', 'rua' => 'Av. Beira Rio', 'bairro' => '', 'numero' => '', 'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 23:00 horas', 'sobre' => 'O Restaurante A Canoa, localizado em Barreirinhas, é uma excelente opção para quem deseja saborear a culinária típica maranhense.']),
            new Restaurante(['id_restaurante' => 2, 'nome' => 'Alameda', 'telefone' => '+55 483282-1656', 'estado' => 'SC', 'cidade' => 'Florianópolis', 'rua' => 'R. Jornalista Haroldo Callado', 'bairro' => 'Jurerê', 'numero' => '25', 'horario_funcionamento' => 'Segunda a Domingo das 07:00 às 19:00 horas', 'sobre' => 'O Restaurante Alameda, em Florianópolis, é uma excelente opção para quem busca uma refeição sofisticada.']),
            new Restaurante(['id_restaurante' => 3, 'nome' => 'Bené da Flauta', 'telefone' => '+55 313551-1036', 'estado' => 'MG', 'cidade' => 'Ouro Preto', 'rua' => 'R. São Francisco de Assis', 'bairro' => 'Centro', 'numero' => '32', 'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 22:00 horas', 'sobre' => 'O Restaurante Bené da Flauta, em Ouro Preto (MG), oferece uma deliciosa culinária mineira.']),
            new Restaurante(['id_restaurante' => 4, 'nome' => 'Cantina Pastasciutta', 'telefone' => '+55 543286-2131', 'estado' => 'RS', 'cidade' => 'Gramado', 'rua' => 'Av. Borges de Medeiros', 'bairro' => 'Centro', 'numero' => '2083', 'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 23:30 horas', 'sobre' => 'A Cantina Pastasciutta, em Gramado, é um restaurante tradicional que oferece o melhor da culinária italiana.']),
            new Restaurante(['id_restaurante' => 5, 'nome' => 'Capim Santo', 'telefone' => '+55 (11) 3032-2277', 'estado' => 'SP', 'cidade' => 'São Paulo', 'rua' => 'Av. Brig. Faria Lima', 'bairro' => 'Jardim Paulistano', 'numero' => '2705', 'horario_funcionamento' => 'Terça a Segunda das 10:00 às 18:00 horas', 'sobre' => 'O Capim Santo é um restaurante de São Paulo que celebra a culinária brasileira.']),
            new Restaurante(['id_restaurante' => 6, 'nome' => 'Casa Terracota', 'telefone' => '+55 5499229-1078', 'estado' => 'RS', 'cidade' => 'Canela', 'rua' => 'Rua estrada morro calçado', 'bairro' => 'Linha São João', 'numero' => '', 'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 17:30 horas', 'sobre' => 'A Casa Terracota, em Gramado, é um restaurante único que combina gastronomia sofisticada.']),
            new Restaurante(['id_restaurante' => 7, 'nome' => 'Cipriani', 'telefone' => '+55 212548-7070', 'estado' => 'RJ', 'cidade' => 'Rio de Janeiro', 'rua' => 'Av. Atlântica', 'bairro' => 'Copacabana', 'numero' => '1702', 'horario_funcionamento' => 'Segunda a Domingo das 19:00 às 21:00 horas', 'sobre' => 'O Restaurante Cipriani, localizado no Rio de Janeiro, é uma opção sofisticada.']),
            new Restaurante(['id_restaurante' => 8, 'nome' => 'Dolce Vita', 'telefone' => '+55 4898427-6643', 'estado' => 'SC', 'cidade' => 'Florianópolis', 'rua' => 'R. Laurindo Januário da Silveira', 'bairro' => 'Canto da Lagoa', 'numero' => '1233', 'horario_funcionamento' => 'Segunda a Domingo das 19:00 às 23:00 horas', 'sobre' => 'O Dolce Vita, em Florianópolis, é um restaurante que traz o melhor da culinária italiana.']),
            new Restaurante(['id_restaurante' => 9, 'nome' => 'El Fuego', 'telefone' => '+55 543286-3055', 'estado' => 'RS', 'cidade' => 'Gramado', 'rua' => 'R. Garibaldi', 'bairro' => 'Centro', 'numero' => '20', 'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 22:30 horas', 'sobre' => 'O El Fuego em Gramado é um restaurante especializado em carnes.']),
            new Restaurante(['id_restaurante' => 10, 'nome' => 'Fasano', 'telefone' => '+55 213202-4030', 'estado' => 'RJ', 'cidade' => 'Rio de Janeiro', 'rua' => 'Av. Vieira Souto', 'bairro' => 'Ipanema', 'numero' => '80', 'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 23:00 horas', 'sobre' => 'O Restaurante Fasano no Rio de Janeiro é um dos ícones da alta gastronomia.']),
            new Restaurante(['id_restaurante' => 11, 'nome' => 'Gastro Pub', 'telefone' => '+55 3198312-7606', 'estado' => 'MG', 'cidade' => 'Ouro Preto', 'rua' => 'Rua Conde de Bobadela', 'bairro' => 'Centro', 'numero' => '132', 'horario_funcionamento' => 'Segunda a Domingo das 17:30 às 00:00 horas', 'sobre' => 'O Gastro Pub da Cidade de Ouro Preto oferece uma experiência única.']),
        ]);

        $restaurante = $restaurantes->where('id_restaurante', $id)->first();
        if (!$restaurante) {
            abort(404);
        }
        return view('restaurante.detalhes', compact('restaurante'));
    }
}
