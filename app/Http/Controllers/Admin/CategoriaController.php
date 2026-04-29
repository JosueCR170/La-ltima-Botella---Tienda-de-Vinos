<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Categoria::with('padre');

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('nombre', 'like', $searchTerm)
                  ->orWhere('descripcion', 'like', $searchTerm);
        }

        $query->orderByRaw('CASE WHEN nombre_padre IS NULL THEN id_categoria ELSE nombre_padre END ASC')
              ->orderBy('nivel', 'asc');

        $categorias = $query->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create(Request $request)
    {
        $categoriasPadre = Categoria::where('nivel', 1)->get();
        return view('admin.categorias.create', compact('categoriasPadre', 'request'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:categorias,nombre',
            'nivel' => 'required|integer|in:1,2',
            'descripcion' => 'nullable|max:500',
            'nombre_padre' => 'nullable|exists:categorias,id_categoria',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder 100 caracteres.',
            'nombre.unique' => 'Ya existe una categoría con ese nombre.',
            'nivel.required' => 'El nivel jerárquico es obligatorio.',
            'nivel.in' => 'El nivel debe ser 1 (Principal) o 2 (Subcategoría).',
            'nombre_padre.exists' => 'La categoría padre seleccionada no existe.',
            'descripcion.max' => 'La descripción no puede exceder 500 caracteres.',
        ]);

        try {
            Categoria::create($request->all());
            return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada con éxito.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['db_error' => 'Error al guardar la categoría en la base de datos. Verifique que los datos sean correctos.']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocurrió un error inesperado al crear la categoría.']);
        }
    }

    public function edit(Categoria $categoria)
    {
        $categoriasPadre = Categoria::where('nivel', 1)->get();
        return view('admin.categorias.edit', compact('categoria', 'categoriasPadre'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:categorias,nombre,' . $categoria->id_categoria . ',id_categoria',
            'nivel' => 'required|integer|in:1,2',
            'descripcion' => 'nullable|max:500',
            'nombre_padre' => 'nullable|exists:categorias,id_categoria',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder 100 caracteres.',
            'nombre.unique' => 'Ya existe otra categoría con ese nombre.',
            'nivel.required' => 'El nivel jerárquico es obligatorio.',
            'nivel.in' => 'El nivel debe ser 1 (Principal) o 2 (Subcategoría).',
            'nombre_padre.exists' => 'La categoría padre seleccionada no existe.',
            'descripcion.max' => 'La descripción no puede exceder 500 caracteres.',
        ]);

        try {
            $categoria->update($request->all());
            return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada con éxito.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['db_error' => 'Error al actualizar la categoría en la base de datos.']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocurrió un error inesperado al actualizar la categoría.']);
        }
    }

    public function destroy(Categoria $categoria)
    {
        try {
            // Verificar si tiene subcategorías asociadas
            $subcategorias = Categoria::where('nombre_padre', $categoria->id_categoria)->count();
            if ($subcategorias > 0) {
                return redirect()->route('admin.categorias.index')->withErrors(['error' => 'No se puede eliminar esta categoría porque tiene ' . $subcategorias . ' subcategoría(s) asociada(s). Elimine primero las subcategorías.']);
            }

            // Verificar si tiene productos asociados
            $productos = $categoria->productos()->count();
            if ($productos > 0) {
                return redirect()->route('admin.categorias.index')->withErrors(['error' => 'No se puede eliminar esta categoría porque tiene ' . $productos . ' producto(s) asociado(s). Reasigne los productos primero.']);
            }

            $categoria->delete();
            return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada con éxito.');
        } catch (QueryException $e) {
            return redirect()->route('admin.categorias.index')->withErrors(['error' => 'No se puede eliminar esta categoría porque tiene registros dependientes.']);
        } catch (\Exception $e) {
            return redirect()->route('admin.categorias.index')->withErrors(['error' => 'Ocurrió un error inesperado al eliminar la categoría.']);
        }
    }
}
