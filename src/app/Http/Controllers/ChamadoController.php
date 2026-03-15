<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use App\Models\Categoria;
use App\Models\Tecnico;
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    public function index()
    {
        return view('chamados.index', [
            'chamados' => Chamado::with(['tecnico', 'categoria'])->get(),
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
            'prioridade'    => ['required', 'in:baixa,média,alta'],
            'status'        => ['required', 'in:aberto,em andamento,fechado'],
            'data_abertura' => ['required', 'date'],
            'tecnico_id'    => ['required', 'exists:tecnicos,id'],
            'categoria_id'  => ['required', 'exists:categorias,id'],
        ]);

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
        $dados = $request->validate([
            'titulo'        => ['required', 'string', 'max:255'],
            'descricao'     => ['required', 'string'],
            'prioridade'    => ['required', 'in:baixa,média,alta'],
            'status'        => ['required', 'in:aberto,em andamento,fechado'],
            'data_abertura' => ['required', 'date'],
            'tecnico_id'    => ['required', 'exists:tecnicos,id'],
            'categoria_id'  => ['required', 'exists:categorias,id'],
        ]);

        $chamado->update($data);

        return redirect()->route('chamados.index')->with('ok', 'Chamado atualizado com sucesso.');
    }

    public function destroy(Chamado $chamado)
    {
        $chamado->delete();

        return redirect()->route('chamados.index')->with('ok', 'Chamado removido.');
    }
}
