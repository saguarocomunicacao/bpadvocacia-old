<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$nomeGet = $_GET['nomeS'];
$linkGet = $_GET['linkS'];

$insert = mysql_query("INSERT INTO ".$modGet."_redes (numeroUnico_pai,nome,link,stat,data) 
													VALUES 
												   ('".$numeroUnicoGet."','".$nomeGet."','".$linkGet."','1','".$data."')");

include("lista_".$modGet."_redes.php");
?>
