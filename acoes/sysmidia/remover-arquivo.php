<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idpaiGet = $_GET['idpaiS'];
$idGet = $_GET['idS'];

remove_arquivo("../../","sysmidia",$idGet,"arquivo","");
?>
