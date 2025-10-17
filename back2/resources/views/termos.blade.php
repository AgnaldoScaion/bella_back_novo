@extends('layouts.app')

@section('title', 'Termos e Condições')

@section('styles')
    <style>
        .terms-container {
            max-width: 1000px;
            margin: 4rem auto 2rem;
            padding: 0 2rem;
            animation: fadeIn 0.8s ease;
        }
        .terms-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .terms-header h1 {
            color: #5a8f3d;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            animation: slideInUp 0.8s ease;
        }
        .terms-header .update-date {
            color: #666;
            font-style: italic;
            margin-bottom: 1rem;
            animation: fadeIn 1.2s ease;
        }
        .terms-content {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            border: 3px solid #D8E6D9;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .terms-content:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }
        .terms-section {
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease forwards;
            opacity: 0;
        }
        .terms-section:nth-child(1) { animation-delay: 0.2s; }
        .terms-section:nth-child(2) { animation-delay: 0.4s; }
        .terms-section:nth-child(3) { animation-delay: 0.6s; }
        .terms-section:nth-child(4) { animation-delay: 0.8s; }
        .terms-section:nth-child(5) { animation-delay: 1.0s; }
        .terms-section:nth-child(6) { animation-delay: 1.2s; }
        .terms-section:nth-child(7) { animation-delay: 1.4s; }
        .terms-section:nth-child(8) { animation-delay: 1.6s; }
        .terms-section:nth-child(9) { animation-delay: 1.8s; }
        .terms-section:nth-child(10) { animation-delay: 2.0s; }
        .terms-section:nth-child(11) { animation-delay: 2.2s; }
        .terms-section:nth-child(12) { animation-delay: 2.4s; }
        .terms-section:nth-child(13) { animation-delay: 2.6s; }
        .terms-section h2 {
            color: #5a8f3d;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid #D8E6D9;
            padding-bottom: 0.5rem;
            transition: all 0.3s ease;
        }
        .terms-section h2:hover {
            color: #3a6f1d;
            border-bottom-color: #3a6f1d;
        }
        .terms-section p, .terms-section ul {
            margin-bottom: 1rem;
            font-weight: 400;
        }
        .terms-section ul {
            padding-left: 1.5rem;
        }
        .terms-section li {
            margin-bottom: 0.8rem;
            position: relative;
            transition: all 0.3s ease;
            padding-left: 10px;
        }
        .terms-section li:hover {
            transform: translateX(5px);
        }
        .terms-section li::before {
            content: "•";
            color: #5a8f3d;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
            transition: all 0.3s ease;
        }
        .terms-section li:hover::before {
            color: #3a6f1d;
            transform: scale(1.5);
        }
    </style>
@endsection

@section('content')
<div class="terms-container">
    <div class="terms-header">
        <h1>TERMOS E CONDIÇÕES</h1>
        <div class="update-date">Última atualização: 01/04/2025</div>
    </div>
    <div class="terms-content">
                <div class="terms-section">
                    <h2>1. Aceitação dos Termos</h2>
                    <p>Ao acessar ou utilizar este site, você concorda em cumprir e se submeter aos Termos e Condições
                        descritos abaixo, incluindo a nossa Política de Privacidade. Se você não concordar com esses
                        termos, deve interromper o uso do site imediatamente.</p>
                </div>

                <div class="terms-section">
                    <h2>2. Descrição dos Serviços</h2>
                    <p>O Bella Avventura oferece uma plataforma para pesquisa e reserva de viagens, incluindo pacotes
                        turísticos, passagens, hospedagem e serviços relacionados. A nossa missão é proporcionar uma
                        experiência única de viagem, fornecendo as melhores opções e informações para seus destinos.</p>
                </div>

                <div class="terms-section">
                    <h2>3. Conta de Usuário</h2>
                    <p>Para acessar alguns serviços no nosso site, você pode precisar criar uma conta. Você concorda em
                        fornecer informações verdadeiras, completas e atualizadas ao registrar-se, e será responsável
                        por manter a confidencialidade da sua conta e senha.</p>
                </div>

                <div class="terms-section">
                    <h2>4. Reservas e Pagamentos</h2>
                    <ul>
                        <li><strong>Reservas:</strong> Ao realizar uma reserva, você concorda em pagar pelos serviços
                            solicitados. A confirmação da reserva estará sujeita à disponibilidade do serviço e
                            confirmação do fornecedor.</li>
                        <li><strong>Preços e Pagamentos:</strong> Os preços são informados durante o processo de
                            reserva. O pagamento será processado por meio de plataformas seguras, e todas as taxas
                            aplicáveis serão informadas no momento da compra.</li>
                        <li><strong>Impostos:</strong> Quaisquer impostos ou encargos devidos em decorrência de uma
                            reserva serão de responsabilidade do usuário.</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h2>5. Cancelamentos e Reembolsos</h2>
                    <ul>
                        <li><strong>Política de Cancelamento:</strong> A política de cancelamento dos serviços pode
                            variar conforme o fornecedor. Certifique-se de revisar as condições antes de confirmar sua
                            reserva.</li>
                        <li><strong>Reembolsos:</strong> Se aplicável, os reembolsos serão processados conforme as
                            diretrizes do fornecedor e após análise de nossa equipe.</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h2>6. Propriedade Intelectual</h2>
                    <p>Todo o conteúdo deste site, incluindo textos, gráficos, logotipos, imagens e marcas, é
                        propriedade do Bella Avventura ou de seus respectivos proprietários e está protegido por
                        direitos autorais, marcas registradas e outras leis de propriedade intelectual. O uso não
                        autorizado desse conteúdo é proibido.</p>
                </div>

                <div class="terms-section">
                    <h2>7. Uso Responsável do Site</h2>
                    <ul>
                        <li><strong>Comportamento do Usuário:</strong> Você concorda em usar o site de maneira legal,
                            ética e respeitosa. Não é permitido usar o site para violar leis ou prejudicar outros
                            usuários.</li>
                        <li><strong>Segurança:</strong> Você deve manter a segurança de sua conta e não deve
                            compartilhar suas credenciais com terceiros. O site não se responsabiliza por atividades
                            realizadas por pessoas não autorizadas, caso haja falha na segurança de sua conta.</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h2>8. Limitação de Responsabilidade</h2>
                    <p>O Bella Avventura não será responsável por quaisquer danos diretos, indiretos, incidentais,
                        especiais ou consequenciais resultantes de falhas nos serviços oferecidos, incluindo
                        interrupções de viagem, cancelamentos ou alterações de última hora nos serviços prestados pelos
                        fornecedores.</p>
                </div>

                <div class="terms-section">
                    <h2>9. Alterações dos Termos e Condições</h2>
                    <p>O Bella Avventura reserva-se o direito de modificar ou atualizar estes Termos e Condições a
                        qualquer momento, sem aviso prévio. A versão atualizada estará disponível no site, e o uso
                        contínuo do site implica em sua aceitação.</p>
                </div>

                <div class="terms-section">
                    <h2>10. Política de Privacidade</h2>
                    <p>Sua privacidade é importante para nós. Consulte nossa Política de Privacidade para entender como
                        coletamos, usamos e protegemos suas informações pessoais.</p>
                </div>

                <div class="terms-section">
                    <h2>11. Força Maior</h2>
                    <p>O Bella Avventura não será responsável por falhas no cumprimento das obrigações quando o evento
                        for causado por força maior, como desastres naturais, guerras, greves, falhas de internet ou
                        qualquer outro evento fora do controle razoável.</p>
                </div>

                <div class="terms-section">
                    <h2>12. Jurisdição e Legislação Aplicável</h2>
                    <p>Esses Termos e Condições são regidos pelas leis do Brasil, e qualquer disputa será
                        resolvida nos tribunais competentes dessa jurisdição.</p>
                </div>

                <div class="terms-section">
                    <h2>13. Contato</h2>
                    <p>Se tiver dúvidas ou questões sobre estes Termos e Condições, entre em contato conosco através do
                        e-mail: bella.avventura@gmail.com.</p>
                    <p>Obrigado por escolher o Bella Avventura. Estamos comprometidos em tornar sua viagem inesquecível.
                    </p>
                </div>
            </div>
        </div>

        <!-- Rodapé -->
        <footer class="footer">
            <div class="footer-top">
                <a href="https://www.bellaavventura.com.br/">
                    <img src="https://i.ibb.co/j9vGknyy/image.png" alt="Logo">
                </a>
            </div>
            <div class="footer-bottom">
                <div class="footer-left">
                    <a href="mailto:bella.avventura@gmail.com">📧 bella.avventura@gmail.com</a>
                </div>
                <div class="footer-center">© 2025 Bella Avventura</div>
                <div class="footer-right">
                    <a href="{{ route('termos') }}">Termos e condições</a>
                </div>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle menu
            const menuIcon = document.querySelector('.menu-icon');
            const menuNaoLogado = document.getElementById('menu-nao-logado');
            const menuLogado = document.getElementById('menu-logado');
            const menu = menuNaoLogado || menuLogado;

            if (menu && menuIcon) {
                menuIcon.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                    menu.classList.toggle('visible');
                });
            }

            // Exibir notificação
            const notification = document.getElementById('notification');
            if (notification.textContent.trim()) {
                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            }
        });
    </script>
</body>
</html>
