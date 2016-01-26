<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$logueado = $sesion->isLogged();
$ok = json_encode(array('login' => true));
$no = json_encode(array('login' => false));

if($logueado){
    echo $ok;
}else{
    echo $no;
}