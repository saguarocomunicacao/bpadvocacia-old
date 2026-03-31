<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idsysusuGet = $_GET['idsysusuS'];

$idGet = $_GET['idS'];
$idpaiGet = $_GET['idpaiS'];
$numeroUnicoGet = $_GET['numeroUnicoS'];
$nomeGet = $_GET['nomeS'];
$arquivoGet = $_GET['arquivoS'];

if(trim($_GET['nomeS'])=="") {
	$nomeGet = $_GET['arquivoS'];
} else {
	$nomeGet = $_GET['nomeS'];
}

$itemSql = mysql_fetch_array(mysql_query("SELECT * FROM sysmidia WHERE id='".$idGet."'"));
//unlink("../../files/sysmidia/".$numeroUnicoGet."/".$itemSql['arquivo']."");

$update = mysql_query("UPDATE sysmidia SET nome='".$nomeGet."',arquivo='".$arquivoGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");

include("lista_pasta.php");
?>
