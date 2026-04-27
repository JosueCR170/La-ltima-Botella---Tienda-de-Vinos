@extends('layouts.admin')


@section('content')
<div class="create-view-wrapper">
    <form action="{{ route('admin.productos.store') }}" method="POST">
        @csrf
        
        <header class="header-section">
            <div class="header-text">
                <h1>Catalogar Nuevo Vino</h1>
                <p>Define la narrativa, especificaciones técnicas y el legado de una nueva adición a la cava digital.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.productos.index') }}" class="btn-discard">Descartar</a>
                <button type="submit" class="btn-save">Guardar Colección</button>
            </div>
        </header>

        <div class="main-grid">
            <div class="form-column">
                <!-- Section 1: Basic Information -->
                <section>
                    <div class="section-header">
                        <span class="section-num">01</span>
                        <h2>Información Básica</h2>
                    </div>
                    <div class="input-grid">
                        <div class="form-group">
                            <label for="nombre">Nombre del Vino</label>
                            <input type="text" name="nombre" id="nombre" placeholder="ej. Château Margaux" required value="{{ old('nombre') }}">
                        </div>
                        <div class="form-group">
                            <label for="anio_cosecha">Cosecha (Vintage)</label>
                            <input type="number" name="anio_cosecha" id="anio_cosecha" placeholder="2018" value="{{ old('anio_cosecha') }}">
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
                            <label for="region">Región / Terroir</label>
                            <input type="text" name="region" id="region" placeholder="Bordeaux" value="{{ old('region') }}">
                        </div>
                        <div class="form-group">
                            <label for="id_categoria">Categoría Editorial</label>
                            <select name="id_categoria" id="id_categoria" class="premium-select" required>
                                <option value="" disabled {{ old('id_categoria') ? '' : 'selected' }}>Seleccionar...</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id_categoria }}" {{ old('id_categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_marca">Casa / Bodega</label>
                            <select name="id_marca" id="id_marca" class="premium-select" required>
                                <option value="" disabled {{ old('id_marca') ? '' : 'selected' }}>Seleccionar...</option>
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id_marca }}" {{ old('id_marca') == $marca->id_marca ? 'selected' : '' }}>
                                        {{ $marca->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Section 2: Technical Details -->
                <section>
                    <div class="section-header">
                        <span class="section-num">02</span>
                        <h2>Detalles Técnicos</h2>
                    </div>
                    <div class="details-grid">
                        <div class="detail-card">
                            <label for="alcohol_porcentaje">Alcohol por Vol.</label>
                            <div class="value-wrapper">
                                <input type="number" step="0.1" name="alcohol_porcentaje" id="alcohol_porcentaje" placeholder="13.5" value="{{ old('alcohol_porcentaje') }}">
                                <span class="unit">%</span>
                            </div>
                        </div>
                        <div class="detail-card">
                            <label for="contenido_ml">Contenido</label>
                            <div class="value-wrapper">
                                <input type="number" name="contenido_ml" id="contenido_ml" placeholder="750" value="{{ old('contenido_ml') }}">
                                <span class="unit">ml</span>
                            </div>
                        </div>
                        <div class="detail-card">
                            <label>Estado Inicial</label>
                            <div class="status-toggle">
                                <label class="switch">
                                    <input type="checkbox" name="estado" value="1" {{ old('estado', '1') == '1' ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                                <span class="stock-unit">Activo</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 3: Sensory Narrative -->
                <section>
                    <div class="section-header">
                        <span class="section-num">03</span>
                        <h2>Nota del Sommelier</h2>
                    </div>
                    <div class="note-area">
                        <textarea name="descripcion" id="descripcion" rows="6" placeholder="Describe el carácter, bouquet y final de esta cosecha...">{{ old('descripcion') }}</textarea>
                        <div class="note-badge">Voz Editorial</div>
                    </div>
                </section>

                <!-- Section 4: Storage & Valuation -->
                <section>
                    <div class="section-header">
                        <span class="section-num">04</span>
                        <h2>Valoración y Stock</h2>
                    </div>
                    <div class="storage-grid">
                        <div class="valuation-item">
                            <label for="precio">Precio Unitario</label>
                            <div class="valuation-input-wrapper">
                                <span class="currency-symbol">$</span>
                                <input type="number" step="0.01" name="precio" id="precio" class="large-input" placeholder="0.00" required value="{{ old('precio') }}">
                            </div>
                        </div>
                        <div class="valuation-item">
                            <label for="cantidad">Cantidad en Cava</label>
                            <div class="valuation-input-wrapper">
                                <input type="number" name="cantidad" id="cantidad" class="large-input" placeholder="0" required value="{{ old('cantidad', 0) }}">
                                <span class="stock-unit">Botellas</span>
                            </div>
                        </div>
                        <div class="valuation-item">
                            <label for="descuento">Descuento (%)</label>
                            <div class="valuation-input-wrapper">
                                <input type="number" step="1" name="descuento" id="descuento" class="large-input" placeholder="0" value="{{ old('descuento', 0) }}">
                                <span class="stock-unit">% OFF</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="visual-column">
                <div class="section-header">
                    <span class="section-num">05</span>
                    <h2>Identidad Visual</h2>
                </div>
                <div class="upload-box {{ old('imagen_url') ? 'has-image' : '' }}" id="image-container">
                    @if(old('imagen_url'))
                        <img src="{{ old('imagen_url') }}" class="preview-img active" id="product-preview" alt="Preview">
                    @else
                        <img src="" class="preview-img" id="product-preview" alt="Preview">
                    @endif
                    <img src="{{ asset('img/premium_wine_bottle_preview.png') }}" class="preview-bg" alt="Preview Background">
                    <div class="upload-content">
                        <div class="upload-icon-circle">
                            <span class="material-symbols-outlined">image_search</span>
                        </div>
                        <h3>Estética de la Botella</h3>
                        <p>Sube una fotografía en alta resolución que capture la esencia de la etiqueta.</p>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 24px;">
                    <label for="imagen_url">URL de la Imagen Editorial</label>
                    <input type="text" name="imagen_url" id="imagen_url" placeholder="https://ejemplo.com/imagen.jpg" class="url-input" value="{{ old('imagen_url') }}">
                </div>

                <script>
                    document.getElementById('imagen_url').addEventListener('input', function() {
                        const url = this.value;
                        const preview = document.getElementById('product-preview');
                        const container = document.getElementById('image-container');
                        if (url) {
                            preview.src = url;
                            preview.classList.add('active');
                            container.classList.add('has-image');
                        } else {
                            preview.src = '';
                            preview.classList.remove('active');
                            container.classList.remove('has-image');
                        }
                    });
                </script>

                <div class="curator-tip">
                    <div class="tip-header">
                        <span class="material-symbols-outlined" style="font-size: 14px;">auto_awesome</span>
                        Tip del Curador
                    </div>
                    <p class="tip-text">
                        "Al catalogar vinos de alta gama, asegúrese de resaltar la región y la cosecha, ya que son factores críticos para la valoración del coleccionista."
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
