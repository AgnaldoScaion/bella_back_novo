<?php
namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{
    public function index(Request $request)
    {
        $query = Restaurante::query();

        // Aplicar filtros
        if ($request->has('tipo_cozinha') && $request->tipo_cozinha) {
            $query->whereJsonContains('tipos', $request->tipo_cozinha);
        }

        if ($request->has('preco') && $request->preco) {
            $query->where('preco', $request->preco);
        }

        if ($request->has('avaliacao') && $request->avaliacao) {
            $query->where('avaliacao', '>=', $request->avaliacao);
        }

        if ($request->has('localizacao') && $request->localizacao) {
            $query->where('cidade', $request->localizacao);
        }

        $restaurantes = $query->get();

        if ($request->ajax()) {
            return response()->json($restaurantes);
        }

        return view('destinos.restaurantes.index');
    }

    public function show($id)
    {
        $restaurante = Restaurante::findOrFail($id);
        return view('destinos.restaurantes.show', compact('restaurante'));
    }
}
