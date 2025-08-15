<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{
    public function listar(Request $request)
    {
        $query = Restaurante::query();

        // Filtros
        if ($request->has('tipo')) {
            $query->where('tipos', 'like', '%'.$request->tipo.'%');
        }

        if ($request->has('cidade')) {
            $query->where('cidade', $request->cidade);
        }

        $restaurantes = $query->paginate(6);

        $tiposCozinha = Restaurante::select('tipos')
            ->distinct()
            ->get()
            ->flatMap(function($item) {
                return json_decode($item->tipos, true);
            })
            ->unique()
            ->sort();

        $cidades = Restaurante::select('cidade')
            ->distinct()
            ->pluck('cidade');

        return view('restaurante.lista', compact('restaurantes', 'tiposCozinha', 'cidades'));
    }

    public function detalhes($id)
    {
        $restaurante = Restaurante::findOrFail($id);
        return view('restaurante.detalhes', compact('restaurante'));
    }
}
