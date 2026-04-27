@extends('layouts.admin')

@section('content')
<div class="index-view">
    <header class="index-header">
        <div class="header-info">
            <h1>Casas y Bodegas</h1>
            <p>Gestiona los productores y casas vinícolas que dan vida a la colección.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.marcas.create') }}" class="btn-create">
                <span class="material-symbols-outlined">add</span>
                <span>Nueva Bodega</span>
            </a>
        </div>
    </header>

    <!-- Barra de Filtros -->
    <form action="{{ route('admin.marcas.index') }}" method="GET" class="filter-bar">
        <div class="filter-group" style="flex: 1;">
            <span class="material-symbols-outlined filter-icon">search</span>
            <input type="text" name="search" class="filter-input" placeholder="Buscar por nombre o país..." value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn-filter">Filtrar</button>
        @if(request('search'))
            <a href="{{ route('admin.marcas.index') }}" class="btn-reset">Limpiar</a>
        @endif
    </form>

    <div class="table-wrapper">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>
                        <a href="{{ route('admin.marcas.index', array_merge(request()->query(), ['sort' => 'nombre', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="sort-link">
                            Bodega
                            <span class="material-symbols-outlined sort-icon {{ request('sort') == 'nombre' ? 'active' : '' }}">
                                {{ request('sort') == 'nombre' ? (request('direction') == 'asc' ? 'arrow_upward' : 'arrow_downward') : 'unfold_more' }}
                            </span>
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.marcas.index', array_merge(request()->query(), ['sort' => 'pais', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="sort-link">
                            Origen
                            <span class="material-symbols-outlined sort-icon {{ request('sort') == 'pais' ? 'active' : '' }}">
                                {{ request('sort') == 'pais' ? (request('direction') == 'asc' ? 'arrow_upward' : 'arrow_downward') : 'unfold_more' }}
                            </span>
                        </a>
                    </th>
                    <th>Sitio Web</th>
                    <th class="actions-cell">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($marcas as $marca)
                <tr>
                    <td>
                        <div class="product-cell">
                            <div class="product-name-info">
                                <span class="product-name">{{ $marca->nombre }}</span>
                                <span class="product-meta">{{ Str::limit($marca->descripcion, 50) }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="stock-count stock-normal">{{ $marca->pais }}</span>
                    </td>
                    <td>
                        @if($marca->sitio_web)
                            <a href="{{ $marca->sitio_web }}" target="_blank" class="action-btn" style="padding: 0; color: var(--primary);">
                                <span class="material-symbols-outlined">language</span>
                            </a>
                        @else
                            <span style="opacity: 0.3;">N/A</span>
                        @endif
                    </td>
                    <td class="actions-cell">
                        <div class="actions-wrapper">
                            <a href="{{ route('admin.marcas.edit', $marca->id_marca) }}" class="action-btn" title="Editar">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            
                            <a href="#modal-delete-{{ $marca->id_marca }}" class="action-btn delete" title="Eliminar">
                                <span class="material-symbols-outlined">delete</span>
                            </a>

                            <!-- Modal Delete -->
                            <div id="modal-delete-{{ $marca->id_marca }}" class="modal-overlay">
                                <a href="#" class="modal-close-area"></a>
                                <div class="modal-content">
                                    <div class="modal-header-icon"><span class="material-symbols-outlined">warning</span></div>
                                    <h2>¿Eliminar Bodega?</h2>
                                    <p>Estás a punto de eliminar <strong>{{ $marca->nombre }}</strong>.</p>
                                    <div class="modal-warning">
                                        <span class="material-symbols-outlined">info</span>
                                        <span>Todos los productos asociados a esta casa quedarán sin marca asignada.</span>
                                    </div>
                                    <div class="modal-actions">
                                        <a href="#" class="btn-modal-cancel">Cancelar</a>
                                        <form action="{{ route('admin.marcas.destroy', $marca->id_marca) }}" method="POST">
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
                <tr><td colspan="4" style="text-align: center; padding: 3rem;">No se encontraron bodegas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {{ $marcas->links() }}
    </div>
</div>
@endsection
