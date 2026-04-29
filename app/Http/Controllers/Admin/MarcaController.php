<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
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
            'pais' => 'required|max:100',
            'descripcion' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El nombre de la marca es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder 100 caracteres.',
            'nombre.unique' => 'Ya existe una marca con ese nombre.',
            'pais.required' => 'El país de origen es obligatorio.',
            'descripcion.max' => 'La descripción no puede exceder 500 caracteres.',
        ]);

        try {
            Marca::create($request->all());
            return redirect()->route('admin.marcas.index')->with('success', 'Marca creada con éxito.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['db_error' => 'Error al guardar la marca en la base de datos.']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocurrió un error inesperado al crear la marca.']);
        }
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
            'pais' => 'required|max:100',
            'descripcion' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El nombre de la marca es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder 100 caracteres.',
            'nombre.unique' => 'Ya existe otra marca con ese nombre.',
            'pais.required' => 'El país de origen es obligatorio.',
            'descripcion.max' => 'La descripción no puede exceder 500 caracteres.',
        ]);

        try {
            $marca->update($request->all());
            return redirect()->route('admin.marcas.index')->with('success', 'Marca actualizada con éxito.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['db_error' => 'Error al actualizar la marca.']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocurrió un error inesperado al actualizar la marca.']);
        }
    }

    public function destroy(Marca $marca)
    {
        try {
            $productos = $marca->productos()->count();
            if ($productos > 0) {
                return redirect()->route('admin.marcas.index')->withErrors(['error' => 'No se puede eliminar "' . $marca->nombre . '" porque tiene ' . $productos . ' producto(s) asociado(s).']);
            }

            $marca->delete();
            return redirect()->route('admin.marcas.index')->with('success', 'Marca eliminada con éxito.');
        } catch (QueryException $e) {
            return redirect()->route('admin.marcas.index')->withErrors(['error' => 'No se puede eliminar esta marca porque tiene registros dependientes.']);
        } catch (\Exception $e) {
            return redirect()->route('admin.marcas.index')->withErrors(['error' => 'Ocurrió un error inesperado al eliminar la marca.']);
        }
    }
}
