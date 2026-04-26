<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Variedad;
use App\Models\Producto;
use Spatie\SimpleExcel\SimpleExcelReader;

class ExcelDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('EJEMPLO/Datos CSV.xlsx');

        if (!file_exists($path)) {
            $this->command->error("Archivo no encontrado: $path");
            return;
        }

        $rows = SimpleExcelReader::create($path)->getRows();

        foreach ($rows as $row) {
            // 1. Categoria
            $categoria = Categoria::firstOrCreate(
                ['nombre' => $row['Categoria']],
                ['descripcion' => $row['Subcategoria'] ?? null]
            );

            // 2. Marca
            $marca = Marca::firstOrCreate(
                ['nombre' => $row['Marca']]
            );

            // 3. Producto
            $producto = Producto::create([
                'nombre' => $row['Nombre'],
                'descripcion' => $row['Descripcion'],
                'cantidad' => $row['Cantidad'],
                'id_categoria' => $categoria->id_categoria,
                'id_marca' => $marca->id_marca,
                'pais' => $row['Pais'],
                'region' => $row['Region'],
                'precio' => $row['Precio (USD)'],
                'contenido_ml' => $row['Contenido (ml)'],
                'anio_cosecha' => $row['Anio Cosecha'],
                'alcohol_porcentaje' => $row['Alcohol (%)'],
                'imagen_url' => $row['Imagen'],
                'descuento' => $row['Descuento'] ?? 0,
                'estado' => ($row['Estado'] === 'activo' || $row['Estado'] === 1)
            ]);

            // 4. Variedades
            $cepas = explode(' / ', $row['Cepa / Variedad']);
            foreach ($cepas as $cepaNombre) {
                $cepaNombre = trim($cepaNombre);
                if (!empty($cepaNombre)) {
                    $variedad = Variedad::firstOrCreate(
                        ['nombre' => $cepaNombre]
                    );
                    $producto->variedades()->attach($variedad->id_variedad);
                }
            }
        }

        $this->command->info("Datos de Excel cargados exitosamente.");
    }
}
