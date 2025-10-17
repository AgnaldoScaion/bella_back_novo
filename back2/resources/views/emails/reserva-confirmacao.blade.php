<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f3f7f3;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #A7D096;
            padding: 30px;
            text-align: center;
        }
        .header img {
            height: 80px;
        }
        .content {
            padding: 30px;
        }
        .title {
            color: #5a8f3d;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .info-box {
            background-color: #f9f9f9;
            border-left: 4px solid #5a8f3d;
            padding: 15px;
            margin: 15px 0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #666;
        }
        .value {
            color: #333;
        }
        .confirm-button {
            display: inline-block;
            background-color: #5a8f3d;
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
        }
        .confirm-button:hover {
            background-color: #4a7d2d;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .code {
            background-color: #fff3cd;
            border: 2px dashed #856404;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 3px;
            margin: 15px 0;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://i.ibb.co/Q7T008b1/image.png" alt="Bella Avventura">
        </div>

        <div class="content">
            <h1 class="title">🎉 Reserva Realizada com Sucesso!</h1>

            <p>Olá, <strong>{{ $reserva->usuario->nome_completo ?? 'Viajante' }}</strong>!</p>

            <p>Recebemos sua reserva e estamos muito felizes em ter você conosco! Para confirmar sua reserva, clique no botão abaixo ou use o código de confirmação.</p>

            <div class="info-box">
                <h3 style="margin-top:0; color: #5a8f3d;">📋 Detalhes da Reserva</h3>

                <div class="info-row">
                    <span class="label">Hotel:</span>
                    <span class="value">{{ $reserva->hotel->nome_hotel }}</span>
                </div>

                <div class="info-row">
                    <span class="label">Check-in:</span>
                    <span class="value">{{ $reserva->data_entrada->format('d/m/Y') }}</span>
                </div>

                <div class="info-row">
                    <span class="label">Check-out:</span>
                    <span class="value">{{ $reserva->data_saida->format('d/m/Y') }}</span>
                </div>

                <div class="info-row">
                    <span class="label">Tipo de Quarto:</span>
                    <span class="value">{{ ucfirst($reserva->tipo_quarto) }}</span>
                </div>

                <div class="info-row">
                    <span class="label">Hóspedes:</span>
                    <span class="value">{{ $reserva->hospedes }}</span>
                </div>

                <div class="info-row">
                    <span class="label">Valor Total:</span>
                    <span class="value" style="font-size: 18px; color: #5a8f3d; font-weight: bold;">R$ {{ number_format($reserva->valor_total, 2, ',', '.') }}</span>
                </div>
            </div>

            <div style="text-align: center;">
                <p style="margin: 20px 0 10px;"><strong>Código de Confirmação:</strong></p>
                <div class="code">{{ $reserva->codigo_confirmacao }}</div>

                <a href="{{ route('reservas.confirmar', $reserva->codigo_confirmacao) }}" class="confirm-button">
                    ✅ Confirmar Reserva
                </a>
            </div>

            @if($reserva->observacoes)
            <div class="info-box" style="background-color: #e7f3ff; border-left-color: #0066cc;">
                <strong>📝 Suas Observações:</strong><br>
                {{ $reserva->observacoes }}
            </div>
            @endif

            <p style="margin-top: 30px; color: #666; font-size: 14px;">
                <strong>⚠️ Importante:</strong> Confirme sua reserva em até 24 horas para garantir sua vaga. Após esse prazo, a reserva pode ser cancelada automaticamente.
            </p>
        </div>

        <div class="footer">
            <p><strong>Bella Avventura</strong></p>
            <p>📧 bella.avventura@gmail.com</p>
            <p>🌐 www.bellaavventura.com.br</p>
            <p style="margin-top: 15px; color: #999;">
                Este é um email automático, por favor não responda.
            </p>
        </div>
    </div>
</body>
</html>
