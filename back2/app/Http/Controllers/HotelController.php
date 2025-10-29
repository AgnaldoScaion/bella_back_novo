<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // Array com dados dos hotéis
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
            'prato' => "https://a0.muscache.com/im/pictures/miso/Hosting-741865012507066226/original/78af1dea-8203-47a1-b447-fd958c62607f.jpeg?im_w=1440",
            'ambiente' => "https://a0.muscache.com/im/pictures/miso/Hosting-741865012507066226/original/0a8488cf-f463-4d46-baf2-783cd86ec11a.jpeg?im_w=1440",
            'sobremesas' => "https://a0.muscache.com/im/pictures/miso/Hosting-741865012507066226/original/85c19890-3a8a-4e8a-bb4c-1fdb3859f10c.jpeg?im_w=1440",
            'avaliacoes' => 2378,
            'rota' => "hoteis.capsula-hotel-sp",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Ar Condicionado", "Café da Manhã"],
            'lat' => -23.5505,
            'lng' => -46.6333
        ],
        [
            'id' => 2,
            'nome' => "Hotel Atlântico Business",
            'avaliacao' => 4.9,
            'localizacao' => "Dantas, Rio de Janeiro",
            'preco' => 850,
            'precoTexto' => "R$ 850",
            'cidade' => "rj",
            'imagem' => "https://images.trvl-media.com/lodging/5000000/4320000/4316400/4316320/afb006b3.jpg?impolicy=resizecrop&rw=1200&ra=fit",
            'prato' => "https://images.trvl-media.com/lodging/5000000/4320000/4316400/4316320/a0e298ae.jpg?impolicy=resizecrop&rw=1200&ra=fit",
            'ambiente' => "https://images.trvl-media.com/lodging/5000000/4320000/4316400/4316320/f7cca0ff.jpg?impolicy=resizecrop&rw=1200&ra=fit",
            'sobremesas' => "https://images.trvl-media.com/lodging/5000000/4320000/4316400/4316320/2e3b27f0.jpg?impolicy=resizecrop&rw=1200&ra=fit",
            'avaliacoes' => 1975,
            'rota' => "hoteis.atlantico-business-rj",
            'categoria' => "premium",
            'estrelas' => 5,
            'comodidades' => ["Wi-Fi", "Piscina", "Academia", "Restaurante"],
            'lat' => -22.9068,
            'lng' => -43.1729
        ],
        [
            'id' => 3,
            'nome' => "Minas Garden Hotel",
            'avaliacao' => 4.7,
            'localizacao' => "Poços de Caldas, Minas Gerais",
            'preco' => 550,
            'precoTexto' => "R$ 550",
            'cidade' => "mg",
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0e/fa/e9/d8/entrance--v15998074.jpg?w=2000&h=-1&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/72/e1/37/caption.jpg?w=1400&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0e/fa/e9/72/breakfast-room--v15998022.jpg?w=2000&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/30/36/ec/09/caption.jpg?w=1400&h=-1&s=1",
            'avaliacoes' => 1526,
            'rota' => "hoteis.minas-garden-mg",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Ar Condicionado", "Café da Manhã"],
            'lat' => -21.7874,
            'lng' => -46.5693
        ],
        [
            'id' => 4,
            'nome' => "Blue Tree Towers",
            'avaliacao' => 4.8,
            'localizacao' => "São Luís, Maranhão",
            'preco' => 580,
            'precoTexto' => "R$ 580",
            'cidade' => "ma",
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/16/96/4c/9b/blue-tree-towers-sao.jpg?w=800&h=-1&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/16/96/56/cf/blue-tree-towers-sao.jpg?w=800&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/ae/7e/16/caption.jpg?w=1400&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/16/96/4c/cc/blue-tree-towers-sao.jpg?w=800&h=-1&s=1",
            'avaliacoes' => 3494,
            'rota' => "hoteis.blue-tree-ma",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Piscina", "Café da Manhã"],
            'lat' => -2.5307,
            'lng' => -44.3068
        ],
        [
            'id' => 5,
            'nome' => "Ingleses Palace Hotel",
            'avaliacao' => 4.9,
            'localizacao' => "Florianópolis, Santa Catarina",
            'preco' => 980,
            'precoTexto' => "R$ 980",
            'cidade' => "sc",
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/22/4b/6e/e4/ingleses-palace-hotel.jpg?w=1400&h=-1&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/22/4b/6e/65/ingleses-palace-hotel.jpg?w=1400&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/22/4b/6b/df/cafe-da-manha.jpg?w=1400&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/22/4b/6c/4e/piscina-frente-ao-mar.jpg?w=1400&h=-1&s=1",
            'avaliacoes' => 1550,
            'rota' => "hoteis.ingleses-palace-sc",
            'categoria' => "premium",
            'estrelas' => 5,
            'comodidades' => ["Wi-Fi", "Piscina", "Academia", "Restaurante"],
            'lat' => -27.5954,
            'lng' => -48.5480
        ],
        [
            'id' => 6,
            'nome' => "Hotel Colline de France-Gramado",
            'avaliacao' => 4.6,
            'localizacao' => "Gramado, Rio Grande do Sul",
            'preco' => 480,
            'precoTexto' => "R$ 480",
            'cidade' => "rs",
            'imagem' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/22/00/50/fd/hotel-colline-de-france.jpg?w=1200&h=-1&s=1",
            'prato' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/19/f8/f1/16/hotel-colline-de-france.jpg?w=1400&h=-1&s=1",
            'ambiente' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/4f/fa/b2/hotel-colline-de-france.jpg?w=900&h=-1&s=1",
            'sobremesas' => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/31/4a/e5/07/caption.jpg?w=1100&h=-1&s=1",
            'avaliacoes' => 1526,
            'rota' => "hoteis.colline-france-rs",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Café da Manhã", "Estacionamento"],
            'lat' => -29.3739,
            'lng' => -50.8811
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
            'prato' => "https://images.unsplash.com/photo-1519125323398-675f0ddb6308", // Quarto hotel moderno
            'ambiente' => "https://images.unsplash.com/photo-1507525428034-b723cf961d3e", // Praia Copacabana
            'sobremesas' => "https://images.unsplash.com/photo-1464983953574-0892a716854b", // Banheiro moderno
            'avaliacoes' => 6362,
            'rota' => "hoteis.atlantico-copacabana-rj",
            'categoria' => "premium",
            'estrelas' => 5,
            'comodidades' => ["Wi-Fi", "Piscina", "Academia", "Restaurante"],
            'lat' => -22.9711,
            'lng' => -43.1828
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
            'prato' => "https://images.pexels.com/photos/271639/pexels-photo-271639.jpeg", // Quarto de hotel com vista para praia
            'ambiente' => "https://images.unsplash.com/photo-1465156799763-2c087c332922", // Praia tropical
            'sobremesas' => "https://images.pexels.com/photos/1457845/pexels-photo-1457845.jpeg", // Banheiro clean
            'avaliacoes' => 3695,
            'rota' => "hoteis.atlantico-praia-rj",
            'categoria' => "premium",
            'estrelas' => 5,
            'comodidades' => ["Wi-Fi", "Piscina", "Restaurante"],
            'lat' => -22.9721,
            'lng' => -43.1838
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
            'prato' => "https://images.unsplash.com/photo-1503676382389-4809596d5290", // Quarto hotel urbano
            'ambiente' => "https://images.unsplash.com/photo-1465101046530-73398c7f28ca", // Vista urbana Porto Alegre
            'sobremesas' => "https://images.unsplash.com/photo-1507089947368-19c1da9775ae", // Banheiro hotel
            'avaliacoes' => 3281,
            'rota' => "hoteis.continental-rs",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Ar Condicionado", "Café da Manhã"],
            'lat' => -30.0346,
            'lng' => -51.2177
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
            'prato' => "https://images.unsplash.com/photo-1519710164239-da123dc03ef4", // Quarto hotel aconchegante
            'ambiente' => "https://images.unsplash.com/photo-1501785888041-af3ef285b470", // Natureza Paraná
            'sobremesas' => "https://images.pexels.com/photos/624015/pexels-photo-624015.jpeg", // Banheiro clean
            'avaliacoes' => 58,
            'rota' => "hoteis.goldmen-express-pr",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Café da Manhã", "Estacionamento"],
            'lat' => -23.6633,
            'lng' => -52.6108
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'avaliacoes' => 1425,
            'rota' => "hoteis.gran-villagio-sp",
            'categoria' => "premium",
            'estrelas' => 5,
            'comodidades' => ["Wi-Fi", "Piscina", "Academia", "Restaurante"],
            'lat' => -23.5515,
            'lng' => -46.6343
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'avaliacoes' => 205,
            'rota' => "hoteis.life-infinity-rs",
            'categoria' => "premium",
            'estrelas' => 5,
            'comodidades' => ["Wi-Fi", "Piscina", "Restaurante"],
            'lat' => -29.3749,
            'lng' => -50.8821
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'avaliacoes' => 4103,
            'rota' => "hoteis.oceania-park-sc",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Spa", "Piscina", "Restaurante"],
            'lat' => -27.4510,
            'lng' => -48.5500
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'avaliacoes' => 247,
            'rota' => "hoteis.por-do-sol-mg",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Café da Manhã", "Estacionamento"],
            'lat' => -22.7497,
            'lng' => -45.9911
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'avaliacoes' => 1182,
            'rota' => "hoteis.agua-marinha-pr",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Piscina", "Café da Manhã"],
            'lat' => -25.8800,
            'lng' => -48.5833
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'avaliacoes' => 651,
            'rota' => "hoteis.canto-vigia-sc",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Café da Manhã", "Estacionamento"],
            'lat' => -26.7833,
            'lng' => -48.6167
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'avaliacoes' => 276,
            'rota' => "hoteis.pousada-universal-ma",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Ar Condicionado", "Café da Manhã"],
            'lat' => -7.3619,
            'lng' => -46.6744
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'avaliacoes' => 80,
            'rota' => "hoteis.hotel-rios-ma",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Café da Manhã", "Estacionamento"],
            'lat' => -7.5321,
            'lng' => -46.0355
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'avaliacoes' => 2526,
            'rota' => "hoteis.san-michel-sp",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Ar Condicionado", "Café da Manhã"],
            'lat' => -23.5440,
            'lng' => -46.6423
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'avaliacoes' => 1864,
            'rota' => "hoteis.viale-cataratas-pr",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Piscina", "Restaurante"],
            'lat' => -25.5478,
            'lng' => -54.5873
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
            'prato' => "https://spcity.com.br/wp-content/uploads/2017/11/capim-santo.jpg",
            'ambiente' => "https://media-cdn.tripadvisor.com/media/photo-m/1280/29/0d/e0/2c/nosso-espaco-interno.jpg",
            'sobremesas' => "https://duogourmet-images.s3.us-east-2.amazonaws.com/restaurants/63e15d16dd61931740f887f3/cover.jpg?v=202303021143",
            'avaliacoes' => 13335,
            'rota' => "hoteis.villa-lobos-mg",
            'categoria' => "medio",
            'estrelas' => 4,
            'comodidades' => ["Wi-Fi", "Spa", "Piscina", "Restaurante", "Tratamentos Relaxantes"],
            'lat' => -22.8548,
            'lng' => -46.3186
        ]
    ];

    /**
     * Retorna um hotel pelo ID (método público para ser usado por outros controllers)
     */
    public function getHotelById($id)
    {
        foreach ($this->hoteis as $hotel) {
            if ($hotel['id'] == $id) {
                return $hotel;
            }
        }
        return null;
    }

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

    public function index(Request $request)
    {
        // Se for requisição AJAX, retorna JSON
        if ($request->ajax()) {
            $filtrados = $this->hoteis;
            // Aplicar filtros
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
            return response()->json(array_values($filtrados));
        }
        // Se for requisição normal, retorna a view principal
        return view('hoteis');
    }

    // Método auxiliar para obter hotel por rota
    public function getHotelByRoute($rota)
    {
        foreach ($this->hoteis as $hotel) {
            if ($hotel['rota'] === $rota) {
                return $hotel;
            }
        }
        return null;
    }
}
