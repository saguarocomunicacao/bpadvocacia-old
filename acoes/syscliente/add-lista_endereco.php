<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$nomeGet = $_GET['nomeS'];
$cepGet = $_GET['cepS'];
$ruaGet = $_GET['ruaS'];
$bairroGet = $_GET['bairroS'];
$cidadeGet = $_GET['cidadeS'];
$estadoGet = $_GET['estadoS'];
$principalGet = $_GET['principalS'];

$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet."_endereco WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC"));
if($nSql==0) {
	$principalGet = "1";
} else {
	if(trim($principalGet)=="1") {
		$qSql = mysql_query("SELECT * FROM ".$modGet."_endereco WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC");
		while($rSql = mysql_fetch_array($qSql)) {
			$update = mysql_query("UPDATE ".$modGet."_endereco SET principal='0',dataModificacao='".$data."' WHERE id='".$rSql['id']."'");
		}
	}
}

$insert = mysql_query("INSERT INTO ".$modGet."_endereco (
														 numeroUnico_pai,
														 nome,
														 cep,
														 rua,
														 bairro,
														 cidade,
														 estado,
														 principal,
														 data,
														 dataModificacao
														 ) 
													     VALUES 
												        (
														 '".$numeroUnicoGet."',
														 '".$nomeGet."',
														 '".$cepGet."',
														 '".$ruaGet."',
														 '".$bairroGet."',
														 '".$cidadeGet."',
														 '".$estadoGet."',
														 '".$principalGet."',
														 '".$data."',
														 '".$data."'
														 )");

include("lista_".$modGet."_endereco.php");
?>
