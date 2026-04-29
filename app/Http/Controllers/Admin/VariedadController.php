<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variedad;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class VariedadController extends Controller
{
    public function index(Request $request)
    {
        $query = Variedad::withCount('productos');

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('nombre', 'like', $searchTerm)
                  ->orWhere('tipo', 'like', $searchTerm);
        }

        $sort = $request->get('sort', 'id_variedad');
        $direction = $request->get('direction', 'desc');
        $allowedSorts = ['nombre', 'tipo', 'productos_count', 'id_variedad'];
        
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
            'tipo' => 'required|in:Tinta,Blanca,Aromatica',
            'descripcion' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El nombre de la variedad es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder 100 caracteres.',
            'nombre.unique' => 'Ya existe una variedad con ese nombre.',
            'tipo.required' => 'El tipo de variedad es obligatorio.',
            'tipo.in' => 'El tipo debe ser Tinta, Blanca o Aromática.',
            'descripcion.max' => 'La descripción no puede exceder 500 caracteres.',
        ]);

        try {
            Variedad::create($request->all());
            return redirect()->route('admin.variedades.index')->with('success', 'Variedad creada con éxito.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['db_error' => 'Error al guardar la variedad en la base de datos.']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocurrió un error inesperado al crear la variedad.']);
        }
    }

    public function edit(Variedad $variedade)
    {
        $variedad = $variedade;
        return view('admin.variedades.edit', compact('variedad'));
    }

    public function update(Request $request, Variedad $variedade)
    {
        $variedad = $variedade;
        $request->validate([
            'nombre' => 'required|max:100|unique:variedades,nombre,' . $variedad->id_variedad . ',id_variedad',
            'tipo' => 'required|in:Tinta,Blanca,Aromatica',
            'descripcion' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El nombre de la variedad es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder 100 caracteres.',
            'nombre.unique' => 'Ya existe otra variedad con ese nombre.',
            'tipo.required' => 'El tipo de variedad es obligatorio.',
            'tipo.in' => 'El tipo debe ser Tinta, Blanca o Aromática.',
            'descripcion.max' => 'La descripción no puede exceder 500 caracteres.',
        ]);

        try {
            $variedad->update($request->all());
            return redirect()->route('admin.variedades.index')->with('success', 'Variedad actualizada con éxito.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['db_error' => 'Error al actualizar la variedad.']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocurrió un error inesperado al actualizar la variedad.']);
        }
    }

    public function destroy(Variedad $variedade)
    {
        try {
            $productos = $variedade->productos()->count();
            if ($productos > 0) {
                return redirect()->route('admin.variedades.index')->withErrors(['error' => 'No se puede eliminar "' . $variedade->nombre . '" porque tiene ' . $productos . ' producto(s) asociado(s).']);
            }

            $variedade->delete();
            return redirect()->route('admin.variedades.index')->with('success', 'Variedad eliminada con éxito.');
        } catch (QueryException $e) {
            return redirect()->route('admin.variedades.index')->withErrors(['error' => 'No se puede eliminar esta variedad porque tiene registros dependientes.']);
        } catch (\Exception $e) {
            return redirect()->route('admin.variedades.index')->withErrors(['error' => 'Ocurrió un error inesperado al eliminar la variedad.']);
        }
    }
}
