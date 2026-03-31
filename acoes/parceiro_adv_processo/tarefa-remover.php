<?
include("../../include/inc/sess.php");
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

$sql = mysql_query("DELETE FROM parceiro_adv_processo_agenda WHERE id='".$idGet."'");

# Gravação do Log
$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_agenda WHERE id='".$idGet."'"));
$logPerfil = "administrador";
$logId = $sysusu['id'];
$logAcao = "Excluiu";
$logLocal = "Tarefa";
$logDescricao = "Foi excluído o item <b>".$itemAntes['nome']."</b>";
$logData = $data;
gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
?>
