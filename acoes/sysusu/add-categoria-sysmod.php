<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = $_GET['modS'];

$subLocalGet = $_GET['subLocalS'];
$ordemGet = $_GET['ordemS'];
$idpaiGet = $_GET['idpaiS'];
$nomeGet = $_GET['nomeS'];
$preModGet = $_GET['preModS'];
$preUrlGet = $_GET['preUrlS'];
$slugGet = $_GET['slugS'];

$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."".$subLocalGet."");
while($rall = mysql_fetch_array($qall)) {
	if($rall['ordem'] >= $ordemGet) {
		$ordem = $rall['ordem'] + 1;
		$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."".$subLocalGet." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
	}
}

$insert = mysql_query("INSERT INTO ".$linguagem_set."".$modGet."".$subLocalGet." (url_amigavel,ordem,idpai,nome,prefixo_mod,prefixo_url,stat,data,dataModificacao) 
													VALUES 
												   ('".$slugGet."','".$ordemGet."','".$idpaiGet."','".$nomeGet."','".$preModGet."','".$preUrlGet."','1','".$data."','".$data."')");

include("lista_categoria_sysmod.php");
?>
