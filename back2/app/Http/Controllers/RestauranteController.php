<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestauranteController extends Controller
{
    // Array com dados dos restaurantes
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
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0d/c3/89/b9/photo0jpg.jpg?w=1600&h=-1&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/23/4e/af/9c/caption.jpg?w=1100&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2a/97/59/ed/caption.jpg?w=1400&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/16/3a/eb/05/20190125-215743-largejpg.jpg?w=1000&h=-1&s=1",
            'badge' => "Premium",
            'promocao' => false,
            'link' => "jamile",
            'lat' => -23.5618,
            'lng' => -46.6501
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
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/27/5d/9b/33/restaurane-com-vista.jpg?w=800&h=-1&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/f9/9b/60/caption.jpg?w=1100&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/23/a8/99/95/caption.jpg?w=1400&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/23/a8/99/8c/caption.jpg?w=1100&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "casa-terracota",
            'lat' => -29.3754,
            'lng' => -50.8764
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
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1c/45/94/eb/medalhao-de-file-molho.jpg?w=1400&h=800&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/ec/e3/8e/caption.jpg?w=1100&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/21/fa/b2/6d/el-fuego-restaurante.jpg?w=1100&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "el-fuego",
            'lat' => -29.3789,
            'lng' => -50.8743
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
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/21/62/f0/19/caption.jpg?w=1100&h=-1&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2e/ac/c6/d2/caption.jpg?w=1100&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/13/40/27/90/restaurant.jpg?w=1100&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/97/32/a0/caption.jpg?w=1400&h=-1&s=1",
            'badge' => "Premium",
            'promocao' => false,
            'link' => "oro",
            'lat' => -22.9844,
            'lng' => -43.2208
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
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/29/96/b5/24/caption.jpg?w=1100&h=-1&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1c/22/64/ba/opcao-de-prato-principal.jpg?w=1400&h=800&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1c/22/64/71/vista-do-salao-do-cipriani.jpg?w=1400&h=800&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/44/32/84/caption.jpg?w=1100&h=600&s=1",
            'badge' => "Premium",
            'promocao' => false,
            'link' => "cipriani",
            'lat' => -22.9786,
            'lng' => -43.1887
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
            'imagem' => "https://uploads.metroimg.com/wp-content/uploads/2021/04/19115037/Gero-Fasano-Ambiente-externo-1-1-1.jpg",
            'prato' => "https://www.fasano.com.br/wp-content/uploads/2023/10/SPAGHETTI-ALLA-CARBONARA-10200-SPAGHETTI-COM-PARMESAO-GEMA-DE-OVO-E-GUANCIALE_Alta_CredTomasRangel-1-scaled.jpg",
            'ambiente' => "https://www.fasano.com.br/wp-content/uploads/2023/10/Gero_HFRJ_credBruno-Fioravanti-2.jpg",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1c/5f/fc/f5/20201128-211353-largejpg.jpg?w=800&h=-1&s=1",
            'badge' => "Premium",
            'promocao' => false,
            'link' => "fasano",
            'lat' => -22.9862,
            'lng' => -43.1946
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
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/d1/fb/5d/caption.jpg?w=1400&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/78/8f/ef/caption.jpg?w=1100&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/d1/fb/5e/caption.jpg?w=1400&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "terraco-italia",
            'lat' => -23.5455,
            'lng' => -46.6433
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
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/79/51/a3/caption.jpg?w=1400&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/53/f4/25/caption.jpg?w=1100&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2b/50/b7/4d/caption.jpg?w=800&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "porto-canoas",
            'lat' => -25.6831,
            'lng' => -54.4415
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
            'imagem' => "https://admin.cassinotur.com.br/arq/cursos/galeria/7715761242c819aef8fa6813798388ef.png",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/c6/c6/03/caption.jpg?w=1100&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/70/ac/65/caption.jpg?w=1400&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/09/ea/b7/b4/20151231-212854-largejpg.jpg?w=800&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "rafain",
            'lat' => -25.5167,
            'lng' => -54.5833
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
            'imagem' => "https://www.iguassu.com.br/wp-content/uploads/elementor/thumbs/la-mafia1-pq2oybbk1cb4qpx4j2ivb0l80yupyv0sv87fhn5k3k.jpg",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/56/17/21/caption.jpg?w=800&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/7e/65/16/caption.jpg?w=1400&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/b2/5e/1b/caption.jpg?w=1400&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "la-mafia-trattoria",
            'lat' => -25.5452,
            'lng' => -54.5821
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
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/07/c9/69/46/bene-da-flauta.jpg?w=1400&h=800&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1c/77/54/1e/feijao-tropeiro.jpg?w=1100&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/04/a0/c3/7e/bene-da-flauta.jpg?w=1800&h=1000&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1d/9a/28/ea/caption.jpg?w=800&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "bene-da-flauta",
            'lat' => -20.3856,
            'lng' => -43.5034
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
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/31/0d/e5/33/caption.jpg?w=1100&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/24/c6/4d/37/salao-bar.jpg?w=1400&h=800&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2d/27/39/ae/caption.jpg?w=1100&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "gastro-pub",
            'lat' => -20.3867,
            'lng' => -43.5052
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
            'prato' => "https://media-cdn.tripadvisor.com/media/photo-s/10/bd/5f/f8/comida-mineira.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-s/11/97/25/fb/photo3jpg.jpg",
            'sobremesas' => "https://media-cdn.tripadvisor.com/media/photo-s/09/c4/08/cc/restaurante-contos-de.jpg",
            'badge' => null,
            'promocao' => false,
            'link' => "contos-dos-reis",
            'lat' => -20.3878,
            'lng' => -43.5065
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
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1b/7c/e6/90/mangue.jpg?w=1100&h=-1&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/72/90/bb/caption.jpg?w=1100&h=600&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2d/36/c2/1c/caption.jpg?w=1100&h=600&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/24/cb/e3/7e/caption.jpg?w=1100&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "mangue",
            'lat' => -2.7506,
            'lng' => -42.8263
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
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/05/a2/26/2a/rustico-chic-palha-nativa.jpg?w=1800&h=1000&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/05/a2/24/53/nosso-bar-completo-e.jpg?w=1800&h=1000&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/31/15/0e/b7/caption.jpg?w=1400&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/d4/2a/c2/caption.jpg?w=1400&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "canoa",
            'lat' => -2.7498,
            'lng' => -42.8271
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
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/3d/3a/b6/ta-img-20181103-123055.jpg?w=1100&h=600&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/8b/94/62/caption.jpg?w=1400&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0f/75/83/72/porcao-de-mandioca-frita.jpg?w=1800&h=1000&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "terral",
            'lat' => -2.7489,
            'lng' => -42.8282
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
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0a/d2/13/82/ambiente-climatizado.jpg?w=1600&h=900&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/27/9e/94/e1/entrecot-south.jpg?w=1200&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/26/f1/06/7c/caption.jpg?w=1400&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/10/f5/ba/2a/20171013-130442-largejpg.jpg?w=2000&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "alameda",
            'lat' => -27.4246,
            'lng' => -48.4253
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
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/e5/96/8f/caption.jpg?w=1100&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2b/7e/4c/80/caption.jpg?w=1100&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/ba/9a/59/caption.jpg?w=1000&h=-1&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "olivia-cucina",
            'lat' => -27.5935,
            'lng' => -48.5532
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
            'prato' => "https://lh3.googleusercontent.com/proxy/xcRO8Hm3Ku3Agds1cPKb7JqObm7d-1_sBnF_i9hiz3akRnXOplx4Uz_R-P9xnG2cV9cHhnCQemY1aVbzqTaInR9d5-yqrfezMZuytiQ",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-s/0f/c1/7b/62/ambiente-agradavel.jpg",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/07/0a/07/66/dolce-vita-milano.jpg?w=900&h=500&s=1",
            'badge' => null,
            'promocao' => false,
            'link' => "dolce-vita",
            'lat' => -27.5942,
            'lng' => -48.5487
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'badge' => null,
            'promocao' => false,
            'link' => "capim-santo",
            'lat' => -23.5697,
            'lng' => -46.6922
        ]
    ];

    public function show($id)
    {
        // Encontra o restaurante pelo ID usando collect para maior eficiência
        $restaurante = collect($this->restaurantes)->firstWhere('id', $id);

        // Se não encontrar, retorna erro 404
        if (!$restaurante) {
            abort(404, 'Restaurante não encontrado');
        }

        // Garante que as propriedades prato, ambiente e sobremesas existam
        $restaurante = array_merge([
            'prato' => null,
            'ambiente' => null,
            'sobremesas' => null,
        ], $restaurante);

        // Converte array para objeto para facilitar o uso na view
        return view('destinos.restaurantes.show', ['restaurante' => (object) $restaurante]);
    }

    public function index(Request $request)
    {
        // Filtros
        $filtrados = collect($this->restaurantes); // Usa collect para facilitar manipulação

        if ($request->has('tipo_cozinha') && $request->tipo_cozinha) {
            $filtrados = $filtrados->filter(function ($r) use ($request) {
                return in_array($request->tipo_cozinha, $r['tipos']);
            });
        }

        if ($request->has('preco') && $request->preco) {
            $filtrados = $filtrados->filter(function ($r) use ($request) {
                return $r['preco'] === $request->preco;
            });
        }

        if ($request->has('avaliacao') && $request->avaliacao) {
            $filtrados = $filtrados->filter(function ($r) use ($request) {
                return $r['avaliacao'] >= floatval($request->avaliacao);
            });
        }

        if ($request->has('localizacao') && $request->localizacao) {
            $filtrados = $filtrados->filter(function ($r) use ($request) {
                return $r['cidade'] === $request->localizacao;
            });
        }

        // Se for requisição AJAX, retorna JSON
        if ($request->ajax()) {
            return response()->json($filtrados->values()->all());
        }

        // Se for requisição normal, retorna a view principal
        return view('restaurante', ['restaurantes' => $filtrados->values()->all()]);
    }
}
