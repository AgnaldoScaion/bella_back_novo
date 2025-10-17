@extends('layouts.app')

@section('title', 'Fazer Reserva')

@section('styles')
<style>
    .reserva-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 3rem 0;
    }

    .reserva-content {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .hotel-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,255,255,0.2);
    }

    .hotel-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .hotel-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        flex-shrink: 0;
    }

    .hotel-info h2 {
        font-family: 'Garamond', serif;
        color: #2c3e50;
        margin: 0 0 0.5rem 0;
        font-size: 1.8rem;
    }

    .hotel-meta {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        color: #666;
    }

    .hotel-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-family: 'Garamond', serif;
        color: #2c3e50;
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title::before {
        content: '';
        width: 4px;
        height: 24px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 2px;
    }

    .date-inputs {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .input-group {
        position: relative;
    }

    .input-label {
        display: block;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .input-field {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .input-field:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .room-types {
        display: grid;
        gap: 1rem;
    }

    .room-card {
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.25rem;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #f8fafc;
        position: relative;
        overflow: hidden;
    }

    .room-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .room-card:hover {
        border-color: #667eea;
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    }

    .room-card.selected {
        border-color: #667eea;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }

    .room-card.selected::before {
        transform: scaleY(1);
    }

    .room-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .room-details {
        flex: 1;
    }

    .room-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.25rem;
    }

    .room-description {
        color: #718096;
        font-size: 0.9rem;
        margin: 0;
    }

    .room-price {
        text-align: right;
    }

    .price-badge {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        white-space: nowrap;
    }

    .badge-base {
        background: #d4edda;
        color: #155724;
    }

    .badge-premium {
        background: #fff3cd;
        color: #856404;
    }

    .badge-luxury {
        background: #cce5ff;
        color: #004085;
    }

    .price-summary {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-top: 2rem;
        border: 2px dashed #cbd5e0;
    }

    .price-header {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .price-label {
        color: #4a5568;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .price-value {
        font-size: 2.5rem;
        font-weight: bold;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .price-breakdown {
        display: flex;
        justify-content: space-around;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .breakdown-item {
        text-align: center;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        flex: 1;
        min-width: 120px;
    }

    .breakdown-label {
        font-size: 0.85rem;
        color: #718096;
        margin-bottom: 0.25rem;
    }

    .breakdown-value {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: 3fr 1fr;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-reserve {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-reserve:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);
    }

    .btn-back {
        background: white;
        color: #4a5568;
        border: 2px solid #e2e8f0;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-back:hover {
        background: #f8fafc;
        border-color: #cbd5e0;
    }

    .alert {
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .hotel-header {
            flex-direction: column;
            text-align: center;
        }

        .action-buttons {
            grid-template-columns: 1fr;
        }

        .room-content {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="reserva-container">
    <div class="reserva-content">
        <!-- Card do Hotel -->
        <div class="hotel-card">
            <div class="hotel-header">
                <div class="hotel-icon">🏨</div>
                <div class="hotel-info">
                    <h2>{{ $hotel->nome }}</h2>
                    <div class="hotel-meta">
                        <div class="hotel-meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $hotel->localizacao }}</span>
                        </div>
                        <div class="hotel-meta-item">
                            <i class="fas fa-star" style="color: #ffc107;"></i>
                            <span>{{ $hotel->avaliacao }} ({{ number_format($hotel->avaliacoes) }})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulário -->
        <div class="form-card">
            <div class="section-title">
                <i class="fas fa-edit"></i>
                <span>Complete sua Reserva</span>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>⚠️ Atenção:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('reservas.store') }}" id="reservaForm">
                @csrf
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

                <!-- Datas -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Período da Estadia</span>
                    </h4>
                    <div class="date-inputs">
                        <div class="input-group">
                            <label class="input-label">
                                <i class="fas fa-sign-in-alt"></i> Check-in *
                            </label>
                            <input type="date"
                                   name="data_entrada"
                                   class="input-field"
                                   value="{{ old('data_entrada') }}"
                                   min="{{ date('Y-m-d') }}"
                                   required
                                   id="checkIn">
                        </div>
                        <div class="input-group">
                            <label class="input-label">
                                <i class="fas fa-sign-out-alt"></i> Check-out *
                            </label>
                            <input type="date"
                                   name="data_saida"
                                   class="input-field"
                                   value="{{ old('data_saida') }}"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   required
                                   id="checkOut">
                        </div>
                    </div>
                </div>

                <!-- Tipo de Quarto -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-bed"></i>
                        <span>Escolha seu Quarto</span>
                    </h4>
                    <input type="hidden" name="tipo_quarto" id="tipoQuartoInput" value="{{ old('tipo_quarto', 'standard') }}">

                    <div class="room-types">
                        <div class="room-card {{ old('tipo_quarto', 'standard') == 'standard' ? 'selected' : '' }}"
                             data-tipo="standard" data-ajuste="0">
                            <div class="room-content">
                                <div class="room-details">
                                    <div class="room-title">🛏️ Standard</div>
                                    <p class="room-description">Quarto confortável com amenidades básicas</p>
                                </div>
                                <div class="room-price">
                                    <span class="price-badge badge-base">Preço Base</span>
                                </div>
                            </div>
                        </div>

                        <div class="room-card {{ old('tipo_quarto') == 'luxo' ? 'selected' : '' }}"
                             data-tipo="luxo" data-ajuste="150">
                            <div class="room-content">
                                <div class="room-details">
                                    <div class="room-title">✨ Luxo</div>
                                    <p class="room-description">Quarto premium com vista privilegiada</p>
                                </div>
                                <div class="room-price">
                                    <span class="price-badge badge-premium">+R$ 150/noite</span>
                                </div>
                            </div>
                        </div>

                        <div class="room-card {{ old('tipo_quarto') == 'familiar' ? 'selected' : '' }}"
                             data-tipo="familiar" data-ajuste="250">
                            <div class="room-content">
                                <div class="room-details">
                                    <div class="room-title">👨‍👩‍👧‍👦 Familiar</div>
                                    <p class="room-description">Espaço amplo ideal para famílias</p>
                                </div>
                                <div class="room-price">
                                    <span class="price-badge badge-luxury">+R$ 250/noite</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hóspedes e Observações -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        <span>Informações Adicionais</span>
                    </h4>

                    <div class="input-group" style="margin-bottom: 1rem;">
                        <label class="input-label">
                            <i class="fas fa-users"></i> Número de Hóspedes *
                        </label>
                        <input type="number"
                               name="hospedes"
                               class="input-field"
                               value="{{ old('hospedes', 1) }}"
                               min="1"
                               max="10"
                               required>
                    </div>

                    <div class="input-group">
                        <label class="input-label">
                            <i class="fas fa-comment"></i> Observações
                        </label>
                        <textarea name="observacoes"
                                  class="input-field"
                                  rows="3"
                                  placeholder="Alguma preferência especial? Necessidades alimentares? Deixe-nos saber!"
                                  style="resize: vertical;">{{ old('observacoes') }}</textarea>
                    </div>
                </div>

                <!-- Resumo do Preço -->
                <div class="price-summary">
                    <div class="price-header">
                        <div class="price-label">Valor Total Estimado</div>
                        <div class="price-value" id="valorTotal">R$ {{ number_format($hotel->preco ?? 0, 2, ',', '.') }}</div>
                    </div>
                    <div class="price-breakdown">
                        <div class="breakdown-item">
                            <div class="breakdown-label">Noites</div>
                            <div class="breakdown-value" id="numNoites">1</div>
                        </div>
                        <div class="breakdown-item">
                            <div class="breakdown-label">Por Noite</div>
                            <div class="breakdown-value" id="precoPorNoite">R$ {{ number_format($hotel->preco ?? 0, 2, ',', '.') }}</div>
                        </div>
                        <div class="breakdown-item">
                            <div class="breakdown-label">Hóspedes</div>
                            <div class="breakdown-value" id="numHospedes">1</div>
                        </div>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="action-buttons">
                    <button type="submit" class="btn-reserve">
                        <i class="fas fa-check-circle"></i>
                        <span>Confirmar Reserva</span>
                    </button>
                    <a href="{{ route('hoteis.show', $hotel->id) }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    const precoBase = {{ $hotel->preco ?? 0 }};
    let ajusteQuarto = 0;

    // Seleção de tipo de quarto
    document.querySelectorAll('.room-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.room-card').forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            document.getElementById('tipoQuartoInput').value = this.dataset.tipo;
            ajusteQuarto = parseFloat(this.dataset.ajuste);
            calcularPreco();
        });
    });

    // Calcular preço total
    function calcularPreco() {
        const checkIn = document.getElementById('checkIn').value;
        const checkOut = document.getElementById('checkOut').value;

        if (checkIn && checkOut) {
            const dataEntrada = new Date(checkIn);
            const dataSaida = new Date(checkOut);
            const diffTime = Math.abs(dataSaida - dataEntrada);
            const noites = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (noites > 0) {
                const precoPorNoite = precoBase + ajusteQuarto;
                const total = precoPorNoite * noites;

                document.getElementById('numNoites').textContent = noites;
                document.getElementById('precoPorNoite').textContent =
                    'R$ ' + precoPorNoite.toFixed(2).replace('.', ',');
                document.getElementById('valorTotal').textContent =
                    'R$ ' + total.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        }
    }

    // Atualizar número de hóspedes
    document.querySelector('input[name="hospedes"]').addEventListener('input', function() {
        document.getElementById('numHospedes').textContent = this.value;
    });

    // Listeners para mudanças nas datas
    document.getElementById('checkIn').addEventListener('change', function() {
        const minCheckOut = new Date(this.value);
        minCheckOut.setDate(minCheckOut.getDate() + 1);
        document.getElementById('checkOut').min = minCheckOut.toISOString().split('T')[0];
        calcularPreco();
    });

    document.getElementById('checkOut').addEventListener('change', calcularPreco);

    // Calcular preço inicial
    calcularPreco();
</script>
@endsection
@endsection
