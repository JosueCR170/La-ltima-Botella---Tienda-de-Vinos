<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Variedad;
use App\Models\Producto;

class StaticDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "Nombre" => "Achaval Ferrer Quimera",
                "Descripcion" => "Blend de Malbec y Cabernet Sauvignon, cereza negra, tabaco y taninos sedosos",
                "Cantidad" => 100,
                "Categoria" => "Vinos",
                "Subcategoria" => "Tinto",
                "Marca" => "Achaval Ferrer",
                "Pais" => "Argentina",
                "Region" => "Mendoza",
                "Cepa / Variedad" => "Malbec / Cabernet Sauvignon",
                "Anio Cosecha" => 2021,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 14,
                "Precio (USD)" => 38.5,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Achaval_Ferrer_Quimera-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Catena Zapata Adrianna Vineyard Malbec",
                "Descripcion" => "Vino tinto iconico, notas de mora, violetas y especias con final largo",
                "Cantidad" => 50,
                "Categoria" => "Vinos",
                "Subcategoria" => "Tinto",
                "Marca" => "Catena Zapata",
                "Pais" => "Argentina",
                "Region" => "Mendoza",
                "Cepa / Variedad" => "Malbec",
                "Anio Cosecha" => 2020,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 14.5,
                "Precio (USD)" => 89.99,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Catena_Zapata_Adrianna_Vineyard_Malbec-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Catena Zapata White Bones Chardonnay",
                "Descripcion" => "Chardonnay de gran altitud, mineralidad y citricos con barrica elegante",
                "Cantidad" => 100,
                "Categoria" => "Vinos",
                "Subcategoria" => "Blanco",
                "Marca" => "Catena Zapata",
                "Pais" => "Argentina",
                "Region" => "Mendoza",
                "Cepa / Variedad" => "Chardonnay",
                "Anio Cosecha" => 2022,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 13.5,
                "Precio (USD)" => 42,
                "Descuento" => 5,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Catena_Zapata_White_Bones_Chardonnay-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Chateau Mouton Rothschild",
                "Descripcion" => "Gran vino de Burdeos, cassis, cedro y tierra humeda, muy largo",
                "Cantidad" => 100,
                "Categoria" => "Vinos",
                "Subcategoria" => "Tinto",
                "Marca" => "Chateau Mouton Rothschild",
                "Pais" => "Francia",
                "Region" => "Pauillac",
                "Cepa / Variedad" => "Cabernet Sauvignon / Merlot",
                "Anio Cosecha" => 2018,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 13,
                "Precio (USD)" => 520,
                "Descuento" => 5,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/Chateau%20Mouton%20Rothschild.jpg",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Cloudy Bay Sauvignon Blanc",
                "Descripcion" => "Referencia mundial de NZ: maracuya, pomelo y hierba fresca intensa",
                "Cantidad" => 80,
                "Categoria" => "Vinos",
                "Subcategoria" => "Blanco",
                "Marca" => "Cloudy Bay",
                "Pais" => "Nueva Zelanda",
                "Region" => "Marlborough",
                "Cepa / Variedad" => "Sauvignon Blanc",
                "Anio Cosecha" => 2023,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 13.5,
                "Precio (USD)" => 32.99,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Cloudy_Bay_Sauvignon_Blanc-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Concha y Toro Amelia Chardonnay",
                "Descripcion" => "Chardonnay premium, mantequilla, durazno y vainilla con acidez fresca",
                "Cantidad" => 50,
                "Categoria" => "Vinos",
                "Subcategoria" => "Blanco",
                "Marca" => "Concha y Toro",
                "Pais" => "Chile",
                "Region" => "Valle de Casablanca",
                "Cepa / Variedad" => "Chardonnay",
                "Anio Cosecha" => 2022,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 13.5,
                "Precio (USD)" => 28.5,
                "Descuento" => 5,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Concha_y_Toro_Amelia_Chardonnay-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Concha y Toro Don Melchor Cabernet Sauvignon",
                "Descripcion" => "Vino emblematico chileno, moras negras, cedro y tabaco, taninos firmes",
                "Cantidad" => 40,
                "Categoria" => "Vinos",
                "Subcategoria" => "Tinto",
                "Marca" => "Concha y Toro",
                "Pais" => "Chile",
                "Region" => "Valle del Maipo",
                "Cepa / Variedad" => "Cabernet Sauvignon",
                "Anio Cosecha" => 2020,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 14,
                "Precio (USD)" => 75,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Concha_y_Toro_Don_Melchor_Cabernet_Sauvignon-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Don Julio Blanco Tequila",
                "Descripcion" => "Tequila 100% agave azul, citricos y ligero toque a pimienta blanca",
                "Cantidad" => 120,
                "Categoria" => "Destilados",
                "Subcategoria" => "Tequila",
                "Marca" => "Don Julio",
                "Pais" => "Mexico",
                "Region" => "Jalisco / Los Altos",
                "Cepa / Variedad" => "Agave Azul",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 40,
                "Precio (USD)" => 49.99,
                "Descuento" => 20,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Don_Julio_Blanco_Tequila-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Familia Zuccardi Blanc de Blancs",
                "Descripcion" => "Vino blanco de guarda, pera y almendras con crianza en altura",
                "Cantidad" => 80,
                "Categoria" => "Vinos",
                "Subcategoria" => "Blanco",
                "Marca" => "Zuccardi",
                "Pais" => "Argentina",
                "Region" => "Valle de Uco",
                "Cepa / Variedad" => "Torrontes / Chardonnay",
                "Anio Cosecha" => 2022,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 13,
                "Precio (USD)" => 27,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Familia_Zuccardi_Blanc_de_Blancs-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Flor de Cana 12 anos",
                "Descripcion" => "Ron premium sin azucar anadida, vainilla, caramelo y frutos secos",
                "Cantidad" => 0,
                "Categoria" => "Destilados",
                "Subcategoria" => "Ron",
                "Marca" => "Flor de Cana",
                "Pais" => "Nicaragua",
                "Region" => "Chichigalpa",
                "Cepa / Variedad" => "Ron anejo",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 40,
                "Precio (USD)" => 29.99,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Flor_de_Cana_12_anos-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Freixenet Cordon Negro Brut",
                "Descripcion" => "Cava espanol iconico, burbujas finas, manzana verde y tostado suave",
                "Cantidad" => 70,
                "Categoria" => "Vinos",
                "Subcategoria" => "Espumante / Champagne",
                "Marca" => "Freixenet",
                "Pais" => "Espana",
                "Region" => "Cava / Penedes",
                "Cepa / Variedad" => "Macabeo / Parellada / Xarello",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 11.5,
                "Precio (USD)" => 18.99,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Freixenet_Cordon_Negro_Brut-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Glenfiddich 15 anos Single Malt",
                "Descripcion" => "Single malt premium, miel, fruta madura y roble con final suave",
                "Cantidad" => 20,
                "Categoria" => "Destilados",
                "Subcategoria" => "Whisky",
                "Marca" => "Glenfiddich",
                "Pais" => "Escocia",
                "Region" => "Speyside",
                "Cepa / Variedad" => "Single Malt",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 40,
                "Precio (USD)" => 59.99,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Glenfiddich_15_anos_Single_Malt-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Hendricks Gin",
                "Descripcion" => "Gin premium con pepino y petalos de rosa, floral y refrescante",
                "Cantidad" => 50,
                "Categoria" => "Destilados",
                "Subcategoria" => "Ginebra",
                "Marca" => "Hendricks",
                "Pais" => "Escocia",
                "Region" => "Lowlands",
                "Cepa / Variedad" => "Blend de botanicos",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 41.4,
                "Precio (USD)" => 38.5,
                "Descuento" => 10,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Hendricks_Gin-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Hugel Riesling Classic",
                "Descripcion" => "Riesling alsaciano ligero, citricos, flores blancas y mineralidad tipica",
                "Cantidad" => 50,
                "Categoria" => "Vinos",
                "Subcategoria" => "Blanco",
                "Marca" => "Hugel",
                "Pais" => "Francia",
                "Region" => "Alsacia",
                "Cepa / Variedad" => "Riesling",
                "Anio Cosecha" => 2021,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 12,
                "Precio (USD)" => 22,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Hugel_Riesling_Classic-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Jack Daniels Old No. 7 Tennessee Whiskey",
                "Descripcion" => "Tennessee Whiskey, vainilla, caramelo y roble tostado suavizado por carbon",
                "Cantidad" => 40,
                "Categoria" => "Destilados",
                "Subcategoria" => "Whisky",
                "Marca" => "Jack Daniels",
                "Pais" => "Estados Unidos",
                "Region" => "Tennessee",
                "Cepa / Variedad" => "Blend",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 40,
                "Precio (USD)" => 28.99,
                "Descuento" => 10,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Jack_Daniels_Old_No._7_Tennessee_Whiskey-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Johnnie Walker Black Label 12 anos",
                "Descripcion" => "Blended Scotch 12 anos, vainilla, frutas secas y ahumado suave",
                "Cantidad" => 20,
                "Categoria" => "Destilados",
                "Subcategoria" => "Whisky",
                "Marca" => "Johnnie Walker",
                "Pais" => "Escocia",
                "Region" => "Highlands / Speyside",
                "Cepa / Variedad" => "Blend",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 40,
                "Precio (USD)" => 34.99,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Johnnie_Walker_Black_Label_12_anos-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Macallan 12 anos Sherry Oak",
                "Descripcion" => "Single malt en barrica de Jerez, seco de frutas, naranja y especias",
                "Cantidad" => 30,
                "Categoria" => "Destilados",
                "Subcategoria" => "Whisky",
                "Marca" => "Macallan",
                "Pais" => "Escocia",
                "Region" => "Speyside",
                "Cepa / Variedad" => "Single Malt",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 40,
                "Precio (USD)" => 89.99,
                "Descuento" => 5,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Macallan_12_anos_Sherry_Oak-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Marques de Caceres Crianza Rioja",
                "Descripcion" => "Tempranillo con vainilla, cereza y notas de roble americano, elegante",
                "Cantidad" => 30,
                "Categoria" => "Vinos",
                "Subcategoria" => "Tinto",
                "Marca" => "Marques de Caceres",
                "Pais" => "Espana",
                "Region" => "Rioja",
                "Cepa / Variedad" => "Tempranillo",
                "Anio Cosecha" => 2020,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 13.5,
                "Precio (USD)" => 19.99,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Marques_de_Caceres_Crianza_Rioja-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Moet and Chandon Brut Imperial",
                "Descripcion" => "Champagne de referencia, manzana dorada, brioche y frutos blancos",
                "Cantidad" => 50,
                "Categoria" => "Vinos",
                "Subcategoria" => "Espumante / Champagne",
                "Marca" => "Moet and Chandon",
                "Pais" => "Francia",
                "Region" => "Champagne",
                "Cepa / Variedad" => "Pinot Noir / Chardonnay / Meunier",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 12,
                "Precio (USD)" => 52,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Moet_and_Chandon_Brut_Imperial-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Montes Alpha Cabernet Sauvignon",
                "Descripcion" => "Cabernet chileno, frutos negros, menta y roble tostado con buen cuerpo",
                "Cantidad" => 40,
                "Categoria" => "Vinos",
                "Subcategoria" => "Tinto",
                "Marca" => "Montes",
                "Pais" => "Chile",
                "Region" => "Valle de Colchagua",
                "Cepa / Variedad" => "Cabernet Sauvignon",
                "Anio Cosecha" => 2021,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 14,
                "Precio (USD)" => 24.99,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Montes_Alpha_Cabernet_Sauvignon-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Patron Silver Tequila",
                "Descripcion" => "Tequila artesanal ultra-premium 100% agave, citrico, floral y suave",
                "Cantidad" => 200,
                "Categoria" => "Destilados",
                "Subcategoria" => "Tequila",
                "Marca" => "Patron",
                "Pais" => "Mexico",
                "Region" => "Jalisco / Highlands",
                "Cepa / Variedad" => "Agave Azul",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 40,
                "Precio (USD)" => 52.99,
                "Descuento" => 20,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Patron_Silver_Tequila-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Penfolds Koonunga Hill Shiraz",
                "Descripcion" => "Shiraz australiano accesible, frutos rojos y pimienta negra suave",
                "Cantidad" => 10,
                "Categoria" => "Vinos",
                "Subcategoria" => "Tinto",
                "Marca" => "Penfolds",
                "Pais" => "Australia",
                "Region" => "South Australia",
                "Cepa / Variedad" => "Shiraz",
                "Anio Cosecha" => 2022,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 14,
                "Precio (USD)" => 18.99,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Penfolds_Koonunga_Hill_Shiraz-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Santa Carolina Reserva Carmenere",
                "Descripcion" => "Carmenere con notas de pimiento verde, frutas rojas y especias suaves",
                "Cantidad" => 40,
                "Categoria" => "Vinos",
                "Subcategoria" => "Tinto",
                "Marca" => "Santa Carolina",
                "Pais" => "Chile",
                "Region" => "Valle Central",
                "Cepa / Variedad" => "Carmenere",
                "Anio Cosecha" => 2022,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 13.5,
                "Precio (USD)" => 14.5,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Santa_Carolina_Reserva_Carmenere-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Santa Rita Reserva Sauvignon Blanc",
                "Descripcion" => "Sauvignon Blanc fresco, hierba cortada, citricos y fruta tropical",
                "Cantidad" => 50,
                "Categoria" => "Vinos",
                "Subcategoria" => "Blanco",
                "Marca" => "Santa Rita",
                "Pais" => "Chile",
                "Region" => "Valle de Casablanca",
                "Cepa / Variedad" => "Sauvignon Blanc",
                "Anio Cosecha" => 2023,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 13,
                "Precio (USD)" => 13.99,
                "Descuento" => 10,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Santa_Rita_Reserva_Sauvignon_Blanc-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Torres Mas La Plana Cabernet Sauvignon",
                "Descripcion" => "Cabernet Sauvignon premium de Penedes, intenso con ciruela madura",
                "Cantidad" => 100,
                "Categoria" => "Vinos",
                "Subcategoria" => "Tinto",
                "Marca" => "Torres",
                "Pais" => "Espana",
                "Region" => "Penedes",
                "Cepa / Variedad" => "Cabernet Sauvignon",
                "Anio Cosecha" => 2019,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 13.5,
                "Precio (USD)" => 45,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Torres_Mas_La_Plana_Cabernet_Sauvignon-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Torres Vina Esmeralda Moscatel",
                "Descripcion" => "Blend aromatico de Moscatel y Gewurztraminer, flores y tropicales",
                "Cantidad" => 40,
                "Categoria" => "Vinos",
                "Subcategoria" => "Blanco",
                "Marca" => "Torres",
                "Pais" => "Espana",
                "Region" => "Penedes",
                "Cepa / Variedad" => "Moscatel / Gewurztraminer",
                "Anio Cosecha" => 2023,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 11.5,
                "Precio (USD)" => 16.5,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Torres_Vina_Esmeralda_Moscatel-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Trivento Golden Reserve Rose",
                "Descripcion" => "Rosado de Malbec, fresa, frambuesa y petalos de rosa, final fresco",
                "Cantidad" => 10,
                "Categoria" => "Vinos",
                "Subcategoria" => "Rosado",
                "Marca" => "Trivento",
                "Pais" => "Argentina",
                "Region" => "Mendoza",
                "Cepa / Variedad" => "Malbec",
                "Anio Cosecha" => 2023,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 13,
                "Precio (USD)" => 15.99,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Trivento_Golden_Reserve_Rose-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Veuve Clicquot Yellow Label Brut",
                "Descripcion" => "Champagne con cuerpo, frutas amarillas, brioche y toques de vainilla",
                "Cantidad" => 10,
                "Categoria" => "Vinos",
                "Subcategoria" => "Espumante / Champagne",
                "Marca" => "Veuve Clicquot",
                "Pais" => "Francia",
                "Region" => "Champagne",
                "Cepa / Variedad" => "Pinot Noir / Meunier / Chardonnay",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 12,
                "Precio (USD)" => 65,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Veuve_Clicquot_Yellow_Label_Brut-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Zacapa 23 Centenario",
                "Descripcion" => "Ron guatemalteco de alta gama, miel, chocolate y especias finas",
                "Cantidad" => 150,
                "Categoria" => "Destilados",
                "Subcategoria" => "Ron",
                "Marca" => "Ron Zacapa",
                "Pais" => "Guatemala",
                "Region" => "Quetzaltenango",
                "Cepa / Variedad" => "Ron anejo",
                "Anio Cosecha" => null,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 40,
                "Precio (USD)" => 54.99,
                "Descuento" => 20,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Zacapa_23_Centenario-removebg-preview.avif",
                "Estado" => "activo"
            ],
            [
                "Nombre" => "Zuccardi Valle de Uco Malbec",
                "Descripcion" => "Malbec de altura con notas de frutos negros y toques florales",
                "Cantidad" => 20,
                "Categoria" => "Vinos",
                "Subcategoria" => "Tinto",
                "Marca" => "Zuccardi",
                "Pais" => "Argentina",
                "Region" => "Valle de Uco",
                "Cepa / Variedad" => "Malbec",
                "Anio Cosecha" => 2021,
                "Contenido (ml)" => 750,
                "Alcohol (%)" => 13.5,
                "Precio (USD)" => 32.99,
                "Descuento" => 0,
                "Imagen" => "https://storage.googleapis.com/tienda_vinos/fotos_no_fondo/Zuccardi_Valle_de_Uco_Malbec-removebg-preview.avif",
                "Estado" => "activo"
            ]
        ];

        // Definición de categorías fijas (padres e hijas) a insertar primero
        $categoriasFijas = [
            'Vinos' => ['Tinto', 'Blanco', 'Rosado', 'Espumoso', 'Fortificado'],
            'Destilados' => ['Whisky', 'Ron', 'Vodka', 'Tequila', 'Ginebra'],
            'Cervezas' => ['Lager', 'IPA', 'Ale', 'Stout']
        ];

        // Insertar categorías fijas si no existen
        foreach ($categoriasFijas as $padre => $subcategorias) {
            $catPadre = Categoria::firstOrCreate(
                ['nombre' => $padre],
                ['nivel' => 1, 'descripcion' => 'Categoría principal de ' . strtolower($padre)]
            );

            foreach ($subcategorias as $sub) {
                Categoria::firstOrCreate(
                    ['nombre' => $sub, 'nombre_padre' => $catPadre->id_categoria],
                    ['nivel' => 2, 'descripcion' => 'Subcategoría de ' . strtolower($padre)]
                );
            }
        }

        // Mapeo de tipos de cepa/variedad
        $tiposCepas = [
            'Malbec' => 'Tinta',
            'Cabernet Sauvignon' => 'Tinta',
            'Merlot' => 'Tinta',
            'Shiraz' => 'Tinta',
            'Carmenere' => 'Tinta',
            'Tempranillo' => 'Tinta',
            'Pinot Noir' => 'Tinta',
            'Chardonnay' => 'Blanca',
            'Sauvignon Blanc' => 'Blanca',
            'Torrontes' => 'Blanca',
            'Macabeo' => 'Blanca',
            'Parellada' => 'Blanca',
            'Xarello' => 'Blanca',
            'Riesling' => 'Blanca',
            'Moscatel' => 'Aromatica',
            'Gewurztraminer' => 'Aromatica',
            'Meunier' => 'Tinta',
            'Agave Azul' => 'Aromatica',
            'Ron anejo' => 'Aromatica',
            'Single Malt' => 'Aromatica',
            'Blend de botanicos' => 'Aromatica',
            'Blend' => 'Aromatica',
        ];

        foreach ($data as $row) {
            // 1. Categoria Padre y Subcategoria
            $categoriaPadre = Categoria::firstOrCreate(
                ['nombre' => $row['Categoria']],
                ['nivel' => 1, 'descripcion' => 'Categoría principal de ' . strtolower($row['Categoria'])]
            );

            $idCategoriaAsignar = $categoriaPadre->id_categoria;

            if (isset($row['Subcategoria']) && !empty($row['Subcategoria'])) {
                $subcategoria = Categoria::firstOrCreate(
                    [
                        'nombre' => $row['Subcategoria'],
                        'nombre_padre' => $categoriaPadre->id_categoria
                    ],
                    [
                        'nivel' => 2,
                        'descripcion' => 'Subcategoría de ' . strtolower($categoriaPadre->nombre)
                    ]
                );
                $idCategoriaAsignar = $subcategoria->id_categoria;
            }

            // 2. Marca
            $marca = Marca::firstOrCreate(
                ['nombre' => $row['Marca']]
            );

            // 3. Producto
            $producto = Producto::create([
                'nombre' => $row['Nombre'],
                'descripcion' => $row['Descripcion'],
                'cantidad' => $row['Cantidad'],
                'id_categoria' => $idCategoriaAsignar,
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
                    // Obtener tipo del array mapeado, por defecto Blanca si no se encuentra
                    $tipoAsignado = $tiposCepas[$cepaNombre] ?? 'Aromatica'; 
                    
                    $variedad = Variedad::firstOrCreate(
                        ['nombre' => $cepaNombre],
                        ['tipo' => $tipoAsignado, 'descripcion' => 'Variedad de tipo ' . $tipoAsignado]
                    );
                    $producto->variedades()->attach($variedad->id_variedad);
                }
            }
        }
    }
}
