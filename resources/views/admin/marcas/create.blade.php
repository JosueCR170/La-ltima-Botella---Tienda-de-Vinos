@extends('layouts.admin')


@section('content')
<div class="create-view-wrapper">
    <form action="{{ route('admin.marcas.store') }}" method="POST">
        @csrf
        
        <header class="header-section">
            <div class="header-text">
                <h1>Nueva Casa Vinícola</h1>
                <p>Registra una nueva bodega para catalogar sus creaciones en la tienda.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.marcas.index') }}" class="btn-discard">Descartar</a>
                <button type="submit" class="btn-save">Guardar Bodega</button>
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
                            <input type="text" name="nombre" id="nombre" placeholder="ej. Vega Sicilia" required value="{{ old('nombre') }}">
                        </div>
                        <div class="form-group">
                            <label for="pais">País de Origen</label>
                            <input list="paises-list" name="pais" id="pais" class="premium-datalist-input" placeholder="Buscar país..." value="{{ old('pais') }}">
                            <datalist id="paises-list">
                                @foreach($paises as $code => $nombre)
                                    <option value="{{ $nombre }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="sitio_web">Sitio Web Oficial</label>
                            <input type="url" name="sitio_web" id="sitio_web" placeholder="https://www.bodega.com" value="{{ old('sitio_web') }}">
                        </div>
                    </div>
                </section>

                <section>
                    <div class="section-header">
                        <span class="section-num">02</span>
                        <h2>Historia y Legado</h2>
                    </div>
                    <div class="note-area">
                        <textarea name="descripcion" id="descripcion" rows="6" placeholder="Cuéntanos la historia de esta bodega, sus métodos y filosofía...">{{ old('descripcion') }}</textarea>
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
                        "La historia de la bodega es tan importante como el vino mismo. Resalte los años de tradición o las innovaciones que los hacen únicos."
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
