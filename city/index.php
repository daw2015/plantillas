<?php
require '../clases/AutoCarga.php';
ControladorCity::handle();

/*
$bd = new DataBase();
$gestor = new ManageCity($bd);
$action = Request::req("action");
$do = Request::req("do");
$metodo = $action. ucfirst($do);


if(function_exists($metodo)){ //ucfirst pone la primera en mayuscula
    echo 'la función existe';
   $metodo();
}else{
    echo 'la función no existe';
    readView();
}

function readView(){
    echo "yo soy la función (método)";
}

function editView(){
    
}*/