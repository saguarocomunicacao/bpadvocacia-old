<?php
include("../../include/inc/sess.php");
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGerado = geraCodReturn();
$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$nomeGet = $_GET['nomeS'];
$codGet = $_GET['codS'];

$insert = mysql_query("INSERT INTO adv_processo_processo (
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

# Gravação do Log
$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo_processo WHERE numeroUnico='".$numeroUnicoGerado."'"));
$logPerfil = "administrador";
$logId = $sysusu['id'];
$logAcao = "Adicionar";
$logLocal = "Processo";
$logDescricao = "Foi adicionado o item <b>".$itemAntes['nome']."</b>";
$logData = $data;
gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

include("lista_adv_processo_processo.php");
?>
