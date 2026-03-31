<?php
require_once("../../include/inc/main.php");
require_once("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = $_GET['numeroUnicoS'];
$modGet = $_GET['modS'];
$nomeGet = $_GET['nomeS'];
$linkGet = $_GET['linkS'];
$sufixoGet = $_GET['sufixoS'];

$nvideos = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet."_video WHERE numeroUnico='".$numeroUnicoGet."'"));

$ordem = $nvideos + 1;

$insert = mysql_query("INSERT INTO ".$modGet."_video (numeroUnico,ordem,nome,link,stat,data,dataModificacao) 
													VALUES 
												   ('".$numeroUnicoGet."','".$ordem."','".$nomeGet."','".$linkGet."','1','".$data."','".$data."')");

include("lista_video.php");
?>
