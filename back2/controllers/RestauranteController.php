<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{
    public function listar(Request $request)
    {
        $restaurantes = collect([
            new Restaurante([
                'nome' => 'Canoa',
                'telefone' => '+55 98932102566',
                'estado' => 'MA',
                'cidade' => 'Barreirinhas',
                'rua' => 'Av. Beira Rio',
                'bairro' => '',
                'numero' => '',
                'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 23:00 horas',
                'sobre' => 'O Restaurante A Canoa, localizado em Barreirinhas, é uma excelente opção para quem deseja saborear a culinária típica maranhense, especialmente seus pratos com frutos do mar frescos. Com um ambiente simples e acolhedor, o restaurante proporciona uma experiência descontraída, ideal para quem visita os Lençóis Maranhenses e busca uma refeição saborosa e autêntica.'
            ]),
            new Restaurante([
                'nome' => 'Alameda',
                'telefone' => '+55 483282-1656',
                'estado' => 'SC',
                'cidade' => 'Florianópolis',
                'rua' => 'R. Jornalista Haroldo Callado',
                'bairro' => 'Jurerê',
                'numero' => '25',
                'horario_funcionamento' => 'Segunda a Domingo das 07:00 às 19:00 horas',
                'sobre' => 'O Restaurante Alameda, em Florianópolis, é uma excelente opção para quem busca uma refeição sofisticada e cheia de sabor. Com um ambiente elegante e acolhedor, o restaurante oferece pratos criativos que misturam ingredientes frescos e sabores únicos da gastronomia brasileira e internacional. O cardápio variado, aliado a um atendimento impecável, proporciona uma experiência gastronômica memorável, ideal para ocasiões especiais ou para quem deseja desfrutar de uma refeição de alto nível.'
            ]),
            new Restaurante([
                'nome' => 'Bené da Flauta',
                'telefone' => '+55 313551-1036',
                'estado' => 'MG',
                'cidade' => 'Ouro Preto',
                'rua' => 'R. São Francisco de Assis',
                'bairro' => 'Centro',
                'numero' => '32',
                'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 22:00 horas',
                'sobre' => 'O Restaurante Bené da Flauta, em Ouro Preto (MG), oferece uma deliciosa culinária mineira, com pratos típicos como feijão tropeiro e costela, em um ambiente acolhedor e rústico. Ideal para quem deseja saborear a autenticidade da gastronomia de Minas Gerais.'
            ]),
            new Restaurante([
                'nome' => 'Cantina Pastasciutta',
                'telefone' => '+55 543286-2131',
                'estado' => 'RS',
                'cidade' => 'Gramado',
                'rua' => 'Av. Borges de Medeiros',
                'bairro' => 'Centro',
                'numero' => '2083',
                'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 23:30 horas',
                'sobre' => 'A Cantina Pastasciutta, em Gramado, é um restaurante tradicional que oferece o melhor da culinária italiana. Com um ambiente acolhedor e rústico, o restaurante se destaca por suas massas artesanais e pratos saborosos, preparados com ingredientes frescos e de alta qualidade. A Cantina Pastasciutta proporciona uma experiência gastronômica autêntica, ideal para quem deseja saborear receitas italianas em um ambiente encantador em meio à charmosa cidade de Gramado.'
            ]),
            new Restaurante([
                'nome' => 'Capim Santo',
                'telefone' => '+55 (11) 3032-2277',
                'estado' => 'SP',
                'cidade' => 'São Paulo',
                'rua' => 'Av. Brig. Faria Lima',
                'bairro' => 'Jardim Paulistano',
                'numero' => '2705',
                'horario_funcionamento' => 'Terça a Segunda das 10:00 às 18:00 horas',
                'sobre' => 'O Capim Santo é um restaurante de São Paulo que celebra a culinária brasileira com um toque contemporâneo. Com um ambiente acolhedor e sofisticado, o restaurante oferece pratos que destacam ingredientes típicos e frescos, preparados de maneira criativa e elegante. Ideal para quem busca uma experiência gastronômica autêntica e de alta qualidade, o Capim Santo combina sabores regionais com um atendimento impecável, proporcionando uma refeição memorável.'
            ]),
            new Restaurante([
                'nome' => 'Casa Terracota',
                'telefone' => '+55 5499229-1078',
                'estado' => 'RS',
                'cidade' => 'Canela',
                'rua' => 'Rua estrada morro calçado',
                'bairro' => 'Linha São João',
                'numero' => '',
                'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 17:30 horas',
                'sobre' => 'A Casa Terracota, em Gramado, é um restaurante único que combina gastronomia sofisticada e arquitetura charmosa. Localizado em um ambiente rústico e acolhedor, oferece pratos elaborados com ingredientes frescos e de alta qualidade, destacando-se pela fusão de sabores contemporâneos com influências da culinária brasileira. A Casa Terracota proporciona uma experiência gastronômica inesquecível, ideal para quem busca um ambiente encantador e uma refeição de alto nível.'
            ]),
            new Restaurante([
                'nome' => 'Cipriani',
                'telefone' => '+55 212548-7070',
                'estado' => 'RJ',
                'cidade' => 'Rio de Janeiro',
                'rua' => 'Av. Atlântica',
                'bairro' => 'Copacabana',
                'numero' => '1702',
                'horario_funcionamento' => 'Segunda a Domingo das 19:00 às 21:00 horas',
                'sobre' => 'O Restaurante Cipriani, localizado no Rio de Janeiro, é uma opção sofisticada para quem aprecia a culinária italiana com um toque contemporâneo. Seu cardápio é repleto de pratos deliciosos preparados com ingredientes frescos e de alta qualidade. O ambiente elegante e acolhedor oferece uma experiência gastronômica memorável. Ideal para ocasiões especiais, o atendimento é atencioso e impecável.'
            ]),
            new Restaurante([
                'nome' => 'Dolce Vita',
                'telefone' => '+55 4898427-6643',
                'estado' => 'SC',
                'cidade' => 'Florianópolis',
                'rua' => 'R. Laurindo Januário da Silveira',
                'bairro' => 'Canto da Lagoa',
                'numero' => '1233',
                'horario_funcionamento' => 'Segunda a Domingo das 19:00 às 23:00 horas',
                'sobre' => 'O Dolce Vita, em Florianópolis, é um restaurante que traz o melhor da culinária italiana, com um toque contemporâneo. O cardápio é repleto de pratos tradicionais italianos, como massas frescas e deliciosas sobremesas, preparados com ingredientes de alta qualidade. Com um ambiente aconchegante e elegante, o Dolce Vita oferece uma experiência gastronômica acolhedora, ideal para quem aprecia boa comida em um ambiente sofisticado.'
            ]),
            new Restaurante([
                'nome' => 'El Fuego',
                'telefone' => '+55 543286-3055',
                'estado' => 'RS',
                'cidade' => 'Gramado',
                'rua' => 'R. Garibaldi',
                'bairro' => 'Centro',
                'numero' => '20',
                'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 22:30 horas',
                'sobre' => 'O El Fuego em Gramado é um restaurante especializado em carnes e parrillas, oferecendo uma experiência gastronômica única. Com um ambiente acolhedor e contemporâneo, o restaurante se destaca pela qualidade de suas carnes, que são preparadas na brasa com sabores intensos e suculentos. Ideal para quem aprecia uma refeição saborosa e bem feita, o El Fuego é uma excelente opção para os amantes de churrasco e cortes nobres em Gramado.'
            ]),
            new Restaurante([
                'nome' => 'Fasano',
                'telefone' => '+55 213202-4030',
                'estado' => 'RJ',
                'cidade' => 'Rio de Janeiro',
                'rua' => 'Av. Vieira Souto',
                'bairro' => 'Ipanema',
                'numero' => '80',
                'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 23:00 horas',
                'sobre' => 'O Restaurante Fasano no Rio de Janeiro é um dos ícones da alta gastronomia da cidade, oferecendo pratos italianos sofisticados em um ambiente elegante e acolhedor. Com uma carta de vinhos premiada e receitas tradicionais italianas preparadas com ingredientes de primeira linha, o Fasano proporciona uma experiência gastronômica inesquecível. Localizado em Ipanema, é o destino ideal para quem busca excelência em comida e serviço em um ambiente requintado.'
            ]),
            new Restaurante([
                'nome' => 'Gastro Pub',
                'telefone' => '+55 3198312-7606',
                'estado' => 'MG',
                'cidade' => 'Ouro Preto',
                'rua' => 'Rua Conde de Bobadela',
                'bairro' => 'Centro',
                'numero' => '132',
                'horario_funcionamento' => 'Segunda a Domingo das 17:30 às 00:00 horas',
                'sobre' => 'O Gastro Pub da Cidade de Ouro Preto oferece uma experiência única que combina a gastronomia contemporânea com o charme rústico da cidade histórica. Com um cardápio criativo e uma vasta seleção de bebidas, o local se destaca pelo ambiente descontraído e acolhedor, ideal para quem busca um jantar sofisticado e descontraído ao mesmo tempo. É um ótimo destino para quem deseja experimentar pratos inovadores em um ambiente agradável e animado.'
            ]),
        ]);

        $query = $restaurantes;

        // Filtro por cidade
        if ($request->has('cidade')) {
            $query = $query->filter(function ($restaurante) use ($request) {
                return $restaurante->cidade === $request->cidade;
            });
        }

        $restaurantes = $query->values()->paginate(6);
        $cidades = $restaurantes->pluck('cidade')->unique();

        return view('restaurante', compact('restaurantes', 'cidades'));
    }

    public function detalhes($id)
    {
        $restaurantes = collect([
            new Restaurante(['id_restaurante' => 1, 'nome' => 'Canoa', 'telefone' => '+55 98932102566', 'estado' => 'MA', 'cidade' => 'Barreirinhas', 'rua' => 'Av. Beira Rio', 'bairro' => '', 'numero' => '', 'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 23:00 horas', 'sobre' => 'O Restaurante A Canoa, localizado em Barreirinhas, é uma excelente opção para quem deseja saborear a culinária típica maranhense, especialmente seus pratos com frutos do mar frescos. Com um ambiente simples e acolhedor, o restaurante proporciona uma experiência descontraída, ideal para quem visita os Lençóis Maranhenses e busca uma refeição saborosa e autêntica.']),
            new Restaurante(['id_restaurante' => 2, 'nome' => 'Alameda', 'telefone' => '+55 483282-1656', 'estado' => 'SC', 'cidade' => 'Florianópolis', 'rua' => 'R. Jornalista Haroldo Callado', 'bairro' => 'Jurerê', 'numero' => '25', 'horario_funcionamento' => 'Segunda a Domingo das 07:00 às 19:00 horas', 'sobre' => 'O Restaurante Alameda, em Florianópolis, é uma excelente opção para quem busca uma refeição sofisticada e cheia de sabor. Com um ambiente elegante e acolhedor, o restaurante oferece pratos criativos que misturam ingredientes frescos e sabores únicos da gastronomia brasileira e internacional. O cardápio variado, aliado a um atendimento impecável, proporciona uma experiência gastronômica memorável, ideal para ocasiões especiais ou para quem deseja desfrutar de uma refeição de alto nível.']),
            new Restaurante(['id_restaurante' => 3, 'nome' => 'Bené da Flauta', 'telefone' => '+55 313551-1036', 'estado' => 'MG', 'cidade' => 'Ouro Preto', 'rua' => 'R. São Francisco de Assis', 'bairro' => 'Centro', 'numero' => '32', 'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 22:00 horas', 'sobre' => 'O Restaurante Bené da Flauta, em Ouro Preto (MG), oferece uma deliciosa culinária mineira, com pratos típicos como feijão tropeiro e costela, em um ambiente acolhedor e rústico. Ideal para quem deseja saborear a autenticidade da gastronomia de Minas Gerais.']),
            new Restaurante(['id_restaurante' => 4, 'nome' => 'Cantina Pastasciutta', 'telefone' => '+55 543286-2131', 'estado' => 'RS', 'cidade' => 'Gramado', 'rua' => 'Av. Borges de Medeiros', 'bairro' => 'Centro', 'numero' => '2083', 'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 23:30 horas', 'sobre' => 'A Cantina Pastasciutta, em Gramado, é um restaurante tradicional que oferece o melhor da culinária italiana. Com um ambiente acolhedor e rústico, o restaurante se destaca por suas massas artesanais e pratos saborosos, preparados com ingredientes frescos e de alta qualidade. A Cantina Pastasciutta proporciona uma experiência gastronômica autêntica, ideal para quem deseja saborear receitas italianas em um ambiente encantador em meio à charmosa cidade de Gramado.']),
            new Restaurante(['id_restaurante' => 5, 'nome' => 'Capim Santo', 'telefone' => '+55 (11) 3032-2277', 'estado' => 'SP', 'cidade' => 'São Paulo', 'rua' => 'Av. Brig. Faria Lima', 'bairro' => 'Jardim Paulistano', 'numero' => '2705', 'horario_funcionamento' => 'Terça a Segunda das 10:00 às 18:00 horas', 'sobre' => 'O Capim Santo é um restaurante de São Paulo que celebra a culinária brasileira com um toque contemporâneo. Com um ambiente acolhedor e sofisticado, o restaurante oferece pratos que destacam ingredientes típicos e frescos, preparados de maneira criativa e elegante. Ideal para quem busca uma experiência gastronômica autêntica e de alta qualidade, o Capim Santo combina sabores regionais com um atendimento impecável, proporcionando uma refeição memorável.']),
            new Restaurante(['id_restaurante' => 6, 'nome' => 'Casa Terracota', 'telefone' => '+55 5499229-1078', 'estado' => 'RS', 'cidade' => 'Canela', 'rua' => 'Rua estrada morro calçado', 'bairro' => 'Linha São João', 'numero' => '', 'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 17:30 horas', 'sobre' => 'A Casa Terracota, em Gramado, é um restaurante único que combina gastronomia sofisticada e arquitetura charmosa. Localizado em um ambiente rústico e acolhedor, oferece pratos elaborados com ingredientes frescos e de alta qualidade, destacando-se pela fusão de sabores contemporâneos com influências da culinária brasileira. A Casa Terracota proporciona uma experiência gastronômica inesquecível, ideal para quem busca um ambiente encantador e uma refeição de alto nível.']),
            new Restaurante(['id_restaurante' => 7, 'nome' => 'Cipriani', 'telefone' => '+55 212548-7070', 'estado' => 'RJ', 'cidade' => 'Rio de Janeiro', 'rua' => 'Av. Atlântica', 'bairro' => 'Copacabana', 'numero' => '1702', 'horario_funcionamento' => 'Segunda a Domingo das 19:00 às 21:00 horas', 'sobre' => 'O Restaurante Cipriani, localizado no Rio de Janeiro, é uma opção sofisticada para quem aprecia a culinária italiana com um toque contemporâneo. Seu cardápio é repleto de pratos deliciosos preparados com ingredientes frescos e de alta qualidade. O ambiente elegante e acolhedor oferece uma experiência gastronômica memorável. Ideal para ocasiões especiais, o atendimento é atencioso e impecável.']),
            new Restaurante(['id_restaurante' => 8, 'nome' => 'Dolce Vita', 'telefone' => '+55 4898427-6643', 'estado' => 'SC', 'cidade' => 'Florianópolis', 'rua' => 'R. Laurindo Januário da Silveira', 'bairro' => 'Canto da Lagoa', 'numero' => '1233', 'horario_funcionamento' => 'Segunda a Domingo das 19:00 às 23:00 horas', 'sobre' => 'O Dolce Vita, em Florianópolis, é um restaurante que traz o melhor da culinária italiana, com um toque contemporâneo. O cardápio é repleto de pratos tradicionais italianos, como massas frescas e deliciosas sobremesas, preparados com ingredientes de alta qualidade. Com um ambiente aconchegante e elegante, o Dolce Vita oferece uma experiência gastronômica acolhedora, ideal para quem aprecia boa comida em um ambiente sofisticado.']),
            new Restaurante(['id_restaurante' => 9, 'nome' => 'El Fuego', 'telefone' => '+55 543286-3055', 'estado' => 'RS', 'cidade' => 'Gramado', 'rua' => 'R. Garibaldi', 'bairro' => 'Centro', 'numero' => '20', 'horario_funcionamento' => 'Segunda a Domingo das 11:30 às 22:30 horas', 'sobre' => 'O El Fuego em Gramado é um restaurante especializado em carnes e parrillas, oferecendo uma experiência gastronômica única. Com um ambiente acolhedor e contemporâneo, o restaurante se destaca pela qualidade de suas carnes, que são preparadas na brasa com sabores intensos e suculentos. Ideal para quem aprecia uma refeição saborosa e bem feita, o El Fuego é uma excelente opção para os amantes de churrasco e cortes nobres em Gramado.']),
            new Restaurante(['id_restaurante' => 10, 'nome' => 'Fasano', 'telefone' => '+55 213202-4030', 'estado' => 'RJ', 'cidade' => 'Rio de Janeiro', 'rua' => 'Av. Vieira Souto', 'bairro' => 'Ipanema', 'numero' => '80', 'horario_funcionamento' => 'Segunda a Domingo das 12:00 às 23:00 horas', 'sobre' => 'O Restaurante Fasano no Rio de Janeiro é um dos ícones da alta gastronomia da cidade, oferecendo pratos italianos sofisticados em um ambiente elegante e acolhedor. Com uma carta de vinhos premiada e receitas tradicionais italianas preparadas com ingredientes de primeira linha, o Fasano proporciona uma experiência gastronômica inesquecível. Localizado em Ipanema, é o destino ideal para quem busca excelência em comida e serviço em um ambiente requintado.']),
            new Restaurante(['id_restaurante' => 11, 'nome' => 'Gastro Pub', 'telefone' => '+55 3198312-7606', 'estado' => 'MG', 'cidade' => 'Ouro Preto', 'rua' => 'Rua Conde de Bobadela', 'bairro' => 'Centro', 'numero' => '132', 'horario_funcionamento' => 'Segunda a Domingo das 17:30 às 00:00 horas', 'sobre' => 'O Gastro Pub da Cidade de Ouro Preto oferece uma experiência única que combina a gastronomia contemporânea com o charme rústico da cidade histórica. Com um cardápio criativo e uma vasta seleção de bebidas, o local se destaca pelo ambiente descontraído e acolhedor, ideal para quem busca um jantar sofisticado e descontraído ao mesmo tempo. É um ótimo destino para quem deseja experimentar pratos inovadores em um ambiente agradável e animado.']),
        ]);

        $restaurante = $restaurantes->where('id_restaurante', $id)->first();
        if (!$restaurante) {
            abort(404);
        }
        return view('restaurante.detalhes', compact('restaurante'));
    }
}   
