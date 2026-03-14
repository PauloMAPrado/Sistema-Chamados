<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return view('categorias.index', [
            'categorias' => Categoria::all(),
        ]);
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'  => 'required|string|max:255',
            'horas' => 'required|integer|min:1',
        ]);

        Categoria::create($data);

        return redirect()->route('categorias.index')->with('ok', 'Categoria criada com sucesso.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nome'  => 'required|string|max:255',
            'horas' => 'required|integer|min:1',
        ]);

        $categoria->update($data);

        return redirect()->route('categorias.index')->with('ok', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('ok', 'Categoria removida.');
    }
}
