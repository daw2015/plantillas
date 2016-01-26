<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$no = json_encode(array('login' => false));
$pagina=  Request::req("pagina");
if($pagina===null){
    $pagina=1;
}
if($sesion->isLogged()){
    $bd = new DataBase();
    $gestor = new ManageCity($bd);
    $pager = new Pager($gestor->count());
    $paginas = $pager->getPaginas();
    $ciudades = $gestor->getListJson($pagina);
    echo '{"ciudades":' .$ciudades. ', "paginas": ' . $paginas . '}';
    $bd->close();
}else{
    echo $no;
}