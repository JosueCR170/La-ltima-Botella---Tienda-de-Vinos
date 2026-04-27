@extends('layouts.admin')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pais').select2({
            placeholder: "Seleccionar país...",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush

@section('content')
<div class="create-view-wrapper">
    <form action="{{ route('admin.marcas.update', $marca->id_marca) }}" method="POST">
        @csrf
        @method('PUT')
        
        <header class="header-section">
            <div class="header-text">
                <h1>Editar Casa Vinícola</h1>
                <p>Actualiza la información y el legado de esta bodega en el catálogo.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.marcas.index') }}" class="btn-discard">Descartar</a>
                <button type="submit" class="btn-save">Actualizar Bodega</button>
            </div>
        </header>

        <div class="main-grid">
            <div class="form-column">
                <section>
                    <div class="section-header">
                        <span class="section-num">01</span>
                        <h2>Identidad de la Casa</h2>
                    </div>
                    <div class="input-grid">
                        <div class="form-group">
                            <label for="nombre">Nombre de la Bodega</label>
                            <input type="text" name="nombre" id="nombre" placeholder="ej. Vega Sicilia" required value="{{ old('nombre', $marca->nombre) }}">
                        </div>
                        <div class="form-group">
                            <label for="pais">País de Origen</label>
                            <select name="pais" id="pais" required>
                                <option value="" disabled>Seleccionar...</option>
                                @foreach($paises as $code => $nombre)
                                    <option value="{{ $nombre }}" {{ old('pais', $marca->pais) == $nombre ? 'selected' : '' }}>{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sitio_web">Sitio Web Oficial</label>
                            <input type="url" name="sitio_web" id="sitio_web" placeholder="https://www.bodega.com" value="{{ old('sitio_web', $marca->sitio_web) }}">
                        </div>
                    </div>
                </section>

                <section>
                    <div class="section-header">
                        <span class="section-num">02</span>
                        <h2>Historia y Legado</h2>
                    </div>
                    <div class="note-area">
                        <textarea name="descripcion" id="descripcion" rows="6" placeholder="Cuéntanos la historia de esta bodega, sus métodos y filosofía...">{{ old('descripcion', $marca->descripcion) }}</textarea>
                        <div class="note-badge">Voz Editorial</div>
                    </div>
                </section>
            </div>

            <div class="visual-column">
                <div class="curator-tip">
                    <div class="tip-header">
                        <span class="material-symbols-outlined" style="font-size: 14px;">auto_awesome</span>
                        Prestigio de Marca
                    </div>
                    <p class="tip-text">
                        "Mantener la información actualizada, especialmente los sitios web oficiales, genera confianza en los coleccionistas más detallistas."
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
