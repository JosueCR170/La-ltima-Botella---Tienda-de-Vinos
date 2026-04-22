<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return view('admin.marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('admin.marcas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:150',
        ]);

        Marca::create($request->all());
        return redirect()->route('admin.marcas.index')->with('success', 'Marca creada con éxito.');
    }

    public function edit(Marca $marca)
    {
        return view('admin.marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre' => 'required|max:150',
        ]);

        $marca->update($request->all());
        return redirect()->route('admin.marcas.index')->with('success', 'Marca actualizada con éxito.');
    }

    public function destroy(Marca $marca)
    {
        $marca->delete();
        return redirect()->route('admin.marcas.index')->with('success', 'Marca eliminada con éxito.');
    }
}
