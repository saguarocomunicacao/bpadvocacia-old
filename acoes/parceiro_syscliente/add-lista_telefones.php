<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$nomeGet = $_GET['nomeS'];
$operadoraGet = $_GET['operadoraS'];
$dddGet = $_GET['dddS'];
$telefoneGet = $_GET['telefoneS'];
$principalGet = $_GET['principalS'];

$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet."_telefones WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC"));
if($nSql==0) {
	$principalGet = "1";
} else {
	if(trim($principalGet)=="1") {
		$qSql = mysql_query("SELECT * FROM ".$modGet."_telefones WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC");
		while($rSql = mysql_fetch_array($qSql)) {
			$update = mysql_query("UPDATE ".$modGet."_telefones SET principal='0',dataModificacao='".$data."' WHERE id='".$rSql['id']."'");
		}
	}
}

$insert = mysql_query("INSERT INTO ".$modGet."_telefones (numeroUnico_pai,nome,operadora,ddd,telefone,principal,data) 
													VALUES 
												   ('".$numeroUnicoGet."','".$nomeGet."','".$operadoraGet."','".$dddGet."','".$telefoneGet."','".$principalGet."','".$data."')");

include("lista_".$modGet."_telefones.php");
?>
