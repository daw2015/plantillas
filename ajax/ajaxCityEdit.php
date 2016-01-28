<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$no = json_encode(array('edit' => -1));

if($sesion->isLogged()){
    $bd = new DataBase();
    $gestor = new ManageCity($bd);
    $city = new City();
    $city->read();
    $r = $gestor->set($city);
    $bd->close();
    $respuesta = '{"edit":' . $r .'}';
    echo $respuesta;
    //var_dump($bd->getError());
}else{
    echo $no;
}