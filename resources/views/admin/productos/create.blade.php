@extends('layouts.admin')

@section('content')
    <h1>Nuevo Producto</h1>

    <div class="admin-form">
        <form action="{{ route('admin.productos.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required value="{{ old('nombre') }}">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4">{{ old('descripcion') }}</textarea>
            </div>

            <div style="display: flex; gap: 1rem;">
                <div class="form-group" style="flex: 1;">
                    <label for="id_categoria">Categoría</label>
                    <select name="id_categoria" id="id_categoria" class="form-control" required>
                        <option value="">Seleccione...</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="flex: 1;">
                    <label for="id_marca">Marca</label>
                    <select name="id_marca" id="id_marca" class="form-control" required>
                        <option value="">Seleccione...</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id_marca }}">{{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 1rem;">
                <div class="form-group" style="flex: 1;">
                    <label for="precio">Precio (CRC)</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="form-control" required value="{{ old('precio') }}">
                </div>

                <div class="form-group" style="flex: 1;">
                    <label for="cantidad">Stock (Cantidad)</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" required value="{{ old('cantidad', 0) }}">
                </div>
            </div>

            <div class="form-group">
                <label for="imagen_url">URL de Imagen</label>
                <input type="url" name="imagen_url" id="imagen_url" class="form-control" value="{{ old('imagen_url') }}">
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="estado" value="1" checked> Producto Activo
                </label>
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">Guardar Producto</button>
                <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
