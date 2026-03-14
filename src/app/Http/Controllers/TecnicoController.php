<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
    public function index()
    {
        return view('tecnicos.index', [
            'tecnicos' => Tecnico::all(),
        ]);
    }

    public function create()
    {
        return view('tecnicos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'          => 'required|string|max:255',
            'email'         => 'required|email|unique:tecnicos,email',
            'especialidade' => 'required|string|max:255',
        ]);

        Tecnico::create($data);

        return redirect()->route('tecnicos.index')->with('ok', 'Técnico criado com sucesso.');
    }

    public function edit(Tecnico $tecnico)
    {
        return view('tecnicos.edit', compact('tecnico'));
    }

    public function update(Request $request, Tecnico $tecnico)
    {
        $data = $request->validate([
            'nome'          => 'required|string|max:255',
            'email'         => 'required|email|unique:tecnicos,email,' . $tecnico->id,
            'especialidade' => 'required|string|max:255',
        ]);

        $tecnico->update($data);

        return redirect()->route('tecnicos.index')->with('ok', 'Técnico atualizado com sucesso.');
    }

    public function destroy(Tecnico $tecnico)
    {
        $tecnico->delete();

        return redirect()->route('tecnicos.index')->with('ok', 'Técnico removido.');
    }
}
