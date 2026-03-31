<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idsysusuGet = $_GET['idsysusuS'];
$nomeGet = $_GET['nomeS'];
$idpaiGet = $_GET['idpaiS'];
$numeroUnicoGet = $_GET['numeroUnicoS']; 

$insert = mysql_query("INSERT INTO sysmidia (numeroUnico,idsysusu,idpai,nome,tipo,data,dataModificacao) 
													VALUES 
												   ('".$numeroUnicoGet."','".$idsysusuGet."','".$idpaiGet."','".$nomeGet."','folder','".$data."','".$data."')");
												   
#cria_pasta("../../","sysmidia","",$numeroUnicoGet);

$pasta = mysql_fetch_array(mysql_query("SELECT * FROM sysmidia WHERE numeroUnico='".$numeroUnicoGet."'"));

include("lista_pasta.php");
?>
