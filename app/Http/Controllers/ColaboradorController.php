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

class ColaboradorController extends Controller
{

    protected ColaboradorService $service;
    public function __construct(ColaboradorService $service)
    {
        $this->service = $service;
    }
    
    public function index(): View
    {
        $gruposeconomicos = $this->service->getPaginate(perPage: 10);
        return view(view: 'colaborador.index', data: compact(var_name: 'colaboradores'));
    }
    public function create(UnidadeService $unidadeService): View
    {
        $unidades = $unidadeService->getAll();
        return view(view: 'colaborador.create', data: compact(var_name: 'unidades'));
    }
    public function edit(int $id): View
    {
        $colaborador = $this->service->findById(id: $id);
        return view(view: 'colaborador.edit', data: compact(var_name: 'colaborador'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        try {
            $this->service->create(data: $request->all());
            return redirect()->route(route: 'welcome')->with(key: 'success', value: 'Contato enviado com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    
    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $this->service->update(id: $id, data: $request->all());
            return redirect()->route(route: 'colaborador.index')->with(key: 'success', value: 'Contato atualizada com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->service->delete(id: $id);
            return redirect()->route(route: 'grupo-economico.index')->with(key: 'success', value: 'Contato excluída com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage());
        }
    }
    
}
