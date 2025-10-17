<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ReservaConfirmacao;

class ReservaController extends Controller
{
    /**
     * Exibe o formulário de reserva
     */
    public function create(Request $request, $id = null)
    {
        // Se vier com parâmetro 'tipo', identifica o tipo de reserva
        $tipo = $request->query('tipo', 'hotel');

        if ($tipo === 'hotel' || !$request->has('tipo')) {
            // Reserva de hotel (comportamento padrão)
            $hotel_id = $id ?? $request->query('id');

            // Busca o hotel do array hardcoded no HotelController
            $hotelController = new HotelController();
            $hotelData = $hotelController->getHotelById($hotel_id);

            if (!$hotelData) {
                abort(404, 'Hotel não encontrado');
            }

            // Converte para objeto
            $hotel = (object) $hotelData;

            return view('reservas.create', compact('hotel'));
        }

        // Para restaurantes e pontos turísticos, redireciona para hotéis por enquanto
        // (você pode criar views específicas depois)
        return redirect()->route('hoteis.alternative')
            ->with('info', 'Sistema de reservas disponível apenas para hotéis no momento.');
    }

    /**
     * Armazena uma nova reserva
     */
    public function store(Request $request)
    {
        // Validação robusta com mensagens personalizadas
        $validated = $request->validate([
            'hotel_id' => 'required|integer|min:1',
            'data_entrada' => 'required|date|after_or_equal:today',
            'data_saida' => 'required|date|after:data_entrada',
            'tipo_quarto' => 'required|string|in:standard,luxo,familiar',
            'hospedes' => 'required|integer|min:1|max:10',
            'observacoes' => 'nullable|string|max:500'
        ], [
            'hotel_id.required' => 'Por favor, selecione um hotel.',
            'hotel_id.integer' => 'ID do hotel inválido.',
            'data_entrada.required' => 'A data de entrada é obrigatória.',
            'data_entrada.after_or_equal' => 'A data de entrada deve ser hoje ou futura.',
            'data_saida.required' => 'A data de saída é obrigatória.',
            'data_saida.after' => 'A data de saída deve ser posterior à data de entrada.',
            'tipo_quarto.required' => 'Selecione o tipo de quarto.',
            'tipo_quarto.in' => 'Tipo de quarto inválido.',
            'hospedes.required' => 'Informe o número de hóspedes.',
            'hospedes.min' => 'Deve haver pelo menos 1 hóspede.',
            'hospedes.max' => 'Máximo de 10 hóspedes por reserva.',
            'observacoes.max' => 'As observações não podem exceder 500 caracteres.'
        ]);

        try {
            // Buscar hotel do array hardcoded
            $hotelController = new HotelController();
            $hotelData = $hotelController->getHotelById($request->hotel_id);

            if (!$hotelData) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Hotel não encontrado. Por favor, selecione um hotel válido.');
            }

            // Calcular número de dias
            $dias = \Carbon\Carbon::parse($request->data_entrada)->diffInDays($request->data_saida);

            // Validação adicional: mínimo 1 dia
            if ($dias < 1) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'A reserva deve ter pelo menos 1 dia de duração.');
            }

            // Validação adicional: máximo 30 dias
            if ($dias > 30) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'A reserva não pode exceder 30 dias. Para estadias mais longas, entre em contato conosco.');
            }

            // Preços por tipo de quarto (baseado no preço do array)
            $precoBase = $hotelData['preco'];
            $precos = [
                'standard' => $precoBase,
                'luxo' => $precoBase + 150,
                'familiar' => $precoBase + 250
            ];

            $valor_total = $precos[$request->tipo_quarto] * $dias;

            // Criar reserva
            $reserva = Reserva::create([
                'user_id' => Auth::id(),
                'hotel_id' => $request->hotel_id,
                'data_entrada' => $request->data_entrada,
                'data_saida' => $request->data_saida,
                'tipo_quarto' => $request->tipo_quarto,
                'hospedes' => $request->hospedes,
                'valor_total' => $valor_total,
                'observacoes' => $request->observacoes,
                'status' => 'pendente'
            ]);

            // Enviar email de confirmação
            $emailEnviado = false;
            if (Auth::check() && Auth::user()->email) {
                try {
                    Mail::to(Auth::user()->email)->send(new ReservaConfirmacao($reserva));
                    $emailEnviado = true;
                    \Log::info('Email de confirmação enviado com sucesso', [
                        'reserva_id' => $reserva->id,
                        'email' => Auth::user()->email
                    ]);
                } catch (\Exception $e) {
                    // Log do erro mas não quebra o fluxo
                    \Log::error('Erro ao enviar email de confirmação', [
                        'reserva_id' => $reserva->id,
                        'email' => Auth::user()->email,
                        'erro' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                }
            }

            $mensagem = 'Reserva realizada com sucesso!';
            if ($emailEnviado) {
                $mensagem .= ' Verifique seu email para confirmar.';
            } else {
                $mensagem .= ' Você pode confirmar através do link nas suas reservas.';
            }

            return redirect()->route('reservas.sucesso', $reserva->id)
                ->with('success', $mensagem);

        } catch (\Exception $e) {
            \Log::error('Erro ao criar reserva', [
                'erro' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ocorreu um erro ao processar sua reserva. Por favor, tente novamente ou entre em contato conosco.');
        }
    }

    /**
     * Página de sucesso após reserva
     */
    public function sucesso($id)
    {
        $reserva = Reserva::with(['usuario'])->findOrFail($id);

        // Verificar se o usuário tem permissão para ver essa reserva
        if (Auth::id() !== $reserva->user_id) {
            abort(403);
        }

        // Buscar dados do hotel do array
        $reserva->hotel = $reserva->getHotelData();

        return view('reservas.sucesso', compact('reserva'));
    }

    /**
     * Confirma a reserva via código
     */
    public function confirmar($codigo)
    {
        $reserva = Reserva::where('codigo_confirmacao', $codigo)->firstOrFail();

        if ($reserva->status === 'confirmada') {
            return redirect()->route('home')->with('info', 'Esta reserva já foi confirmada anteriormente.');
        }

        $reserva->confirmar();

        // Buscar dados do hotel do array
        $reserva->hotel = $reserva->getHotelData();

        return view('reservas.confirmada', compact('reserva'))
            ->with('success', 'Reserva confirmada com sucesso!');
    }

    /**
     * Lista as reservas do usuário
     */
    public function minhasReservas()
    {
        $reservas = Reserva::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Adicionar dados do hotel para cada reserva
        foreach ($reservas as $reserva) {
            $reserva->hotel = $reserva->getHotelData();
        }

        return view('reservas.minhas', compact('reservas'));
    }

    /**
     * Cancela uma reserva
     */
    public function cancelar($id)
    {
        $reserva = Reserva::findOrFail($id);

        // Verificar permissão
        if (Auth::id() !== $reserva->user_id) {
            abort(403);
        }

        // Verificar se pode cancelar (ex: não pode cancelar se faltam menos de 48h)
        $diasParaEntrada = now()->diffInDays($reserva->data_entrada, false);

        if ($diasParaEntrada < 2) {
            return back()->with('error', 'Não é possível cancelar com menos de 48h de antecedência.');
        }

        $reserva->cancelar();

        return redirect()->route('reservas.minhas')
            ->with('success', 'Reserva cancelada com sucesso.');
    }
}
