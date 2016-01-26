<?php
/*ORIENTADO A BASE DE DATOS*/
require './clases/AutoCarga.php';
$contenido = file_get_contents("plantilla/_main.html");
/*
$contenido = str_replace("{titulo}", "Año 2016", $contenido);
$contenido = str_replace("{subtitulo}", "Aprende web", $contenido);
$contenido = str_replace("{boton}", "Este es un boton", $contenido);
*/
$articulo = file_get_contents("plantilla/_articulo.html");
$articulos = "";
for($i=0; $i<10; $i++) {
    $articuloi = str_replace("{contenido}", "Año 201$i", $articulo);
    $articuloi = str_replace("{texto}", "Feliz año 201$i", $articuloi);
    $articulos .= $articuloi;
}
$datos= array(
    "titulo" => "Nuevo año",
    "subtitulo" => "Año 2016",
    "texto" => "Feliz año 2016",
    "boton" => "El boton",
    "pie" => "Footer",
    "articulodeportivo" => $articulos
);

foreach ($datos as $key => $value) {
    $contenido = str_replace("{".$key."}", $value, $contenido);
}

$contenido = str_replace("{pie}", "Mi pie", $contenido);

echo $contenido;