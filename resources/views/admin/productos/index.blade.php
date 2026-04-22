@extends('layouts.admin')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Gestión de Productos</h1>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">Nuevo Producto</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
                <tr>
                    <td>{{ $producto->id_producto }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria ? $producto->categoria->nombre : 'N/A' }}</td>
                    <td>{{ $producto->marca ? $producto->marca->nombre : 'N/A' }}</td>
                    <td>₡{{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>
                        @if($producto->estado)
                            <span style="color: var(--primary-fixed-dim); font-weight: bold;">Activo</span>
                        @else
                            <span style="color: var(--error);">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.productos.edit', $producto->id_producto) }}" class="btn btn-secondary btn-sm">Editar</a>
                        <form action="{{ route('admin.productos.destroy', $producto->id_producto) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">No hay productos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
