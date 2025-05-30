<?php

namespace App\Http\Controllers;

use App\Models\GrupoEconomico;
use App\Services\GrupoEconomicoService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class GrupoEconomicoController extends Controller
{
    protected GrupoEconomicoService $service;

    public function __construct(GrupoEconomicoService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        return view('grupo-economico.index');
    }

    public function search(Request $request): JsonResponse
    {
        $gruposEconomicos = $this->service->getAll();
        $gruposEconomicos = $gruposEconomicos
            ->filter(function ($grupoEconomico) use ($request) {
                return str_contains(strtolower($grupoEconomico->nome), strtolower($request->search));
            })
            ->map(function ($grupoEconomico) {
                return [
                    'id' => $grupoEconomico->id,
                    'nome' => $grupoEconomico->nome,
                ];
            });
        return response()->json($gruposEconomicos);
    }
}
