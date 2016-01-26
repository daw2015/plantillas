<?php

class Controlador {

    function handle() {
        $op = 1;
        if (isset($_GET["op"])) {
            $op = $_GET["op"];
        }//$op = Request::get("op");
        $metodo = "metodo" . $op;
        if (method_exists($this, $metodo)) { //ucfirst pone la primera en mayuscula
            $this->$metodo();
        } else {
            $this->metodo0();
        }
    }

    function metodo0() {
        $contenidoParticular = file_get_contents("_plantilla/_1.html");
        $datos = array(
            "saludo" => "Hola, qué tal?"
        );
        foreach ($datos as $key => $value) {
            $contenidoParticular = str_replace("{" . $key . "}", $value, $contenidoParticular);
        }

        $pagina = file_get_contents("_plantilla/_plantilla.html");
        $datos = array(
            "contenido_particular" => $contenidoParticular
        );
        foreach ($datos as $key => $value) {
            $pagina = str_replace("{" . $key . "}", $value, $pagina);
        }
        echo $pagina;
    }

    function metodo1() {
        $contenidoParticular = file_get_contents("_plantilla/_2.html");
        $datos = array(
            "esto" => "acerca de mi"
        );
        foreach ($datos as $key => $value) {
            $contenidoParticular = str_replace("{" . $key . "}", $value, $contenidoParticular);
        }
        $pagina = file_get_contents("_plantilla/_plantilla.html");
        $datos = array(
            "contenido_particular" => $contenidoParticular
        );
        foreach ($datos as $key => $value) {
            $pagina = str_replace("{" . $key . "}", $value, $pagina);
        }
        echo $pagina;
    }

    function metodo2() {
        echo "nada";
    }

}
