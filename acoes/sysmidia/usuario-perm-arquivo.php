<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = $_GET['numeroUnicoS'];
$idsysusuGet = $_GET['idsysusuS'];
$upload_arquivoGet = $_GET['upload_arquivoS'];
$excluir_arquivoGet = $_GET['excluir_arquivoS'];
$renomear_arquivoGet = $_GET['renomear_arquivoS'];
$baixar_arquivoGet = $_GET['baixar_arquivoS'];

$insert = mysql_query("INSERT INTO sysmidiaperm (numeroUnico,
												 idsysusu,
												 upload_arquivo,
												 excluir_arquivo,
												 renomear_arquivo,
												 baixar_arquivo) 
												 VALUES 
												('".$numeroUnicoGet."',
												 '".$idsysusuGet."',
												 '".$upload_arquivoGet."',
												 '".$excluir_arquivoGet."',
												 '".$renomear_arquivoGet."',
												 '".$baixar_arquivoGet."')");
												   
include("lista_usuarios_arquivo.php");
?>
