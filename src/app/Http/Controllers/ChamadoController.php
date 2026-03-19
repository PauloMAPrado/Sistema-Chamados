<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use App\Models\Categoria;
use App\Models\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ChamadoController extends Controller
{
    public function index(Request $request)
    {
        $query = Chamado::with(['tecnico', 'categoria']);

        if ($request->filled('prioridade')) {
            $query->where('prioridade', $request->prioridade);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', '!=', 'fechado');
        }
        
        
        
        
        
        
        
        $chamados = $query->orderByPrioridade()->orderBy('data_abertura', 'desc')->paginate(12);

        return view('chamados.index', [
            'chamados' => $chamados,
        ]);
    }

    public function create()
    {
        return view('chamados.create', [
            'tecnicos'   => Tecnico::all(),
            'categorias' => Categoria::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'        => ['required', 'string', 'max:255'],
            'descricao'     => ['required', 'string'],
            'prioridade'    => ['required', Rule::in(Chamado::PRIORIDADES)],
            
            'status'        => ['required', Rule::in(Chamado::STATUSES)],
            'data_abertura' => ['required', 'date'],
            'tecnico_id'    => ['required', 'exists:tecnicos,id'],
            'categoria_id'  => ['required', 'exists:categorias,id'],
        ]);

        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        Chamado::create($data);

        return redirect()->route('chamados.index')->with('ok', 'Chamado criado com sucesso.');
    }

    public function show(Chamado $chamado)
    {
        return view('chamados.show', compact('chamado'));
    }

    public function edit(Chamado $chamado)
    {
        return view('chamados.edit', [
            'chamado'    => $chamado,
            'tecnicos'   => Tecnico::all(),
            'categorias' => Categoria::all(),
        ]);
    }

    public function update(Request $request, Chamado $chamado)
    {
        $data = $request->validate([
            'titulo'        => ['required', 'string', 'max:255'],
            'descricao'     => ['required', 'string'],
            'prioridade'    => ['required', Rule::in(Chamado::PRIORIDADES)],
            
            'status'        => ['required', Rule::in(Chamado::STATUSES)],
            'data_abertura' => ['required', 'date'],
            'tecnico_id'    => ['required', 'exists:tecnicos,id'],
            'categoria_id'  => ['required', 'exists:categorias,id'],
        ]);

    $this->authorize('update', $chamado);

        if (isset($data['status']) && $data['status'] === Chamado::STATUS_FECHADO && $chamado->status !== Chamado::STATUS_RESOLVIDO) {
            return redirect()->back()->withErrors(['status' => 'Um chamado só pode ser fechado se estiver no status "resolvido".'])->withInput();
        }

        if (isset($data['status']) && $data['status'] === Chamado::STATUS_RESOLVIDO && $chamado->status !== Chamado::STATUS_RESOLVIDO) {
            $this->authorize('resolve', $chamado);
            if (Auth::check()) {
                $data['resolvido_por_id'] = Auth::id();
            }
        }

        if (isset($data['status']) && $data['status'] === Chamado::STATUS_FECHADO && $chamado->status !== Chamado::STATUS_FECHADO) {
            $this->authorize('close', $chamado);
            if (Auth::check()) {
                $data['fechado_por_id'] = Auth::id();
            }
        }

        $chamado->update($data);

        return redirect()->route('chamados.index')->with('ok', 'Chamado atualizado com sucesso.');
    }

    public function destroy(Chamado $chamado)
    {
        $chamado->delete();

        return redirect()->route('chamados.index')->with('ok', 'Chamado removido.');
    }

    public function atender(Chamado $chamado): RedirectResponse
    {
        $this->authorize('attend', $chamado);

        if ($chamado->status !== Chamado::STATUS_ABERTO) {
            return redirect()->back()->withErrors(['status' => 'Somente chamados abertos podem ser colocados em atendimento.']);
        }

        $chamado->status = Chamado::STATUS_EM_ATENDIMENTO;
        $chamado->save();

        return redirect()->route('chamados.show', $chamado)->with('ok', 'Chamado em atendimento.');
    }
    public function resolver(Chamado $chamado): RedirectResponse
    {
        $this->authorize('resolve', $chamado);

        if (! in_array($chamado->status, [Chamado::STATUS_ABERTO, Chamado::STATUS_EM_ATENDIMENTO])) {
            return redirect()->back()->withErrors(['status' => 'Somente chamados abertos ou em atendimento podem ser marcados como resolvidos.']);
        }

        $chamado->status = Chamado::STATUS_RESOLVIDO;
        if (Auth::check()) {
            $chamado->resolvido_por_id = Auth::id();
        }
        $chamado->save();

        return redirect()->route('chamados.show', $chamado)->with('ok', 'Chamado marcado como resolvido.');
    }
    public function fechar(Chamado $chamado): RedirectResponse
    {
        $this->authorize('close', $chamado);

        if ($chamado->status !== Chamado::STATUS_RESOLVIDO) {
            return redirect()->back()->withErrors(['status' => 'Um chamado só pode ser fechado se estiver no status "resolvido".']);
        }

        $chamado->status = Chamado::STATUS_FECHADO;
        if (Auth::check()) {
            $chamado->fechado_por_id = Auth::id();
        }
        $chamado->save();

        return redirect()->route('chamados.show', $chamado)->with('ok', 'Chamado fechado.');
    }


}

    

