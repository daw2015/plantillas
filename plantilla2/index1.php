<?php
$contenidoParticular = file_get_contents("_plantilla/_1.html");
$datos = array(
    "saludo" => "Hola, qué tal?"
);

foreach ($datos as $key => $value) {
    $contenidoParticular = str_replace("{".$key."}", $value, $contenidoParticular);
}

$pagina = file_get_contents("_plantilla/_plantilla.html");
$datos = array(
    "contenido_particular" => $contenidoParticular
);

foreach ($datos as $key => $value) {
    $pagina = str_replace("{".$key."}", $value, $pagina);
}

echo $pagina;