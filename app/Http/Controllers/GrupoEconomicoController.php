<?php

namespace App\Http\Controllers;

use App\Models\GrupoEconomico;
use App\Services\GrupoEconomicoService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class GrupoEconomicoController extends Controller
{

    protected GrupoEconomicoService $service;
    public function __construct(GrupoEconomicoService $service)
    {
        $this->service = $service;
    }
    
    public function index(): View
    {
        $gruposeconomicos = $this->service->getPaginate(perPage: 10);
        return view(view: 'grupo-economico.index', data: compact(var_name: 'gruposeconomicos'));
    }
    public function create(): View
    {
        return view(view: 'grupo-economico.create');
    }
    public function edit(int $id): View
    {
        $grupoeconomico = $this->service->findById(id: $id);
        return view(view: 'grupo-economico.edit', data: compact(var_name: 'grupoeconomico'));
    }
public function confirmDelete(int $id): Response
{
    $grupo = GrupoEconomico::findOrFail($id); // Garante que $grupo existe
    $view = view('grupo-economico.delete', compact('grupo'))->render(); // Passa o grupo pra view

    return response($view);
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
