<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$nomeGet = $_GET['nomeS'];

$update = mysql_query("UPDATE sysmidia SET nome='".$nomeGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");

include("lista_pasta.php");
?>
