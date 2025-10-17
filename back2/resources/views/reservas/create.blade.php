@extends('layouts.app')

@section('title', 'Fazer Reserva')

@section('styles')
<style>
    .reserva-form-container {
        max-width: 800px;
        margin: 2rem auto;
    }
    .hotel-info-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .hotel-info-card h2 {
        font-family: 'Garamond', serif;
        margin-bottom: 0.5rem;
    }
    .form-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .price-display {
        background: #f8f9fa;
        border: 2px dashed #667eea;
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 1rem;
        text-align: center;
    }
    .price-display .price-label {
        color: #666;
        font-size: 1rem;
    }
    .price-display .price-value {
        color: #667eea;
        font-size: 2rem;
        font-weight: bold;
        margin-top: 0.5rem;
    }
    .room-type-card {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    .room-type-card:hover {
        border-color: #667eea;
        background: #f5f7ff;
    }
    .room-type-card.selected {
        border-color: #667eea;
        background: #f5f7ff;
        box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
    }
</style>
@endsection

@section('content')
<div class="reserva-form-container">
    <!-- Informações do Hotel -->
    <div class="hotel-info-card">
        <h2>{{ $hotel->nome_hotel }}</h2>
        <p class="mb-2">
            <i class="fas fa-map-marker-alt"></i>
            {{ $hotel->endereco_hotel }}, {{ $hotel->cidade_hotel }} - {{ $hotel->estado_hotel }}
        </p>
        <p class="mb-0">
            <i class="fas fa-star"></i>
            Classificação: {{ $hotel->classificacao_hotel ?? 'N/A' }}
        </p>
    </div>

    <!-- Formulário de Reserva -->
    <div class="form-card">
        <h3 class="mb-4" style="font-family: 'Garamond', serif; color: #2c3e50;">
            <i class="fas fa-calendar-check"></i> Complete sua Reserva
        </h3>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('reservas.store') }}" id="reservaForm">
            @csrf
            <input type="hidden" name="hotel_id" value="{{ $hotel->id_hotel }}">

            <!-- Datas -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-calendar-check"></i> Check-in *</label>
                    <input type="date"
                           name="data_entrada"
                           class="form-control"
                           value="{{ old('data_entrada') }}"
                           min="{{ date('Y-m-d') }}"
                           required
                           id="checkIn">
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-calendar-times"></i> Check-out *</label>
                    <input type="date"
                           name="data_saida"
                           class="form-control"
                           value="{{ old('data_saida') }}"
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                           required
                           id="checkOut">
                </div>
            </div>

            <!-- Tipo de Quarto -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-bed"></i> Tipo de Quarto *</label>
                <input type="hidden" name="tipo_quarto" id="tipoQuartoInput" value="{{ old('tipo_quarto', 'standard') }}">

                <div class="room-type-card {{ old('tipo_quarto', 'standard') == 'standard' ? 'selected' : '' }}"
                     data-tipo="standard" data-ajuste="0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>🛏️ Standard</strong>
                            <p class="mb-0 text-muted">Quarto confortável com amenidades básicas</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-success">Preço Base</span>
                        </div>
                    </div>
                </div>

                <div class="room-type-card {{ old('tipo_quarto') == 'luxo' ? 'selected' : '' }}"
                     data-tipo="luxo" data-ajuste="150">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>✨ Luxo</strong>
                            <p class="mb-0 text-muted">Quarto premium com vista privilegiada</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-warning">+R$ 150/noite</span>
                        </div>
                    </div>
                </div>

                <div class="room-type-card {{ old('tipo_quarto') == 'familiar' ? 'selected' : '' }}"
                     data-tipo="familiar" data-ajuste="250">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>👨‍👩‍👧‍👦 Familiar</strong>
                            <p class="mb-0 text-muted">Espaço amplo ideal para famílias</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-info">+R$ 250/noite</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hóspedes -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-users"></i> Número de Hóspedes *</label>
                <input type="number"
                       name="hospedes"
                       class="form-control"
                       value="{{ old('hospedes', 1) }}"
                       min="1"
                       max="10"
                       required>
            </div>

            <!-- Observações -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-comment"></i> Observações</label>
                <textarea name="observacoes"
                          class="form-control"
                          rows="3"
                          placeholder="Alguma preferência especial? Necessidades alimentares? Deixe-nos saber!">{{ old('observacoes') }}</textarea>
            </div>

            <!-- Display de Preço -->
            <div class="price-display">
                <div class="price-label">Valor Total Estimado:</div>
                <div class="price-value" id="valorTotal">R$ {{ number_format($hotel->preco_hotel ?? 0, 2, ',', '.') }}</div>
                <small class="text-muted" id="detalhesPreco">
                    Baseado em <span id="numNoites">1</span> noite(s)
                </small>
            </div>

            <!-- Botões -->
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary btn-lg flex-fill">
                    <i class="fas fa-check-circle"></i> Confirmar Reserva
                </button>
                <a href="{{ route('hoteis.show', $hotel->id_hotel) }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    const precoBase = {{ $hotel->preco_hotel ?? 0 }};
    let ajusteQuarto = 0;

    // Seleção de tipo de quarto
    document.querySelectorAll('.room-type-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.room-type-card').forEach(c => c.classList.remove('selected'));
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
                document.getElementById('valorTotal').textContent =
                    'R$ ' + total.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                document.getElementById('detalhesPreco').innerHTML =
                    `Baseado em <span id="numNoites">${noites}</span> noite(s) × R$ ${precoPorNoite.toFixed(2).replace('.', ',')}`;
            }
        }
    }

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
