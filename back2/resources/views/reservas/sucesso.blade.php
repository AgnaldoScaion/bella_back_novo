@extends('layouts.app')

@section('title', 'Reserva Realizada com Sucesso')

@section('styles')
<style>
    .sucesso-wrapper {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .sucesso-container {
        max-width: 800px;
        width: 100%;
    }

    .sucesso-card {
        background: white;
        border-radius: 24px;
        padding: 3rem 2rem;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        position: relative;
        overflow: hidden;
    }

    .sucesso-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #10b981, #059669);
    }

    .celebration-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.03;
        pointer-events: none;
        background-image:
            radial-gradient(circle at 20% 30%, #667eea 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, #764ba2 0%, transparent 50%);
    }

    .sucesso-content {
        position: relative;
        z-index: 1;
    }

    .success-icon-wrapper {
        text-align: center;
        margin-bottom: 2rem;
    }

    .success-icon {
        font-size: 6rem;
        animation: celebrate 1s ease-out;
        display: inline-block;
    }

    @keyframes celebrate {
        0% {
            transform: scale(0) rotate(-180deg);
            opacity: 0;
        }
        50% {
            transform: scale(1.2) rotate(10deg);
        }
        100% {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }
    }

    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background: #ffc107;
        animation: confetti-fall 3s ease-out infinite;
    }

    @keyframes confetti-fall {
        0% {
            transform: translateY(-100px) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(600px) rotate(720deg);
            opacity: 0;
        }
    }

    .sucesso-title {
        font-family: 'Garamond', serif;
        color: #10b981;
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .sucesso-subtitle {
        text-align: center;
        color: #4a5568;
        font-size: 1.1rem;
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    .codigo-section {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        border: 3px dashed #f59e0b;
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .codigo-section::before {
        content: '🎫';
        position: absolute;
        font-size: 8rem;
        opacity: 0.1;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .codigo-label {
        font-size: 0.9rem;
        color: #92400e;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.75rem;
    }

    .codigo-value {
        font-size: 2.2rem;
        font-weight: bold;
        color: #b45309;
        letter-spacing: 8px;
        font-family: 'Courier New', monospace;
        position: relative;
        z-index: 1;
    }

    .codigo-copy {
        margin-top: 1rem;
    }

    .btn-copy {
        background: #f59e0b;
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-copy:hover {
        background: #d97706;
        transform: translateY(-2px);
    }

    .detalhes-section {
        background: #f8fafc;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        border-left: 5px solid #10b981;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        color: #10b981;
        font-size: 1.3rem;
        font-weight: 700;
    }

    .detalhes-grid {
        display: grid;
        gap: 1rem;
    }

    .detalhe-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .detalhe-item:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .detalhe-label {
        font-weight: 600;
        color: #4a5568;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detalhe-value {
        color: #2c3e50;
        font-weight: 600;
    }

    .valor-destaque {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));
        border: 2px solid #10b981;
        padding: 1.5rem;
        border-radius: 12px;
        text-align: center;
    }

    .valor-label {
        font-size: 0.9rem;
        color: #059669;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .valor-amount {
        font-size: 2.5rem;
        font-weight: bold;
        color: #10b981;
    }

    .info-importante {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        border-left: 5px solid #3b82f6;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-importante-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 700;
        color: #1e40af;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .info-importante-text {
        color: #1e3a8a;
        line-height: 1.6;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .action-btn {
        padding: 1.25rem 2rem;
        border-radius: 14px;
        font-weight: 600;
        font-size: 1.05rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary-action {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-primary-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-secondary-action {
        background: white;
        color: #4a5568;
        border: 2px solid #e2e8f0;
    }

    .btn-secondary-action:hover {
        background: #f8fafc;
        border-color: #cbd5e0;
        transform: translateY(-2px);
    }

    .timeline {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px dashed #e2e8f0;
    }

    .timeline-title {
        text-align: center;
        color: #718096;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .timeline-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
    }

    .timeline-steps::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 10%;
        right: 10%;
        height: 2px;
        background: #e2e8f0;
        z-index: 0;
    }

    .timeline-step {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .step-icon {
        width: 40px;
        height: 40px;
        background: white;
        border: 3px solid #10b981;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        font-size: 1.2rem;
    }

    .step-text {
        font-size: 0.85rem;
        color: #4a5568;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .sucesso-title {
            font-size: 2rem;
        }

        .codigo-value {
            font-size: 1.5rem;
            letter-spacing: 4px;
        }

        .action-buttons {
            grid-template-columns: 1fr;
        }

        .timeline-steps {
            flex-direction: column;
            gap: 1rem;
        }

        .timeline-steps::before {
            display: none;
        }
    }
</style>
@endsection

@section('content')
<div class="sucesso-wrapper">
    <div class="sucesso-container">
        <div class="sucesso-card">
            <div class="celebration-bg"></div>

            <div class="sucesso-content">
                <!-- Ícone de Sucesso -->
                <div class="success-icon-wrapper">
                    <div class="success-icon">🎉</div>
                </div>

                <!-- Título e Subtítulo -->
                <h1 class="sucesso-title">Reserva Realizada!</h1>
                <p class="sucesso-subtitle">
                    Parabéns! Sua reserva foi registrada com sucesso em nosso sistema.<br>
                    Enviamos um email de confirmação com todos os detalhes.
                </p>

                <!-- Código de Confirmação -->
                <div class="codigo-section">
                    <div class="codigo-label">Código de Confirmação</div>
                    <div class="codigo-value" id="codigoConfirmacao">{{ $reserva->codigo_confirmacao }}</div>
                    <div class="codigo-copy">
                        <button class="btn-copy" onclick="copiarCodigo()">
                            <i class="fas fa-copy"></i> Copiar Código
                        </button>
                    </div>
                </div>

                <!-- Detalhes da Reserva -->
                <div class="detalhes-section">
                    <div class="section-header">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Detalhes da Reserva</span>
                    </div>

                    <div class="detalhes-grid">
                        <div class="detalhe-item">
                            <span class="detalhe-label">
                                <i class="fas fa-hotel"></i> Hotel
                            </span>
                            <span class="detalhe-value">{{ $reserva->hotel->nome ?? 'Hotel' }}</span>
                        </div>

                        <div class="detalhe-item">
                            <span class="detalhe-label">
                                <i class="fas fa-calendar-check"></i> Check-in
                            </span>
                            <span class="detalhe-value">{{ $reserva->data_entrada->format('d/m/Y') }}</span>
                        </div>

                        <div class="detalhe-item">
                            <span class="detalhe-label">
                                <i class="fas fa-calendar-times"></i> Check-out
                            </span>
                            <span class="detalhe-value">{{ $reserva->data_saida->format('d/m/Y') }}</span>
                        </div>

                        <div class="detalhe-item">
                            <span class="detalhe-label">
                                <i class="fas fa-bed"></i> Tipo de Quarto
                            </span>
                            <span class="detalhe-value">{{ ucfirst($reserva->tipo_quarto) }}</span>
                        </div>

                        <div class="detalhe-item">
                            <span class="detalhe-label">
                                <i class="fas fa-users"></i> Hóspedes
                            </span>
                            <span class="detalhe-value">{{ $reserva->hospedes }}</span>
                        </div>

                        <div class="detalhe-item">
                            <span class="detalhe-label">
                                <i class="fas fa-moon"></i> Noites
                            </span>
                            <span class="detalhe-value">{{ $reserva->calcularDias() }}</span>
                        </div>
                    </div>

                    <!-- Valor Total -->
                    <div class="valor-destaque" style="margin-top: 1.5rem;">
                        <div class="valor-label">Valor Total</div>
                        <div class="valor-amount">R$ {{ number_format($reserva->valor_total, 2, ',', '.') }}</div>
                    </div>
                </div>

                <!-- Informação Importante -->
                <div class="info-importante">
                    <div class="info-importante-title">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Importante - Confirme sua Reserva</span>
                    </div>
                    <p class="info-importante-text">
                        Para garantir sua hospedagem, você precisa confirmar a reserva através do link enviado
                        para seu email ou usando o código acima. <strong>Você tem até 24 horas para confirmar!</strong>
                    </p>
                </div>

                <!-- Botões de Ação -->
                <div class="action-buttons">
                    <a href="{{ route('reservas.minhas') }}" class="action-btn btn-primary-action">
                        <i class="fas fa-list"></i>
                        <span>Minhas Reservas</span>
                    </a>
                    <a href="{{ route('hoteis.alternative') }}" class="action-btn btn-secondary-action">
                        <i class="fas fa-hotel"></i>
                        <span>Explorar Mais Hotéis</span>
                    </a>
                </div>

                <!-- Timeline dos Próximos Passos -->
                <div class="timeline">
                    <div class="timeline-title">Próximos Passos</div>
                    <div class="timeline-steps">
                        <div class="timeline-step">
                            <div class="step-icon">✅</div>
                            <div class="step-text">Reserva<br>Criada</div>
                        </div>
                        <div class="timeline-step">
                            <div class="step-icon" style="border-color: #f59e0b; color: #f59e0b;">📧</div>
                            <div class="step-text">Confirmar<br>Email</div>
                        </div>
                        <div class="timeline-step">
                            <div class="step-icon" style="border-color: #cbd5e0; color: #cbd5e0;">🎫</div>
                            <div class="step-text">Reserva<br>Confirmada</div>
                        </div>
                        <div class="timeline-step">
                            <div class="step-icon" style="border-color: #cbd5e0; color: #cbd5e0;">🏨</div>
                            <div class="step-text">Check-in<br>no Hotel</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copiarCodigo() {
    const codigo = document.getElementById('codigoConfirmacao').textContent;

    // Criar elemento temporário
    const temp = document.createElement('textarea');
    temp.value = codigo;
    document.body.appendChild(temp);
    temp.select();
    document.execCommand('copy');
    document.body.removeChild(temp);

    // Feedback visual
    const btn = event.target.closest('.btn-copy');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-check"></i> Copiado!';
    btn.style.background = '#10b981';

    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.style.background = '#f59e0b';
    }, 2000);
}

// Animação de confetti
function createConfetti() {
    const colors = ['#667eea', '#764ba2', '#10b981', '#f59e0b', '#ef4444'];
    for (let i = 0; i < 50; i++) {
        setTimeout(() => {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.animationDelay = Math.random() * 2 + 's';
            confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
            document.querySelector('.sucesso-wrapper').appendChild(confetti);

            setTimeout(() => confetti.remove(), 5000);
        }, i * 50);
    }
}

// Iniciar confetti ao carregar
window.addEventListener('load', createConfetti);
</script>
@endsection
