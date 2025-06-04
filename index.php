<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bella Back Novo - Sistema de Gerenciamento de Turismo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .nav-info {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
        }

        .main-content {
            padding: 3rem 0;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .welcome-title {
            font-size: 3rem;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease-out;
        }

        .welcome-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease-out var(--delay, 0s) both;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 48px rgba(0,0,0,0.15);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: white;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }

        .card-description {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .card-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
            display: inline-block;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border: 1px solid rgba(102, 126, 234, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(102, 126, 234, 0.2);
        }

        .btn-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .btn-danger:hover {
            background: rgba(220, 53, 69, 0.2);
        }

        .quick-access {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .quick-access-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #333;
            text-align: center;
        }

        .quick-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .quick-link {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 10px;
            text-decoration: none;
            color: #333;
            transition: all 0.2s ease;
            border: 1px solid rgba(102, 126, 234, 0.1);
        }

        .quick-link:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateX(5px);
        }

        .quick-link-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            font-size: 1rem;
        }

        .footer {
            text-align: center;
            padding: 2rem 0;
            color: rgba(255, 255, 255, 0.8);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2rem;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-links {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">🌟 Bella Back Novo</div>
                <div class="nav-info">Sistema de Gerenciamento de Turismo</div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <section class="welcome-section">
                <h1 class="welcome-title">Bem-vindo ao Bella Back</h1>
                <p class="welcome-subtitle">Gerencie facilmente usuários, viagens, hotéis, restaurantes e pontos turísticos</p>
            </section>

            <div class="dashboard-grid">
                <div class="dashboard-card" style="--delay: 0.1s">
                    <div class="card-icon">👥</div>
                    <h2 class="card-title">Usuários</h2>
                    <p class="card-description">Gerencie usuários do sistema, cadastre novos perfis e visualize informações detalhadas.</p>
                    <div class="card-actions">
                        <a href="usuario_form/" class="btn btn-primary">Formulário</a>
                        <a href="list-usuario/" class="btn btn-secondary">Listar</a>
                    </div>
                </div>

                <div class="dashboard-card" style="--delay: 0.2s">
                    <div class="card-icon">🔧</div>
                    <h2 class="card-title">Administradores</h2>
                    <p class="card-description">Controle de acesso e gerenciamento de administradores do sistema.</p>
                    <div class="card-actions">
                        <a href="adm_form/" class="btn btn-primary">Formulário</a>
                        <a href="list-adm/" class="btn btn-secondary">Listar</a>
                    </div>
                </div>

                <div class="dashboard-card" style="--delay: 0.3s">
                    <div class="card-icon">✈️</div>
                    <h2 class="card-title">Viagens</h2>
                    <p class="card-description">Organize e gerencie pacotes de viagens, destinos e itinerários completos.</p>
                    <div class="card-actions">
                        <a href="viagem_form/" class="btn btn-primary">Formulário</a>
                        <a href="list-viagem/" class="btn btn-secondary">Listar</a>
                        <a href="#" class="btn btn-danger" onclick="confirmarDelete('viagem')">Excluir</a>
                    </div>
                </div>

                <div class="dashboard-card" style="--delay: 0.4s">
                    <div class="card-icon">🍽️</div>
                    <h2 class="card-title">Restaurantes</h2>
                    <p class="card-description">Cadastre e gerencie restaurantes parceiros, cardápios e avaliações.</p>
                    <div class="card-actions">
                        <a href="restaurante_form/" class="btn btn-primary">Formulário</a>
                        <a href="list-restaurante/" class="btn btn-secondary">Listar</a>
                        <a href="#" class="btn btn-danger" onclick="confirmarDelete('restaurante')">Excluir</a>
                    </div>
                </div>

                <div class="dashboard-card" style="--delay: 0.5s">
                    <div class="card-icon">🏨</div>
                    <h2 class="card-title">Hotéis</h2>
                    <p class="card-description">Gerencie acomodações, disponibilidade e reservas de hotéis parceiros.</p>
                    <div class="card-actions">
                        <a href="hotel_form/" class="btn btn-primary">Formulário</a>
                        <a href="list-hotel/" class="btn btn-secondary">Listar</a>
                        <a href="#" class="btn btn-danger" onclick="confirmarDelete('hotel')">Excluir</a>
                    </div>
                </div>

                <div class="dashboard-card" style="--delay: 0.6s">
                    <div class="card-icon">🗺️</div>
                    <h2 class="card-title">Pontos Turísticos</h2>
                    <p class="card-description">Catalogue atrações turísticas, monumentos e locais de interesse.</p>
                    <div class="card-actions">
                        <a href="pontoturistico_form/" class="btn btn-primary">Formulário</a>
                        <a href="list-pontoturistico/" class="btn btn-secondary">Listar</a>
                    </div>
                </div>

                <div class="dashboard-card" style="--delay: 0.7s">
                    <div class="card-icon">💬</div>
                    <h2 class="card-title">Feedback</h2>
                    <p class="card-description">Colete e analise feedbacks dos usuários para melhorar os serviços.</p>
                    <div class="card-actions">
                        <a href="feedback_form/" class="btn btn-primary">Formulário</a>
                        <a href="list-feedback/" class="btn btn-secondary">Listar</a>
                    </div>
                </div>

                <div class="dashboard-card" style="--delay: 0.8s">
                    <div class="card-icon">🔗</div>
                    <h2 class="card-title">API</h2>
                    <p class="card-description">Configure integrações externas e gerencie endpoints da API.</p>
                    <div class="card-actions">
                        <a href="api_form/" class="btn btn-primary">Formulário</a>
                        <a href="list-api/" class="btn btn-secondary">Listar</a>
                        <a href="#" class="btn btn-danger" onclick="confirmarDelete('api')">Excluir</a>
                    </div>
                </div>

                <div class="dashboard-card" style="--delay: 0.9s">
                    <div class="card-icon">⭐</div>
                    <h2 class="card-title">Pontos</h2>
                    <p class="card-description">Sistema de pontuação e recompensas para usuários ativos.</p>
                    <div class="card-actions">
                        <a href="ponto_form/" class="btn btn-primary">Formulário</a>
                        <a href="list-ponto/" class="btn btn-secondary">Listar</a>
                        <a href="#" class="btn btn-danger" onclick="confirmarDelete('ponto')">Excluir</a>
                    </div>
                </div>
            </div>

            <section class="quick-access">
                <h2 class="quick-access-title">Acesso Rápido</h2>
                <div class="quick-links">
                    <a href="usuario_form/" class="quick-link">
                        <div class="quick-link-icon">👤</div>
                        <span>Novo Usuário</span>
                    </a>
                    <a href="viagem_form/" class="quick-link">
                        <div class="quick-link-icon">✈️</div>
                        <span>Nova Viagem</span>
                    </a>
                    <a href="list-feedback/" class="quick-link">
                        <div class="quick-link-icon">📊</div>
                        <span>Ver Feedbacks</span>
                    </a>
                    <a href="list-usuario/" class="quick-link">
                        <div class="quick-link-icon">📋</div>
                        <span>Relatórios</span>
                    </a>
                </div>
            </section>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Bella Back Novo - Sistema de Gerenciamento de Turismo</p>
        </div>
    </footer>

    <script>
        // Adicionar animações suaves ao scroll
        document.addEventListener('DOMContentLoaded', function() {
            // Animação de entrada dos cards
            const cards = document.querySelectorAll('.dashboard-card');
            
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const cardObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            cards.forEach(card => {
                cardObserver.observe(card);
            });
            
            // Efeito de hover nos botões
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                button.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('btn-primary')) {
                        this.style.transform = 'translateY(0)';
                    }
                });
            });
        });

        // Função para confirmar exclusão
        function confirmarDelete(tipo) {
            const id = prompt(`Digite o ID do ${tipo} para excluir:`);
            if (id && id.trim() !== '') {
                if (confirm(`Tem certeza que deseja excluir o ${tipo} com ID ${id}?`)) {
                    window.location.href = `delete-${tipo}/?id=${id}`;
                }
            }
        }
    </script>
</body>
</html>