<?php

namespace App\Http\Controllers;

use App\Models\GrupoEconomico;
use App\Services\BandeiraService;
use App\Services\GrupoEconomicoService;
use App\Services\UnidadeService;
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
        $gruposeconomicos = $this->service->getPaginate(perPage: 10);
        return view(view: 'unidade.index', data: compact(var_name: 'unidades'));
    }
    public function create(BandeiraService $bandeiraService): View
    {
        $bandeiras = $bandeiraService->getAll();
        return view(view: 'unidade.create',data: compact(var_name: 'bandeiras'));
    }
    public function edit(int $id): View
    {
        $grupoeconomico = $this->service->findById(id: $id);
        return view(view: 'unidade.edit', data: compact(var_name: 'unidade'));
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
            return redirect()->route(route: 'unidade.index')->with(key: 'success', value: 'Contato atualizada com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->service->delete(id: $id);
            return redirect()->route(route: 'unidade.index')->with(key: 'success', value: 'Contato excluída com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage());
        }
    }
    
}
