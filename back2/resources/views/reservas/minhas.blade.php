@extends('layouts.app')

@section('title', 'Minhas Reservas')

@section('content')
<div class="container my-5">
    <h1 class="mb-4" style="font-family: 'Garamond', serif; color: #2c3e50;">
        <i class="fas fa-calendar-check"></i> Minhas Reservas
    </h1>

    @if($reservas->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Você ainda não possui reservas.
            <a href="{{ route('hoteis.index') }}" class="alert-link">Explore nossos hotéis!</a>
        </div>
    @else
        <!-- Filtros -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('reservas.minhas') }}" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Status:</label>
                        <select name="status" class="form-select">
                            <option value="">Todos</option>
                            <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="confirmada" {{ request('status') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                            <option value="cancelada" {{ request('status') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            <option value="concluida" {{ request('status') == 'concluida' ? 'selected' : '' }}>Concluída</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                        <a href="{{ route('reservas.minhas') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpar
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista de Reservas -->
        <div class="row">
            @foreach($reservas as $reserva)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-{{
                            $reserva->status == 'confirmada' ? 'success' :
                            ($reserva->status == 'pendente' ? 'warning' :
                            ($reserva->status == 'cancelada' ? 'danger' : 'secondary'))
                        }} text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>
                                    @if($reserva->status == 'pendente')
                                        ⏳ Aguardando Confirmação
                                    @elseif($reserva->status == 'confirmada')
                                        ✅ Confirmada
                                    @elseif($reserva->status == 'cancelada')
                                        ❌ Cancelada
                                    @else
                                        ✔️ Concluída
                                    @endif
                                </span>
                                <span class="badge bg-light text-dark">
                                    Cód: {{ $reserva->codigo_confirmacao }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $reserva->hotel->nome_hotel }}</h5>
                            <p class="card-text text-muted mb-3">
                                <i class="fas fa-map-marker-alt"></i> {{ $reserva->hotel->cidade_hotel }}, {{ $reserva->hotel->estado_hotel }}
                            </p>

                            <div class="reserva-info">
                                <div class="mb-2">
                                    <strong><i class="fas fa-calendar-check"></i> Check-in:</strong>
                                    {{ $reserva->data_entrada->format('d/m/Y') }}
                                </div>
                                <div class="mb-2">
                                    <strong><i class="fas fa-calendar-times"></i> Check-out:</strong>
                                    {{ $reserva->data_saida->format('d/m/Y') }}
                                </div>
                                <div class="mb-2">
                                    <strong><i class="fas fa-bed"></i> Tipo de Quarto:</strong>
                                    {{ ucfirst($reserva->tipo_quarto) }}
                                </div>
                                <div class="mb-2">
                                    <strong><i class="fas fa-users"></i> Hóspedes:</strong>
                                    {{ $reserva->hospedes }}
                                </div>
                                <div class="mb-2">
                                    <strong><i class="fas fa-moon"></i> Noites:</strong>
                                    {{ $reserva->calcularDias() }}
                                </div>
                                <div class="mb-3">
                                    <strong><i class="fas fa-money-bill-wave"></i> Valor Total:</strong>
                                    <span class="text-success fs-5">R$ {{ number_format($reserva->valor_total, 2, ',', '.') }}</span>
                                </div>
                            </div>

                            @if($reserva->observacoes)
                                <div class="alert alert-light mb-3">
                                    <small><strong>Observações:</strong> {{ $reserva->observacoes }}</small>
                                </div>
                            @endif

                            <!-- Ações -->
                            <div class="d-flex gap-2 flex-wrap">
                                @if($reserva->status == 'pendente')
                                    <a href="{{ route('reservas.confirmar', $reserva->codigo_confirmacao) }}"
                                       class="btn btn-success btn-sm flex-fill">
                                        <i class="fas fa-check"></i> Confirmar
                                    </a>
                                @endif

                                @if($reserva->status == 'pendente' || $reserva->status == 'confirmada')
                                    @php
                                        $diasAteCheckIn = now()->diffInDays($reserva->data_entrada, false);
                                    @endphp
                                    @if($diasAteCheckIn > 2)
                                        <form method="POST"
                                              action="{{ route('reservas.cancelar', $reserva->id) }}"
                                              class="flex-fill"
                                              onsubmit="return confirm('Tem certeza que deseja cancelar esta reserva?');">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                                <i class="fas fa-times"></i> Cancelar Reserva
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm flex-fill" disabled
                                                title="Cancelamento disponível apenas 48h antes do check-in">
                                            <i class="fas fa-ban"></i> Cancelamento indisponível
                                        </button>
                                    @endif
                                @endif

                                <a href="{{ route('hoteis.show', $reserva->hotel->id_hotel) }}"
                                   class="btn btn-outline-primary btn-sm flex-fill">
                                    <i class="fas fa-hotel"></i> Ver Hotel
                                </a>
                            </div>

                            @if($reserva->confirmada_em)
                                <small class="text-muted d-block mt-2">
                                    Confirmada em: {{ $reserva->confirmada_em->format('d/m/Y H:i') }}
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginação -->
        <div class="d-flex justify-content-center mt-4">
            {{ $reservas->links() }}
        </div>
    @endif

    <!-- Botão de Nova Reserva -->
    <div class="text-center mt-4">
        <a href="{{ route('hoteis.index') }}" class="btn btn-lg btn-primary">
            <i class="fas fa-plus-circle"></i> Fazer Nova Reserva
        </a>
    </div>
</div>
@endsection
