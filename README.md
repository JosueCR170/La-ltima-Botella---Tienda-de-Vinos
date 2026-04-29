# La Última Botella - Tienda de Vinos

**🔗 URL de Hosting:** [https://la-ltima-botella-tienda-de-vinos.onrender.com]

---
Desarrolladores:
- Josue Solórzano Ordóñez
- Daniel González Picado

## Descripción del Proyecto
"La Última Botella" es una aplicación web de comercio electrónico (E-commerce) desarrollada en Laravel para la gestión y venta de vinos, destilados y cervezas. El sistema permite administrar productos, categorías, marcas, variedades (cepas) y carritos de compras.

## Estructura del Proyecto
Este proyecto sigue el patrón de diseño **MVC (Modelo-Vista-Controlador)** que es el estándar del framework Laravel. A continuación, se detalla la estructura principal:

### 1. Modelos (`app/Models/`)
Representan las entidades de la base de datos y sus relaciones utilizando Eloquent ORM.
- **`Producto`**: Maneja la información principal de los artículos en venta (precio, descripción, alcohol %, etc.).
- **`Categoria`**: Define la jerarquía de categorías y subcategorías (ej. Vinos -> Tinto) mediante recursividad.
- **`Marca`**: Representa a la bodega, viñedo o fabricante.
- **`Variedad`**: Define el tipo o cepa (ej. Malbec, Chardonnay) y se asocia de muchos-a-muchos con los productos.
- **`Carrito`**: Maneja los productos agregados para la compra.

### 2. Controladores (`app/Http/Controllers/`)
Gestionan la lógica de negocio y sirven como intermediarios entre los Modelos y las Vistas. Aquí se procesan las solicitudes del usuario (ver catálogo, agregar al carrito, gestionar el panel de administrador).

### 3. Rutas (`routes/web.php`)
Definen las URLs de acceso a la aplicación y las vinculan con los controladores correspondientes. El proyecto cuenta con las siguientes rutas principales:

**Tienda y Frontend**
- `GET /` : Página de inicio (`home`).
- `GET /catalogo` : Muestra el catálogo de productos.
- `GET /about` : Página acerca de nosotros.
- `GET /producto/{id}` : Detalles de un producto en particular.

**Carrito de Compras**
- `GET /carrito` : Muestra el contenido del carrito.
- `POST /carrito/agregar/{id}` : Añade un producto al carrito.
- `POST /carrito/actualizar/{id}` : Actualiza la cantidad de un producto.
- `POST /carrito/eliminar/{id}` : Remueve un producto del carrito.

**Checkout (Pagos)**
- `GET /checkout` : Pantalla de resumen antes del pago.
- `POST /checkout/pagar` : Procesa la orden de pago.

**Panel de Administración (Prefijo `/admin`)**
- `GET /admin/` : Dashboard principal de administración.
- `Rutas Resource` (incluyen index, create, store, edit, update, destroy):
  - `/admin/categorias` : Gestión de categorías.
  - `/admin/marcas` : Gestión de marcas.
  - `/admin/variedades` : Gestión de variedades/cepas.
  - `/admin/productos` : Gestión del inventario de productos.

### 4. Vistas (`resources/views/`)
Contienen las plantillas de Blade que conforman la interfaz gráfica del usuario. Están estructuradas para separar el layout público (tienda) del panel de administración (admin).

### 5. Base de Datos (`database/`)
- **Migraciones (`database/migrations/`)**: Archivos que definen y construyen la estructura de las tablas relacionales de manera programática.
- **Seeders (`database/seeders/`)**: Scripts para poblar la base de datos con información inicial. Destaca el `StaticDataSeeder` que pre-carga una base completa de productos, marcas, categorías fijas y variedades perfectamente relacionadas.

## Instalación y Uso Local

1. Clona este repositorio o asegúrate de estar en el directorio del proyecto.
2. Abre una terminal y descarga las dependencias:
   ```bash
   composer install
   npm install
   ```
3. Copia el archivo `.env.example` a `.env` y configura tu conexión a la base de datos:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Ejecuta las migraciones y pobla la base de datos con los seeders iniciales:
   ```bash
   php artisan migrate:fresh --seed
   ```
5. Inicia el servidor local de desarrollo:
   ```bash
   php artisan serve
   ```