@extends('layouts.admin')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.filter-select').select2({
            width: '100%'
        });
    });
</script>
@endpush

@section('content')
<div class="index-view">
    <header class="index-header">
        <div class="header-info">
            <h1>Inventario de Productos</h1>
            <p>Gestiona la selección editorial de licores finos y vinos de cosecha.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.productos.create') }}" class="btn-create">
                <span class="material-symbols-outlined">add</span>
                <span>Nuevo Producto</span>
            </a>
        </div>
    </header>

    <!-- Barra de Filtros -->
    <form action="{{ route('admin.productos.index') }}" method="GET" class="filter-bar">
        <div class="filter-group">
            <span class="material-symbols-outlined filter-icon">search</span>
            <input type="text" name="search" class="filter-input" placeholder="Buscar por nombre o descripción..." value="{{ request('search') }}">
        </div>

        <div class="filter-group">
            <select name="categoria" class="filter-select">
                <option value="">Todas las Categorías</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}" {{ request('categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <select name="marca" class="filter-select">
                <option value="">Todas las Marcas</option>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id_marca }}" {{ request('marca') == $marca->id_marca ? 'selected' : '' }}>
                        {{ $marca->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-filter">Filtrar</button>
        
        @if(request()->anyFilled(['search', 'categoria', 'marca']))
            <a href="{{ route('admin.productos.index') }}" class="btn-reset">Limpiar Filtros</a>
        @endif
    </form>

    <div class="table-wrapper">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>
                        <a href="{{ route('admin.productos.index', array_merge(request()->query(), ['sort' => 'nombre', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="sort-link">
                            Producto
                            <span class="material-symbols-outlined sort-icon {{ request('sort') == 'nombre' ? 'active' : '' }}">
                                {{ request('sort') == 'nombre' ? (request('direction') == 'asc' ? 'arrow_upward' : 'arrow_downward') : 'unfold_more' }}
                            </span>
                        </a>
                    </th>
                    <th>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <a href="{{ route('admin.productos.index', array_merge(request()->query(), ['sort' => 'categoria', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="sort-link">
                                Categoría
                                <span class="material-symbols-outlined sort-icon {{ request('sort') == 'categoria' ? 'active' : '' }}">
                                    {{ request('sort') == 'categoria' ? (request('direction') == 'asc' ? 'arrow_upward' : 'arrow_downward') : 'unfold_more' }}
                                </span>
                            </a>
                            <span style="opacity: 0.3;">/</span>
                            <a href="{{ route('admin.productos.index', array_merge(request()->query(), ['sort' => 'marca', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="sort-link">
                                Marca
                                <span class="material-symbols-outlined sort-icon {{ request('sort') == 'marca' ? 'active' : '' }}">
                                    {{ request('sort') == 'marca' ? (request('direction') == 'asc' ? 'arrow_upward' : 'arrow_downward') : 'unfold_more' }}
                                </span>
                            </a>
                        </div>
                    </th>
                    <th>
                        <a href="{{ route('admin.productos.index', array_merge(request()->query(), ['sort' => 'cantidad', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="sort-link">
                            Stock
                            <span class="material-symbols-outlined sort-icon {{ request('sort') == 'cantidad' ? 'active' : '' }}">
                                {{ request('sort') == 'cantidad' ? (request('direction') == 'asc' ? 'arrow_upward' : 'arrow_downward') : 'unfold_more' }}
                            </span>
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.productos.index', array_merge(request()->query(), ['sort' => 'precio', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="sort-link">
                            Precio
                            <span class="material-symbols-outlined sort-icon {{ request('sort') == 'precio' ? 'active' : '' }}">
                                {{ request('sort') == 'precio' ? (request('direction') == 'asc' ? 'arrow_upward' : 'arrow_downward') : 'unfold_more' }}
                            </span>
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.productos.index', array_merge(request()->query(), ['sort' => 'estado', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="sort-link">
                            Estado
                            <span class="material-symbols-outlined sort-icon {{ request('sort') == 'estado' ? 'active' : '' }}">
                                {{ request('sort') == 'estado' ? (request('direction') == 'asc' ? 'arrow_upward' : 'arrow_downward') : 'unfold_more' }}
                            </span>
                        </a>
                    </th>
                    <th class="actions-cell">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                <tr>
                    <td>
                        <div class="product-cell">
                            <div class="product-img-wrapper">
                                @if($producto->imagen_url)
                                    <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}">
                                @else
                                    <span class="material-symbols-outlined" style="opacity: 0.3;">wine_bar</span>
                                @endif
                            </div>
                            <div class="product-name-info">
                                <span class="product-name">{{ $producto->nombre }}</span>
                                <span class="product-meta">
                                    {{ $producto->pais ?? 'N/A' }} • {{ $producto->contenido_ml ? $producto->contenido_ml . 'ml' : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="category-cell">
                            <span class="category-name">
                                @if($producto->categoria && $producto->categoria->padre)
                                    <small style="opacity: 0.5; font-size: 0.7rem; display: block;">{{ $producto->categoria->padre->nombre }}</small>
                                    {{ $producto->categoria->nombre }}
                                @else
                                    {{ $producto->categoria ? $producto->categoria->nombre : 'Sin Categoría' }}
                                @endif
                            </span>
                            <span class="brand-name-sm">{{ $producto->marca ? $producto->marca->nombre : 'Sin Marca' }}</span>
                        </div>
                    </td>
                    <td>
                        @if($producto->cantidad <= 10)
                            <span class="stock-count stock-low">{{ $producto->cantidad }} Unidades</span>
                        @else
                            <span class="stock-count stock-normal">{{ $producto->cantidad }} Unidades</span>
                        @endif
                    </td>
                    <td>
                        <span class="price-text">${{ number_format($producto->precio, 2) }}</span>
                    </td>
                    <td>
                        @if($producto->estado)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-error">Inactivo</span>
                        @endif
                    </td>
                    <td class="actions-cell">
                        <div class="actions-wrapper">
                            <a href="{{ route('admin.productos.edit', $producto->id_producto) }}" class="action-btn" title="Editar">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            
                            <a href="#modal-delete-{{ $producto->id_producto }}" class="action-btn delete" title="Eliminar">
                                <span class="material-symbols-outlined">delete</span>
                            </a>

                            <!-- Modal de Confirmación (Pure HTML/CSS) -->
                            <div id="modal-delete-{{ $producto->id_producto }}" class="modal-overlay">
                                <a href="#" class="modal-close-area"></a>
                                <div class="modal-content">
                                    <div class="modal-header-icon">
                                        <span class="material-symbols-outlined">warning</span>
                                    </div>
                                    <h2>¿Eliminar Producto?</h2>
                                    <p>Estás a punto de eliminar <strong>{{ $producto->nombre }}</strong> de la colección.</p>
                                    <div class="modal-warning">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">info</span>
                                        <span>Esta acción es irreversible. Se eliminarán permanentemente todos los datos técnicos y notas de cata asociados.</span>
                                    </div>
                                    <div class="modal-actions">
                                        <a href="#" class="btn-modal-cancel">Mantener en Cava</a>
                                        <form action="{{ route('admin.productos.destroy', $producto->id_producto) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-modal-confirm">Eliminar Permanentemente</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem; color: rgba(27, 29, 14, 0.4);">
                        No se encontraron productos que coincidan con los criterios.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="pagination-container">
        <div class="pagination-info">
            Mostrando <strong>{{ $productos->firstItem() ?? 0 }}</strong> a <strong>{{ $productos->lastItem() ?? 0 }}</strong> de <strong>{{ $productos->total() }}</strong> productos
        </div>
        <div class="pagination-controls">
            @if ($productos->onFirstPage())
                <span class="page-disabled page-icon">
                    <span class="material-symbols-outlined">chevron_left</span>
                </span>
            @else
                <a href="{{ $productos->previousPageUrl() }}" class="page-link page-icon">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
            @endif

            @foreach ($productos->getUrlRange(max(1, $productos->currentPage() - 2), min($productos->lastPage(), $productos->currentPage() + 2)) as $page => $url)
                @if ($page == $productos->currentPage())
                    <span class="page-current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                @endif
            @endforeach

            @if ($productos->hasMorePages())
                <a href="{{ $productos->nextPageUrl() }}" class="page-link page-icon">
                    <span class="material-symbols-outlined">chevron_right</span>
                </a>
            @else
                <span class="page-disabled page-icon">
                    <span class="material-symbols-outlined">chevron_right</span>
                </span>
            @endif
        </div>
    </div>
</div>
@endsection
