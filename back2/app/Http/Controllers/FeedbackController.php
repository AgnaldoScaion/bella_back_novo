<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(Request $request): View
    {
        // Query base
        $query = Feedback::with('pontoTuristico')->latest();

        // Filtros
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('mensagem', 'like', '%' . $request->search . '%')
                  ->orWhereHas('pontoTuristico', function($q) use ($request) {
                      $q->where('nome', 'like', '%' . $request->search . '%');
                  });
            });
        }

        if ($request->has('avaliacao') && $request->avaliacao) {
            $query->where('avaliacao', $request->avaliacao);
        }

        if ($request->has('data_inicio') && $request->data_inicio) {
            $query->whereDate('created_at', '>=', $request->data_inicio);
        }

        if ($request->has('data_fim') && $request->data_fim) {
            $query->whereDate('created_at', '<=', $request->data_fim);
        }

        $feedbacks = $query->paginate(20);

        // Estatísticas
        $estatisticas = [
            'total' => Feedback::count(),
            'media_avaliacao' => Feedback::avg('avaliacao'),
            'distribuicao' => Feedback::selectRaw('avaliacao, count(*) as total')
                ->groupBy('avaliacao')
                ->orderBy('avaliacao')
                ->get()
                ->pluck('total', 'avaliacao')
        ];

        return view('feedbacks.index', compact('feedbacks', 'estatisticas'));
    }

    public function show(Feedback $feedback)
    {
        return view('feedbacks.show', compact('feedback'));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('feedbacks.index')
            ->with('success', 'Feedback excluído com sucesso!');
    }

    public function exportar(Request $request)
    {
        $feedbacks = Feedback::with('pontoTuristico')
            ->when($request->avaliacao, fn($q) => $q->where('avaliacao', $request->avaliacao))
            ->when($request->data_inicio, fn($q) => $q->whereDate('created_at', '>=', $request->data_inicio))
            ->when($request->data_fim, fn($q) => $q->whereDate('created_at', '<=', $request->data_fim))
            ->get();

        $csv = \League\Csv\Writer::createFromString('');
        $csv->insertOne([
            'ID', 'Ponto Turístico', 'Nome', 'Email', 'Avaliação', 'Mensagem', 'Data'
        ]);

        foreach ($feedbacks as $feedback) {
            $csv->insertOne([
                $feedback->id,
                $feedback->pontoTuristico->nome,
                $feedback->nome,
                $feedback->email,
                $feedback->avaliacao,
                strip_tags($feedback->mensagem),
                $feedback->created_at->format('d/m/Y H:i')
            ]);
        }

        return response((string) $csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="feedbacks_' . date('Y-m-d') . '.csv"',
        ]);
    }
}
