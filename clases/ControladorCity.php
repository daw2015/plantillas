<?php

class ControladorCity {

    static function handle() {
        $bd = new DataBase();
        $gestor = new ManageCity($bd);
        $action = Request::req("action");
        $do = Request::req("do");
        $metodo = $action . ucfirst($do);
        if (method_exists(get_class(), $metodo)) { //ucfirst pone la primera en mayuscula
            echo 'El método existe';
            self::$metodo($gestor);
        } else {
            echo 'la función no existe';
            self::readView($gestor);
        }
        $bd->close();
    }
    
    private static function deleteSet($gestor){
        $gestor->delete(Request::get("ID"));
        //ControladorCity::readView($gestor);
        header("Location:?r=$r&op=delete");
    }

    private static function readView($gestor) {
        $listaciudades = $gestor->getList();
        
        $plantillaCiudad = file_get_contents("../plantilla/_ciudad.html");
        $ciudades = "";

        foreach ($listaciudades as $key => $value) {
            $ciudadi = str_replace("{contenido}", $value->getName(), $plantillaCiudad);
            $ciudadi = str_replace("{texto}", $value->getCountryCode(), $ciudadi);
            $ciudadi = str_replace("{ID}", $value->getID(), $ciudadi);
            $ciudades .= $ciudadi;
        }
        $contenido = file_get_contents("../plantilla/_index.html");

        $datos = array(
            "titulo" => "Ciudades",
            "subtitulo" => "del mundo",
            "boton" => "más ciudades",
            "pie" => "Footer",
            "articulodeportivo" => $ciudades
        );
        foreach ($datos as $key => $value) {
            $contenido = str_replace("{" . $key . "}", $value, $contenido);
        }
        echo $contenido;
    }

}
