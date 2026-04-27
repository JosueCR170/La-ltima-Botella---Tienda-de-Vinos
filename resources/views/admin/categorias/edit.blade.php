@extends('layouts.admin')

@section('content')
<div class="create-view-wrapper">
    <form action="{{ route('admin.categorias.update', $categoria->id_categoria) }}" method="POST">
        @csrf
        @method('PUT')
        
        <header class="header-section">
            <div class="header-text">
                <h1>Editar Categoría Editorial</h1>
                <p>Ajusta la definición y posición jerárquica de esta categoría.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.categorias.index') }}" class="btn-discard">Descartar</a>
                <button type="submit" class="btn-save">Actualizar Categoría</button>
            </div>
        </header>

        <div class="main-grid">
            <div class="form-column">
                <section>
                    <div class="section-header">
                        <span class="section-num">01</span>
                        <h2>Identidad de la Categoría</h2>
                    </div>
                    <div class="input-grid">
                        <div class="form-group">
                            <label for="nombre">Nombre de la Categoría</label>
                            <input type="text" name="nombre" id="nombre" placeholder="ej. Tintos de Guarda" required value="{{ old('nombre', $categoria->nombre) }}">
                        </div>
                        <div class="form-group">
                            <label for="nivel">Nivel Jerárquico</label>
                            <select name="nivel_display" id="nivel_display" class="premium-select" required disabled>
                                <option value="1" {{ old('nivel', $categoria->nivel) == 1 ? 'selected' : '' }}>Nivel 1 (Principal)</option>
                                <option value="2" {{ old('nivel', $categoria->nivel) == 2 ? 'selected' : '' }}>Nivel 2 (Subcategoría)</option>
                            </select>
                            <input type="hidden" name="nivel" value="{{ $categoria->nivel }}">
                        </div>
                        <div class="form-group">
                            <label for="nombre_padre">Categoría Padre (Si aplica)</label>
                            @if($categoria->nivel == 1)
                                <select name="nombre_padre_display" id="nombre_padre_display" class="premium-select" disabled>
                                    <option value="">Ninguna (Raíz)</option>
                                </select>
                                <input type="hidden" name="nombre_padre" value="">
                            @else
                                <select name="nombre_padre" id="nombre_padre" class="premium-select" required>
                                    <option value="" disabled>Seleccione una categoría superior</option>
                                    @foreach($categoriasPadre as $padre)
                                        @if($padre->id_categoria != $categoria->id_categoria)
                                            <option value="{{ $padre->id_categoria }}" {{ old('nombre_padre', $categoria->nombre_padre) == $padre->id_categoria ? 'selected' : '' }}>
                                                {{ $padre->nombre }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </section>

                <section>
                    <div class="section-header">
                        <span class="section-num">02</span>
                        <h2>Descripción Editorial</h2>
                    </div>
                    <div class="note-area">
                        <textarea name="descripcion" id="descripcion" rows="6" placeholder="Define el propósito y carácter de esta categoría...">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                        <div class="note-badge">Voz de Cava</div>
                    </div>
                </section>
            </div>

            <div class="visual-column">
                <div class="curator-tip">
                    <div class="tip-header">
                        <span class="material-symbols-outlined" style="font-size: 14px;">auto_awesome</span>
                        Estructura de Bodega
                    </div>
                    <p class="tip-text">
                        "Al editar, considere que los cambios en el nombre pueden afectar la navegación del usuario si ya está familiarizado con la estructura actual."
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
