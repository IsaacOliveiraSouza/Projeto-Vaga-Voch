<?php

namespace App\Http\Controllers;

use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use App\Services\BandeiraService;
use App\Services\GrupoEconomicoService;
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
        $gruposeconomicos = $this->service->getPaginate(perPage: 10);
        return view(view: 'bandeira.index', data: compact(var_name: 'bandeiras'));
    }
    public function create(GrupoEconomicoService $grupoEconomicoService): View
    {
        $grupos = $grupoEconomicoService->getAll();
        return view(view: 'bandeira.create', data: compact(var_name: 'grupos'));
    }
    public function edit(int $id): View
    {
        $Bandeira = $this->service->findById(id: $id);
        return view(view: 'bandeira.edit', data: compact(var_name: 'bandeira'));
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
            return redirect()->route(route: 'grupo-economico.index')->with(key: 'success', value: 'Contato atualizada com sucesso!');
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
