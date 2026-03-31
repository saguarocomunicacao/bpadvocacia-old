<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$numeroUnicoGerado_set = geraCodReturn();
$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$idparceiro_sysclienteGet = $_GET['idparceiro_sysclienteS'];

$insert = mysql_query("INSERT INTO ".$modGet."_parceiro_syscliente (
														 numeroUnico,
														 numeroUnico_pai,
														 idparceiro_syscliente,
														 stat,
														 data,
														 dataModificacao
														 ) 
													     VALUES 
												        (
														 '".$numeroUnicoGerado_set."',
														 '".$numeroUnicoGet."',
														 '".$idparceiro_sysclienteGet."',
														 '1',
														 '".$data."',
														 '".$data."'
														 )");

include("lista_".$modGet."_parceiro_syscliente.php");
?>
