<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idsysusuGet = $_GET['idsysusuS'];
$idpaiGet = $_GET['idpaiS'];
$numeroUnicoGet = $_GET['numeroUnicoS'];
$nomeGet = $_GET['nomeS'];
$arquivoGet = $_GET['arquivoS'];

if(trim($_GET['nomeS'])=="") {
	$nomeGet = $_GET['arquivoS'];
} else {
	$nomeGet = $_GET['nomeS'];
}

$extensao = $_GET['arquivoS'];
$extensao = substr($extensao, -4);
if($extensao[0] == '.'){
	$extensao = substr($extensao, -3);
}
$extensao = strtolower($extensao);

$tamanhoGet = tamanhoArquivoSemExtensao("../../files/sysmidia/".$numeroUnicoGet."/".$_GET['arquivoS']."");

$insert = mysql_query("INSERT INTO sysmidia (numeroUnico,idsysusu,idpai,nome,arquivo,tipo,extensao,tamanho,data,dataModificacao) 
													VALUES 
												   ('".$numeroUnicoGet."','".$idsysusuGet."','".$idpaiGet."','".$nomeGet."','".$arquivoGet."','file','".$extensao."','".$tamanhoGet."','".$data."','".$data."')");

include("lista_pasta.php");
?>
