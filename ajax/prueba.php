<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageCity($bd);
$city = $gestor->get(5);
echo $city->getJson();
echo "<hr>";
echo $gestor->getListJson();