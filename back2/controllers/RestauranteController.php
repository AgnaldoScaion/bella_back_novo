<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{
    public function listar(Request $request)
    {
        $query = Restaurante::query();

        // Filtro por cidade
        if ($request->has('cidade')) {
            $query->where('cidade', $request->cidade);
        }

        $restaurantes = $query->paginate(6);
        $cidades = Restaurante::select('cidade')
            ->distinct()
            ->pluck('cidade');

        return view('restaurante', compact('restaurantes', 'cidades')); // Alterado para 'restaurante' em vez de 'restaurante.lista'
    }

    public function detalhes($id)
    {
        $restaurante = Restaurante::findOrFail($id);
        return view('restaurante.detalhes', compact('restaurante'));
    }
}
