<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$nomeGet = $_GET['nomeS'];
$operadoraGet = $_GET['operadoraS'];
$dddGet = $_GET['dddS'];
$telefoneGet = $_GET['telefoneS'];

$insert = mysql_query("INSERT INTO ".$modGet."_telefones (numeroUnico_pai,nome,operadora,ddd,telefone,data) 
													VALUES 
												   ('".$numeroUnicoGet."','".$nomeGet."','".$operadoraGet."','".$dddGet."','".$telefoneGet."','".$data."')");

include("lista_".$modGet."_telefones.php");
?>
