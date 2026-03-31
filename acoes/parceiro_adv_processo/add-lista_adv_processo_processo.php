<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGerado = geraCodReturn();
$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$nomeGet = $_GET['nomeS'];
$codGet = $_GET['codS'];

$insert = mysql_query("INSERT INTO parceiro_adv_processo_processo (
														 numeroUnico,
														 numeroUnico_pai,
														 nome,
														 cod,
														 data,
														 dataModificacao
														 ) 
													     VALUES 
												        (
														 '".$numeroUnicoGerado."',
														 '".$numeroUnicoGet."',
														 '".$nomeGet."',
														 '".$codGet."',
														 '".$data."',
														 '".$data."'
														 )");

include("lista_parceiro_adv_processo_processo.php");
?>
