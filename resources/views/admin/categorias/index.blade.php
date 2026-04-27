@extends('layouts.admin')

@section('content')
<div class="index-view">
    <header class="index-header">
        <div class="header-info">
            <h1>Arquitectura de Colección</h1>
            <p>Gestiona las categorías editoriales que estructuran la cava digital.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.categorias.create', ['nivel' => 1]) }}" class="btn-create">
                <span class="material-symbols-outlined">add</span>
                <span>Nueva Categoría Principal</span>
            </a>
        </div>
    </header>

    <!-- Barra de Filtros -->
    <form action="{{ route('admin.categorias.index') }}" method="GET" class="filter-bar">
        <div class="filter-group" style="flex: 1;">
            <span class="material-symbols-outlined filter-icon">search</span>
            <input type="text" name="search" class="filter-input" placeholder="Buscar categorías..." value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn-filter">Filtrar</button>
        @if(request('search'))
            <a href="{{ route('admin.categorias.index') }}" class="btn-reset">Limpiar</a>
        @endif
    </form>

    <div class="table-wrapper">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>Estructura de Categoría</th>
                    <th>Nivel</th>
                    <th>Padre</th>
                    <th class="actions-cell">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categorias as $categoria)
                <tr class="{{ $categoria->nivel > 1 ? 'subcategory-row child-of-' . $categoria->nombre_padre : 'parent-row' }}" 
                    style="{{ $categoria->nivel > 1 ? 'display: none;' : '' }}"
                    id="row-{{ $categoria->id_categoria }}">
                    <td>
                        <div class="product-cell">
                            <div class="product-name-info" style="display: flex; align-items: center; gap: 10px;">
                                @if($categoria->nivel == 1)
                                    <button class="toggle-btn" onclick="toggleSubcategories({{ $categoria->id_categoria }})" id="btn-{{ $categoria->id_categoria }}">
                                        <span class="material-symbols-outlined">chevron_right</span>
                                    </button>
                                @endif
                                <div style="{{ $categoria->nivel > 1 ? 'padding-left: 40px;' : '' }}">
                                    <span class="product-name">
                                        @if($categoria->nivel > 1)
                                            <span style="opacity: 0.3; margin-right: 8px;">—</span>
                                        @endif
                                        {{ $categoria->nombre }}
                                    </span>
                                    <span class="product-meta">{{ Str::limit($categoria->descripcion, 50) }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $categoria->nivel == 1 ? 'badge-success' : 'badge-subcategory' }}">
                            {{ $categoria->nivel == 1 ? 'Principal' : 'Subnivel' }}
                        </span>
                    </td>
                    <td>
                        <span class="stock-count stock-normal">{{ $categoria->padre ? $categoria->padre->nombre : 'Raíz' }}</span>
                    </td>
                    <td class="actions-cell">
                        <div class="actions-wrapper">
                            @if($categoria->nivel == 1)
                                <a href="{{ route('admin.categorias.create', ['nivel' => 2, 'parent_id' => $categoria->id_categoria]) }}" class="action-btn" title="Agregar Subcategoría" style="color: var(--tertiary);">
                                    <span class="material-symbols-outlined">add_circle</span>
                                </a>
                            @endif

                            <a href="{{ route('admin.categorias.edit', $categoria->id_categoria) }}" class="action-btn" title="Editar">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            
                            <a href="#modal-delete-{{ $categoria->id_categoria }}" class="action-btn delete" title="Eliminar">
                                <span class="material-symbols-outlined">delete</span>
                            </a>

                            <!-- Modal Delete -->
                            <div id="modal-delete-{{ $categoria->id_categoria }}" class="modal-overlay">
                                <a href="#" class="modal-close-area"></a>
                                <div class="modal-content">
                                    <div class="modal-header-icon"><span class="material-symbols-outlined">warning</span></div>
                                    <h2>¿Eliminar Categoría?</h2>
                                    <p>Estás a punto de eliminar <strong>{{ $categoria->nombre }}</strong>.</p>
                                    <div class="modal-warning">
                                        <span class="material-symbols-outlined">info</span>
                                        <span>Esta acción puede afectar a los productos asociados. @if($categoria->nivel == 1) ¡También se eliminarán sus subcategorías! @endif</span>
                                    </div>
                                    <div class="modal-actions">
                                        <a href="#" class="btn-modal-cancel">Cancelar</a>
                                        <form action="{{ route('admin.categorias.destroy', $categoria->id_categoria) }}" method="POST">
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
                <tr><td colspan="4" style="text-align: center; padding: 3rem;">No se encontraron categorías.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    .toggle-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        transition: transform 0.3s;
        border-radius: 50%;
    }
    .toggle-btn:hover {
        background-color: var(--surface-container-high);
    }
    .toggle-btn.active {
        transform: rotate(90deg);
    }
    .subcategory-row {
        background-color: rgba(245, 245, 220, 0.3);
    }
    .parent-row {
        border-left: 4px solid transparent;
        transition: border-left 0.3s;
    }
    .parent-row:hover {
        border-left-color: var(--primary);
    }
</style>

<script>
    function toggleSubcategories(parentId) {
        const children = document.querySelectorAll('.child-of-' + parentId);
        const btn = document.getElementById('btn-' + parentId);
        
        children.forEach(child => {
            if (child.style.display === 'none') {
                child.style.display = 'table-row';
                child.style.animation = 'fadeIn 0.3s ease-out';
            } else {
                child.style.display = 'none';
            }
        });
        
        btn.classList.toggle('active');
    }

    @if(request('search'))
        // Si hay búsqueda, mostrar todo
        document.querySelectorAll('.subcategory-row').forEach(row => row.style.display = 'table-row');
        document.querySelectorAll('.toggle-btn').forEach(btn => btn.classList.add('active'));
    @endif
</script>
@endsection
