<?php

require_once("class/database.class2.php");

$con = new Database();
$link = $con->getConexao();

$smtm = $link->prepare("select * from reserva");
$smtm->execute();

$data = $smtm->fetchAll();

print_r($data);
    
echo "bom dia";
?>