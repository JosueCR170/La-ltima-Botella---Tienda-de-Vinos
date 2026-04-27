<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

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
            'nivel' => 'required|integer',
        ]);

        Categoria::create($request->all());
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada con éxito.');
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
            'nivel' => 'required|integer',
        ]);

        $categoria->update($request->all());
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada con éxito.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada con éxito.');
    }
}
