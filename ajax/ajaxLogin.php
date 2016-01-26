<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$usuarios = array(
    "juan" => "hola",
    "pepe" => "que tal"
);
$ok = json_encode(array('login' => true));
$no = json_encode(array('login' => false));
$login = Request::req("login");
$clave = Request::req("clave");
if(isset($usuarios[$login])&& $usuarios[$login] === $clave){
    echo $ok;

    $usuario = new Usuario($login, $clave);
    $sesion->setUser($usuario);
}else{
    echo $no;
    $sesion->destroy();
};