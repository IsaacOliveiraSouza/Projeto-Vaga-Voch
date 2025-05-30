<?php

namespace App\Http\Controllers;

use App\Models\colaborador;
use App\Models\GrupoEconomico;
use App\Services\ColaboradorService;
use App\Services\GrupoEconomicoService;
use App\Services\UnidadeService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ColaboradorController extends Controller
{
    protected ColaboradorService $service;
    public function __construct(ColaboradorService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        return view('colaborador.index');
    }

    public function search(Request $request): JsonResponse
    {
        $colaboradores = $this->service->getAll();
        $colaboradores = $colaboradores
            ->filter(function ($colaborador) use ($request) {
                return str_contains(strtolower($colaborador->nome), strtolower($request->search));
            })
            ->map(function ($colaborador) {
                return [
                    'id' => $colaborador->id,
                    'nome' => $colaborador->nome,
                ];
            });
        return response()->json($colaboradores);
    }
}
