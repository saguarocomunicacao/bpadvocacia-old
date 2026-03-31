<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = $_GET['numeroUnicoS'];
$idsysusuGet = $_GET['idsysusuS'];
$visualizar_pastaGet = $_GET['visualizar_pastaS'];
$criar_pastaGet = $_GET['criar_pastaS'];
$renomear_pastaGet = $_GET['renomear_pastaS'];
$excluir_pastaGet = $_GET['excluir_pastaS'];
$upload_arquivoGet = $_GET['upload_arquivoS'];
$excluir_arquivoGet = $_GET['excluir_arquivoS'];
$renomear_arquivoGet = $_GET['renomear_arquivoS'];
$baixar_arquivoGet = $_GET['baixar_arquivoS'];

$insert = mysql_query("INSERT INTO sysmidiaperm (numeroUnico,
												 idsysusu,
												 visualizar_pasta,
												 criar_pasta,
												 renomear_pasta,
												 excluir_pasta,
												 upload_arquivo,
												 excluir_arquivo,
												 renomear_arquivo,
												 baixar_arquivo) 
												 VALUES 
												('".$numeroUnicoGet."',
												 '".$idsysusuGet."',
												 '".$visualizar_pastaGet."',
												 '".$criar_pastaGet."',
												 '".$renomear_pastaGet."',
												 '".$excluir_pastaGet."',
												 '".$upload_arquivoGet."',
												 '".$excluir_arquivoGet."',
												 '".$renomear_arquivoGet."',
												 '".$baixar_arquivoGet."')");
												   
include("lista_usuarios.php");
?>
