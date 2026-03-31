<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$criadorGet = $_GET['criadorS'];
$nomeGet = $_GET['nomeS'];
$ordemGet = $_GET['ordemS'];
$corGet = $_GET['corS'];

$qall = mysql_query("SELECT * FROM parceiro_sysagenda_categoria WHERE criador='".$criadorGet."' ORDER BY ordem");
while($rall = mysql_fetch_array($qall)) {
	if($rall['ordem'] >= $ordemGet) {
		$ordem = $rall['ordem'] + 1;
		$update = mysql_query("UPDATE parceiro_sysagenda_categoria SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
	}
}

$insert = mysql_query("INSERT INTO parceiro_sysagenda_categoria (criador,cor,ordem,nome,stat,data,dataModificacao) 
													VALUES 
												   ('".$criadorGet."','".$corGet."','".$ordemGet."','".$nomeGet."','1','".$data."','".$data."')");

include("lista_categoria.php");
?>
