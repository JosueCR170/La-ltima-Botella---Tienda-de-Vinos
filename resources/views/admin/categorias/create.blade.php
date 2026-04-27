@extends('layouts.admin')

@section('content')
<div class="create-view-wrapper">
    <form action="{{ route('admin.categorias.store') }}" method="POST">
        @csrf
        
        <header class="header-section">
            <div class="header-text">
                <h1>Nueva Categoría Editorial</h1>
                <p>Define una nueva rama en la estructura jerárquica de la colección.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.categorias.index') }}" class="btn-discard">Descartar</a>
                <button type="submit" class="btn-save">Guardar Categoría</button>
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
                            <input type="text" name="nombre" id="nombre" placeholder="ej. Tintos de Guarda" required value="{{ old('nombre') }}">
                        </div>
                        <div class="form-group">
                            <label for="nivel">Nivel Jerárquico</label>
                            <select name="nivel" id="nivel" required>
                                <option value="1" {{ old('nivel', $request->get('nivel')) == 1 ? 'selected' : '' }}>Nivel 1 (Principal)</option>
                                <option value="2" {{ old('nivel', $request->get('nivel')) == 2 ? 'selected' : '' }}>Nivel 2 (Subcategoría)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre_padre">Categoría Padre (Si aplica)</label>
                            <select name="nombre_padre" id="nombre_padre">
                                <option value="">Ninguna (Raíz)</option>
                                @foreach($categoriasPadre as $padre)
                                    <option value="{{ $padre->id_categoria }}" {{ old('nombre_padre', $request->get('parent_id')) == $padre->id_categoria ? 'selected' : '' }}>
                                        {{ $padre->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="section-header">
                        <span class="section-num">02</span>
                        <h2>Descripción Editorial</h2>
                    </div>
                    <div class="note-area">
                        <textarea name="descripcion" id="descripcion" rows="6" placeholder="Define el propósito y carácter de esta categoría...">{{ old('descripcion') }}</textarea>
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
                        "Una buena categorización permite a los coleccionistas navegar por la cava con mayor fluidez. Mantenga los nombres concisos pero descriptivos."
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
