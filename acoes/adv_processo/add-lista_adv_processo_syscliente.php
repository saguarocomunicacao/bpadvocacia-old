<?php
include("../../include/inc/sess.php");
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$numeroUnicoGerado_set = geraCodReturn();
$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$idsysclienteGet = $_GET['idsysclienteS'];

$insert = mysql_query("INSERT INTO ".$modGet."_syscliente (
														 numeroUnico,
														 numeroUnico_pai,
														 idsyscliente,
														 stat,
														 data,
														 dataModificacao
														 ) 
													     VALUES 
												        (
														 '".$numeroUnicoGerado_set."',
														 '".$numeroUnicoGet."',
														 '".$idsysclienteGet."',
														 '1',
														 '".$data."',
														 '".$data."'
														 )");

include("lista_".$modGet."_syscliente.php");
?>
