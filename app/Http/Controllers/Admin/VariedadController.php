<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variedad;
use Illuminate\Http\Request;

class VariedadController extends Controller
{
    public function index(Request $request)
    {
        $query = Variedad::query();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('nombre', 'like', $searchTerm)
                  ->orWhere('tipo', 'like', $searchTerm);
        }

        $sort = $request->get('sort', 'id_variedad');
        $direction = $request->get('direction', 'desc');
        $allowedSorts = ['nombre', 'tipo', 'id_variedad'];
        
        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('id_variedad', 'desc');
        }

        $variedades = $query->paginate(10)->withQueryString();
        return view('admin.variedades.index', compact('variedades'));
    }

    public function create()
    {
        return view('admin.variedades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:variedades,nombre',
            'tipo' => 'required',
        ]);

        Variedad::create($request->all());
        return redirect()->route('admin.variedades.index')->with('success', 'Variedad creada con éxito.');
    }

    public function edit(Variedad $variedade) // Note: Laravel uses 'variedade' as singular for 'variedades' resource
    {
        $variedad = $variedade;
        return view('admin.variedades.edit', compact('variedad'));
    }

    public function update(Request $request, Variedad $variedade)
    {
        $variedad = $variedade;
        $request->validate([
            'nombre' => 'required|max:100|unique:variedades,nombre,' . $variedad->id_variedad . ',id_variedad',
            'tipo' => 'required',
        ]);

        $variedad->update($request->all());
        return redirect()->route('admin.variedades.index')->with('success', 'Variedad actualizada con éxito.');
    }

    public function destroy(Variedad $variedade)
    {
        $variedade->delete();
        return redirect()->route('admin.variedades.index')->with('success', 'Variedad eliminada con éxito.');
    }
}
