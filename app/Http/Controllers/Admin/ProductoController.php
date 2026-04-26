<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with(['categoria', 'marca']);

        // Búsqueda por nombre o descripción
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombre', 'like', $searchTerm)
                  ->orWhere('descripcion', 'like', $searchTerm);
            });
        }

        // Filtro por categoría
        if ($request->has('categoria') && !empty($request->categoria)) {
            $query->where('id_categoria', $request->categoria);
        }

        // Filtro por marca
        if ($request->has('marca') && !empty($request->marca)) {
            $query->where('id_marca', $request->marca);
        }

        // Ordenamiento
        $sort = $request->get('sort', 'id_producto');
        $direction = $request->get('direction', 'desc');

        if ($sort === 'categoria') {
            $query->join('categorias', 'productos.id_categoria', '=', 'categorias.id_categoria')
                  ->orderBy('categorias.nombre', $direction)
                  ->select('productos.*');
        } elseif ($sort === 'marca') {
            $query->join('marcas', 'productos.id_marca', '=', 'marcas.id_marca')
                  ->orderBy('marcas.nombre', $direction)
                  ->select('productos.*');
        } else {
            // Validar que la columna existe para evitar errores SQL
            $allowedSorts = ['nombre', 'cantidad', 'precio', 'estado', 'id_producto', 'created_at'];
            if (in_array($sort, $allowedSorts)) {
                $query->orderBy($sort, $direction);
            } else {
                $query->orderBy('id_producto', 'desc');
            }
        }

        $productos = $query->paginate(10)->withQueryString();
        
        $categorias = Categoria::all();
        $marcas = Marca::all();

        return view('admin.productos.index', compact('productos', 'categorias', 'marcas'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('admin.productos.create', compact('categorias', 'marcas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:200',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_marca' => 'required|exists:marcas,id_marca',
            'precio' => 'required|numeric',
        ]);

        Producto::create($request->all());
        return redirect()->route('admin.productos.index')->with('success', 'Producto creado con éxito.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('admin.productos.edit', compact('producto', 'categorias', 'marcas'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|max:200',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_marca' => 'required|exists:marcas,id_marca',
            'precio' => 'required|numeric',
        ]);

        $producto->update($request->all());
        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado con éxito.');
    }
}
