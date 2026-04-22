<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - The Editorial Cellar</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <h2>🍷 Panel Admin</h2>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}"><span class="material-symbols-outlined">dashboard</span> Dashboard</a></li>
                <li><a href="{{ route('admin.productos.index') }}"><span class="material-symbols-outlined">wine_bar</span> Productos</a></li>
                <li><a href="{{ route('admin.categorias.index') }}"><span class="material-symbols-outlined">category</span> Categorías</a></li>
                <li><a href="{{ route('admin.marcas.index') }}"><span class="material-symbols-outlined">sell</span> Marcas</a></li>
                <li><a href="{{ route('admin.variedades.index') }}"><span class="material-symbols-outlined">grass</span> Variedades</a></li>
                <li><a href="{{ url('/') }}"><span class="material-symbols-outlined">storefront</span> Volver a la Tienda</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
