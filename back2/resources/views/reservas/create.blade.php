@extends('layouts.app')

@section('title', 'Fazer Reserva')

@section('styles')
<style>
    :root {
        --primary-color: #2d5016;
        --primary-light: #5a8f3d;
        --accent-color: #a7d096;
        --primary-bg: #f3f7f3;
        --border-color: #e5f2e5;
        --text-dark: #1a1a1a;
        --text-medium: #4a4a4a; 
        --text-light: #ffffff;
        --shadow-soft: 0 2px 15px rgba(45, 80, 22, 0.08);
        --shadow-medium: 0 8px 30px rgba(45, 80, 22, 0.12);
        --shadow-strong: 0 15px 40px rgba(45, 80, 22, 0.18);
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        --border-radius: 16px;
        --border-radius-small: 8px;
    }

    .booking-wrapper {
        min-height: 100vh;
        padding: 4.5rem 1rem 1.5rem 1rem; /* Espaço ajustado para header e footer */
        background: var(--primary-bg);
        font-family: 'Inter', sans-serif;
        box-sizing: border-box;
    }

    .booking-container {
        max-width: 960px;
        margin: 0 auto;
    }

    .hotel-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-medium);
        border: 1px solid var(--border-color);
    }

    .hotel-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .hotel-icon {
        width: 64px;
        height: 64px;
        background: var(--primary-color);
        border-radius: var(--border-radius-small);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--text-light);
    }

    .hotel-info h2 {
        font-family: 'GaramondBold', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .hotel-meta {
        display: flex;
        gap: 1rem;
        color: var(--text-medium);
        font-size: 0.875rem;
    }

    .hotel-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--shadow-medium);
        border: 1px solid var(--border-color);
    }

    .section-title {
        font-family: 'GaramondBold', serif;
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .date-inputs {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }

    .input-group {
        margin-bottom: 1rem;
    }

    .input-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-medium);
        margin-bottom: 0.5rem;
        display: block;
    }

    .input-field {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        background: rgba(255, 255, 255, 0.5);
        color: var(--text-dark);
        transition: var(--transition-smooth);
    }

    .input-field:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.2);
    }

    .room-types {
        display: grid;
        gap: 1rem;
    }

    .room-card {
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-small);
        padding: 1rem;
        cursor: pointer;
        transition: var(--transition-smooth);
        background: rgba(255, 255, 255, 0.5);
    }

    .room-card:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-soft);
        transform: translateY(-2px);
    }

    .room-card.selected {
        border-color: var(--primary-color);
        background: rgba(167, 208, 150, 0.2);
    }

    .room-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .room-title {
        font-family: 'GaramondBold', serif;
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .room-description {
        color: var(--text-medium);
        font-size: 0.875rem;
    }

    .price-badge {
        padding: 0.5rem 1rem;
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        font-weight: 600;
    }

    .badge-standard {
        background: var(--primary-light);
        color: var(--text-light);
    }

    .badge-premium {
        background: var(--accent-color);
        color: var(--text-dark);
    }

    .badge-family {
        background: rgba(167, 208, 150, 0.3);
        color: var(--text-dark);
    }

    .price-summary {
        background: rgba(255, 255, 255, 0.5);
        border-radius: var(--border-radius-small);
        padding: 1.5rem;
        margin-top: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .price-header {
        text-align: center;
        margin-bottom: 1rem;
    }

    .price-label {
        font-size: 0.875rem;
        color: var(--text-medium);
    }

    .price-value {
        font-family: 'GaramondBold', serif;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .price-breakdown {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .breakdown-item {
        text-align: center;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.7);
        border-radius: var(--border-radius-small);
        flex: 1;
        min-width: 100px;
    }

    .breakdown-label {
        font-size: 0.875rem;
        color: var(--text-medium);
    }

    .breakdown-value {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .action-buttons {
        display: grid;
        grid-template-columns: 3fr 1fr;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .btn {
        padding: 0.75rem;
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        font-weight: 600;
        text-align: center;
        transition: var(--transition-smooth);
    }

    .btn-reserve {
        background: var(--primary-color);
        color: var(--text-light);
        border: none;
    }

    .btn-reserve:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }

    .btn-back {
        background: transparent;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
    }

    .btn-back:hover {
        background: rgba(167, 208, 150, 0.1);
        color: var(--primary-light);
        transform: translateY(-2px);
    }

    .alert {
        background: rgba(244, 67, 54, 0.2);
        color: #f44336;
        padding: 1rem;
        border-radius: var(--border-radius-small);
        margin-bottom: 1rem;
    }

    @media (max-width: 600px) {
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
<div class="booking-wrapper">
    <div class="booking-container">
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
                            <i class="fas fa-star" style="color: var(--primary-color);"></i>
                            <span>{{ $hotel->avaliacao }} ({{ number_format($hotel->avaliacoes) }})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-card">
            <h4 class="section-title">
                <i class="fas fa-edit"></i> Complete sua Reserva
            </h4>

            @if($errors->any())
                <div class="alert">
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

                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-calendar-alt"></i> Período da Estadia
                    </h4>
                    <div class="date-inputs">
                        <div class="input-group">
                            <label class="input-label"><i class="fas fa-sign-in-alt"></i> Check-in *</label>
                            <input type="date" name="data_entrada" class="input-field" value="{{ old('data_entrada') }}" min="{{ date('Y-m-d') }}" required id="checkIn">
                        </div>
                        <div class="input-group">
                            <label class="input-label"><i class="fas fa-sign-out-alt"></i> Check-out *</label>
                            <input type="date" name="data_saida" class="input-field" value="{{ old('data_saida') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required id="checkOut">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-bed"></i> Escolha seu Quarto
                    </h4>
                    <input type="hidden" name="tipo_quarto" id="tipoQuartoInput" value="{{ old('tipo_quarto', 'standard') }}">

                    <div class="room-types">
                        <div class="room-card {{ old('tipo_quarto', 'standard') == 'standard' ? 'selected' : '' }}" data-tipo="standard" data-ajuste="0">
                            <div class="room-content">
                                <div class="room-details">
                                    <div class="room-title">🛏️ Standard</div>
                                    <p class="room-description">Quarto confortável com amenidades básicas</p>
                                </div>
                                <div class="room-price">
                                    <span class="price-badge badge-standard">Preço Base</span>
                                </div>
                            </div>
                        </div>
                        <div class="room-card {{ old('tipo_quarto') == 'luxo' ? 'selected' : '' }}" data-tipo="luxo" data-ajuste="150">
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
                        <div class="room-card {{ old('tipo_quarto') == 'familiar' ? 'selected' : '' }}" data-tipo="familiar" data-ajuste="250">
                            <div class="room-content">
                                <div class="room-details">
                                    <div class="room-title">👨‍👩‍👧‍👦 Familiar</div>
                                    <p class="room-description">Espaço amplo ideal para famílias</p>
                                </div>
                                <div class="room-price">
                                    <span class="price-badge badge-family">+R$ 250/noite</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-info-circle"></i> Informações Adicionais
                    </h4>
                    <div class="input-group">
                        <label class="input-label"><i class="fas fa-users"></i> Número de Hóspedes *</label>
                        <input type="number" name="hospedes" class="input-field" value="{{ old('hospedes', 1) }}" min="1" max="10" required>
                    </div>
                    <div class="input-group">
                        <label class="input-label"><i class="fas fa-comment"></i> Observações</label>
                        <textarea name="observacoes" class="input-field" rows="3" placeholder="Alguma preferência especial?" style="resize: vertical;">{{ old('observacoes') }}</textarea>
                    </div>
                </div>

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

                <div class="action-buttons">
                    <button type="submit" class="btn btn-reserve">
                        <i class="fas fa-check-circle"></i> Confirmar Reserva
                    </button>
                    <a href="{{ route('hoteis.show', $hotel->id) }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const precoBase = {{ $hotel->preco ?? 0 }};
    let ajusteQuarto = 0;

    // Debounce function to optimize event handling
    const debounce = (fn, delay) => {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => fn(...args), delay);
        };
    };

    // Format currency
    const formatCurrency = (value) => {
        return `R$ ${value.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`;
    };

    // Calculate total price
    const calculatePrice = () => {
        const checkIn = document.getElementById('checkIn').value;
        const checkOut = document.getElementById('checkOut').value;
        const hospedes = document.querySelector('input[name="hospedes"]').value;

        if (checkIn && checkOut) {
            const dataEntrada = new Date(checkIn);
            const dataSaida = new Date(checkOut);
            const diffTime = Math.abs(dataSaida - dataEntrada);
            const noites = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (noites > 0) {
                const precoPorNoite = precoBase + ajusteQuarto;
                const total = precoPorNoite * noites;

                document.getElementById('numNoites').textContent = noites;
                document.getElementById('precoPorNoite').textContent = formatCurrency(precoPorNoite);
                document.getElementById('valorTotal').textContent = formatCurrency(total);
                document.getElementById('numHospedes').textContent = hospedes;
            }
        }
    };

    // Room selection
    document.querySelectorAll('.room-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('.room-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            document.getElementById('tipoQuartoInput').value = card.dataset.tipo;
            ajusteQuarto = parseFloat(card.dataset.ajuste);
            calculatePrice();
        });
    });

    // Input event listeners
    const debouncedCalculate = debounce(calculatePrice, 300);
    document.getElementById('checkIn').addEventListener('change', () => {
        const minCheckOut = new Date(document.getElementById('checkIn').value);
        minCheckOut.setDate(minCheckOut.getDate() + 1);
        document.getElementById('checkOut').min = minCheckOut.toISOString().split('T')[0];
        debouncedCalculate();
    });
    document.getElementById('checkOut').addEventListener('change', debouncedCalculate);
    document.querySelector('input[name="hospedes"]').addEventListener('input', debouncedCalculate);

    // Initial calculation
    calculatePrice();
</script>
@endsection
