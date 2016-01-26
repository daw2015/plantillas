<?php
$pagina = file_get_contents("plantilla/_plantilla.html");
$contenidoParticular = file_get_contents("_plantilla/_0.html");
$datos = array(
    "contenido_particular" => $contenidoParticular
);

foreach ($datos as $key => $value) {
    $pagina = str_replace("{".$key."}", $value, $pagina);
}

echo $pagina;