<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variedad;
use Illuminate\Http\Request;

class VariedadController extends Controller
{
    public function index()
    {
        $variedades = Variedad::all();
        return view('admin.variedades.index', compact('variedades'));
    }

    public function create()
    {
        return view('admin.variedades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
        ]);

        Variedad::create($request->all());
        return redirect()->route('admin.variedades.index')->with('success', 'Variedad creada con éxito.');
    }

    public function edit(Variedad $variedade)
    {
        return view('admin.variedades.edit', compact('variedade'));
    }

    public function update(Request $request, Variedad $variedade)
    {
        $request->validate([
            'nombre' => 'required|max:100',
        ]);

        $variedade->update($request->all());
        return redirect()->route('admin.variedades.index')->with('success', 'Variedad actualizada con éxito.');
    }

    public function destroy(Variedad $variedade)
    {
        $variedade->delete();
        return redirect()->route('admin.variedades.index')->with('success', 'Variedad eliminada con éxito.');
    }
}
