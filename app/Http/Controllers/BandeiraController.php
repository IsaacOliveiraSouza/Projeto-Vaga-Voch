<?php

namespace App\Http\Controllers;

use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use App\Services\BandeiraService;
use App\Services\GrupoEconomicoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BandeiraController extends Controller
{
    protected BandeiraService $service;

    public function __construct(BandeiraService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        return view('bandeira.index');
    }

    public function search(Request $request): JsonResponse
    {
        $bandeiras = $this->service->getAll();
        $bandeiras = $bandeiras
            ->filter(function ($bandeira) use ($request) {
                return str_contains(strtolower($bandeira->nome), strtolower($request->search));
            })
            ->map(function ($bandeira) {
                return [
                    'id' => $bandeira->id,
                    'nome' => $bandeira->nome,
                ];
            });
        return response()->json($bandeiras);
    }
}
