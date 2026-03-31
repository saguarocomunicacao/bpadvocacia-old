<?php
include("../../include/inc/sess.php");
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = geraCodReturn();;

$codGet = $_GET['codS'];
$cod_processoGet = $_GET['cod_processoS'];
$dataGet = $_GET['dataS'];
$orgaoGet = $_GET['orgaoS'];
$cidadeGet = $_GET['cidadeS'];
$nomeGet = $_GET['nomeS'];
$jornalGet = $_GET['jornalS'];
$varaGet = $_GET['varaS'];
$paginaGet = $_GET['paginaS'];
$textoGet = $_GET['textoS'];
$pendenteGet = $_GET['pendenteS'];

$insert = mysql_query("INSERT INTO adv_intimacao (
														 numeroUnico,
														 cod,
														 cod_processo,
														 data_xml,
														 orgao,
														 cidade,
														 nome,
														 jornal,
														 vara,
														 pagina,
														 texto,
														 pendente,
														 stat,
														 data,
														 dataModificacao
														 ) 
													     VALUES 
												        (
														 '".$numeroUnicoGet."',
														 '".$codGet."',
														 '".$cod_processoGet."',
														 '".$dataGet."',
														 '".$orgaoGet."',
														 '".$cidadeGet."',
														 '".$nomeGet."',
														 '".$jornalGet."',
														 '".$varaGet."',
														 '".$paginaGet."',
														 '".$textoGet."',
														 '".$pendenteGet."',
														 '1',
														 '".$data."',
														 '".$data."'
														 )");

# Gravação do Log
$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM adv_intimacao WHERE numeroUnico='".$numeroUnicoGet."'"));
$logPerfil = "administrador";
$logId = $sysusu['id'];
$logAcao = "Adicionou";
$logLocal = "Intimação Pendente";
$logDescricao = "Foi adicionado o item de código <b>".$itemAntes['cod']."</b>";
$logData = $data;
gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

echo $textoGet;
?>
