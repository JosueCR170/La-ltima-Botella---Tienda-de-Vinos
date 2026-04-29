<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | The Editorial Cellar</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    darkMode: "class",
    theme: {
      extend: {
        colors: {
          "primary": "#2a0002",
          "on-surface": "#1b1d0e",
          "background": "#fbfbe2",
        },
        fontFamily: {
          "headline": ["Noto Serif"],
          "body": ["Manrope"],
        }
      }
    }
  }
</script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    @stack('styles')
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <span class="brand-name">La Última Botella</span>
                <div class="admin-profile">
                    <div class="profile-avatar">
                        <span class="material-symbols-outlined">person</span>
                    </div>
                    <div class="profile-info">
                        <span class="profile-name">Admin</span>
                        <span class="profile-role">Panel de Control</span>
                    </div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.productos.index') }}" class="nav-item {{ request()->routeIs('admin.productos.*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">wine_bar</span>
                    <span>Productos</span>
                </a>
                <a href="{{ route('admin.categorias.index') }}" class="nav-item {{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">category</span>
                    <span>Categorías</span>
                </a>
                <a href="{{ route('admin.marcas.index') }}" class="nav-item {{ request()->routeIs('admin.marcas.*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">sell</span>
                    <span>Marcas</span>
                </a>
                <a href="{{ route('admin.variedades.index') }}" class="nav-item {{ request()->routeIs('admin.variedades.*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">grass</span>
                    <span>Variedades</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="{{ url('/') }}" class="btn-store-link">
                    Volver a la Tienda
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @if(session('success'))
                @php
                    $msg = session('success');
                    if (str_contains($msg, 'cread')) {
                        $alertTitle = 'Creación Exitosa';
                    } elseif (str_contains($msg, 'eliminad')) {
                        $alertTitle = 'Eliminación Exitosa';
                    } else {
                        $alertTitle = 'Actualización Exitosa';
                    }
                @endphp
                <div class="alert-premium success">
                    <span class="material-symbols-outlined alert-icon">check_circle</span>
                    <div class="alert-content">
                        <span class="alert-title">{{ $alertTitle }}</span>
                        <span class="alert-message">{{ $msg }}</span>
                    </div>
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert-premium error">
                    <span class="material-symbols-outlined alert-icon">error</span>
                    <div class="alert-content">
                        <span class="alert-title">Atención Sommelier</span>
                        <ul class="alert-message">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
            @endif

            <div class="content-container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
