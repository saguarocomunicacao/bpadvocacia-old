<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$nomeGet = $_GET['nomeS'];
$idbancoGet = $_GET['idbancoS'];
$tipo_contaGet = $_GET['tipo_contaS'];
$agenciaGet = $_GET['agenciaS'];
$contaGet = $_GET['contaS'];
$operacaoGet = $_GET['operacaoS'];
$favorecidoGet = $_GET['favorecidoS'];
$favorecido_cpfGet = $_GET['favorecido_cpfS'];
$favorecido_cnpjGet = $_GET['favorecido_cnpjS'];
$principalGet = $_GET['principalS'];

if(trim($principalGet)=="1") {
	$qSql = mysql_query("SELECT * FROM ".$modGet."_banco WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC");
	while($rSql = mysql_fetch_array($qSql)) {
		$update = mysql_query("UPDATE ".$modGet."_banco SET principal='0',dataModificacao='".$data."' WHERE id='".$rSql['id']."'");
	}
}

$insert = mysql_query("INSERT INTO ".$modGet."_banco (
														 numeroUnico_pai,
														 nome,
														 idbanco,
														 tipo_conta,
														 agencia,
														 conta,
														 operacao,
														 favorecido,
														 favorecido_cpf,
														 favorecido_cnpj,
														 principal,
														 data,
														 dataModificacao
														 ) 
													     VALUES 
												        (
														 '".$numeroUnicoGet."',
														 '".$nomeGet."',
														 '".$idbancoGet."',
														 '".$tipo_contaGet."',
														 '".$agenciaGet."',
														 '".$contaGet."',
														 '".$operacaoGet."',
														 '".$favorecidoGet."',
														 '".$favorecido_cpfGet."',
														 '".$favorecido_cnpjGet."',
														 '".$principalGet."',
														 '".$data."',
														 '".$data."'
														 )");

include("lista_".$modGet."_banco.php");
?>
