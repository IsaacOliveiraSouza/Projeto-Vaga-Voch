<?php

namespace App\Http\Controllers;

use App\Models\GrupoEconomico;
use App\Services\BandeiraService;
use App\Services\GrupoEconomicoService;
use App\Services\UnidadeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UnidadeController extends Controller
{
    protected UnidadeService $service;
    public function __construct(UnidadeService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        return view('unidade.index');
    }

    public function search(Request $request): JsonResponse
    {
        $unidades = $this->service->getAll();
        $unidades = $unidades
            ->filter(function ($unidade) use ($request) {
                return str_contains(strtolower($unidade->razao_social), strtolower($request->search));
            })
            ->map(function ($unidade) {
                return [
                    'id' => $unidade->id,
                    'nome' => $unidade->nome_fantasia,
                ];
            });
        return response()->json($unidades);
    }
}
