@extends('layouts.admin')

@section('content')
<div class="create-view-wrapper">
    <form action="{{ route('admin.variedades.store') }}" method="POST">
        @csrf
        
        <header class="header-section">
            <div class="header-text">
                <h1>Nueva Variedad de Uva</h1>
                <p>Define una nueva cepa para enriquecer el perfil sensorial de los vinos catalogados.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.variedades.index') }}" class="btn-discard">Descartar</a>
                <button type="submit" class="btn-save">Guardar Variedad</button>
            </div>
        </header>

        <div class="main-grid">
            <div class="form-column">
                <section>
                    <div class="section-header">
                        <span class="section-num">01</span>
                        <h2>Perfil de la Variedad</h2>
                    </div>
                    <div class="input-grid">
                        <div class="form-group">
                            <label for="nombre">Nombre de la Variedad</label>
                            <input type="text" name="nombre" id="nombre" placeholder="ej. Cabernet Sauvignon" required value="{{ old('nombre') }}">
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo de Uva</label>
                            <select name="tipo" id="tipo" class="premium-select" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="Tinta" {{ old('tipo') == 'Tinta' ? 'selected' : '' }}>Tinta</option>
                                <option value="Blanca" {{ old('tipo') == 'Blanca' ? 'selected' : '' }}>Blanca</option>
                                <option value="Aromatica" {{ old('tipo') == 'Aromatica' ? 'selected' : '' }}>Aromatica</option>
                            </select>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="section-header">
                        <span class="section-num">02</span>
                        <h2>Notas de Cepa</h2>
                    </div>
                    <div class="note-area">
                        <textarea name="descripcion" id="descripcion" rows="6" placeholder="Describe las características típicas, aromas y sabores de esta variedad...">{{ old('descripcion') }}</textarea>
                        <div class="note-badge">Voz de Sommelier</div>
                    </div>
                </section>
            </div>

            <div class="visual-column">
                <div class="curator-tip">
                    <div class="tip-header">
                        <span class="material-symbols-outlined" style="font-size: 14px;">auto_awesome</span>
                        Identidad del Terroir
                    </div>
                    <p class="tip-text">
                        "Cada variedad aporta una estructura única al vino. Describir su perfil aromático ayuda al coleccionista a predecir la experiencia de cata."
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
