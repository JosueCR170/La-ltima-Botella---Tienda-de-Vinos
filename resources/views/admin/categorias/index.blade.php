@extends('layouts.admin')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Gestión de Categorías</h1>
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">Nueva Categoría</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Nivel</th>
                <th>Categoría Padre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id_categoria }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ $categoria->nivel }}</td>
                    <td>{{ $categoria->padre ? $categoria->padre->nombre : 'N/A' }}</td>
                    <td>
                        <form action="{{ route('admin.categorias.destroy', $categoria->id_categoria) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No hay categorías.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
