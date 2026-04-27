<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;
use Monarobase\CountryList\CountryList;

class MarcaController extends Controller
{
    public function index(Request $request)
    {
        $query = Marca::query();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('nombre', 'like', $searchTerm)
                  ->orWhere('descripcion', 'like', $searchTerm);
        }

        if ($request->has('pais') && !empty($request->pais)) {
            $query->where('pais', $request->pais);
        }

        $sort = $request->get('sort', 'id_marca');
        $direction = $request->get('direction', 'desc');
        $allowedSorts = ['nombre', 'pais', 'id_marca'];
        
        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('id_marca', 'desc');
        }

        $marcas = $query->paginate(10)->withQueryString();

        $countries = new CountryList();
        $paises = $countries->getList('es');

        return view('admin.marcas.index', compact('marcas', 'paises'));
    }

    public function create()
    {
        $countries = new CountryList();
        $paises = $countries->getList('es');
        return view('admin.marcas.create', compact('paises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:marcas,nombre',
            'pais' => 'required',
        ]);

        Marca::create($request->all());
        return redirect()->route('admin.marcas.index')->with('success', 'Marca creada con éxito.');
    }

    public function edit(Marca $marca)
    {
        $countries = new CountryList();
        $paises = $countries->getList('es');
        return view('admin.marcas.edit', compact('marca', 'paises'));
    }

    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:marcas,nombre,' . $marca->id_marca . ',id_marca',
            'pais' => 'required',
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
