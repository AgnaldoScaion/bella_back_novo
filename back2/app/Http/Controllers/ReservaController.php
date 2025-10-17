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
            $hotel = Hotel::findOrFail($hotel_id);
            return view('reservas.create', compact('hotel'));
        }

        // Para restaurantes e pontos turísticos, redireciona para hotéis por enquanto
        // (você pode criar views específicas depois)
        return redirect()->route('hoteis.index')
            ->with('info', 'Sistema de reservas disponível apenas para hotéis no momento.');
    }

    /**
     * Armazena uma nova reserva
     */
    public function store(Request $request)
    {
        // Validação
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotel,id_hotel',
            'data_entrada' => 'required|date|after_or_equal:today',
            'data_saida' => 'required|date|after:data_entrada',
            'tipo_quarto' => 'required|string|in:standard,luxo,familiar',
            'hospedes' => 'required|integer|min:1|max:10',
            'observacoes' => 'nullable|string|max:500'
        ]);

        // Calcular valor total
        $hotel = Hotel::findOrFail($request->hotel_id);
        $dias = \Carbon\Carbon::parse($request->data_entrada)->diffInDays($request->data_saida);

        // Preços por tipo de quarto
        $precos = [
            'standard' => $hotel->preco,
            'luxo' => $hotel->preco + 150,
            'familiar' => $hotel->preco + 250
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
        if (Auth::check() && Auth::user()->email) {
            try {
                Mail::to(Auth::user()->email)->send(new ReservaConfirmacao($reserva));
            } catch (\Exception $e) {
                // Log do erro mas não quebra o fluxo
                \Log::error('Erro ao enviar email: ' . $e->getMessage());
            }
        }

        return redirect()->route('reservas.sucesso', $reserva->id)
            ->with('success', 'Reserva realizada com sucesso! Verifique seu email para confirmar.');
    }

    /**
     * Página de sucesso após reserva
     */
    public function sucesso($id)
    {
        $reserva = Reserva::with(['hotel', 'usuario'])->findOrFail($id);

        // Verificar se o usuário tem permissão para ver essa reserva
        if (Auth::id() !== $reserva->user_id) {
            abort(403);
        }

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

        return view('reservas.confirmada', compact('reserva'))
            ->with('success', 'Reserva confirmada com sucesso!');
    }

    /**
     * Lista as reservas do usuário
     */
    public function minhasReservas()
    {
        $reservas = Reserva::with('hotel')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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
