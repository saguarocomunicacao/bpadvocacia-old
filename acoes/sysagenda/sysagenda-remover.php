<?
include("../../include/inc/sess.php");
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

# Gravação do Log
$sysusuLog = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_GET['sysusuS']."'"));
if(trim($sysusuLog['id'])=="" || trim($sysusuLog['id'])=="0") {
	$sysusuLog = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_REQUEST['sysusuS']."'"));
}
$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM sysagenda WHERE id='".$idGet."'"));
$logPerfil = "administrador";
$logId = $sysusuLog['id'];
$logAcao = "Concluiu";
$logLocal = "Tarefa";
$logDescricao = "[5] ".$sysusuLog['nome']." concluiu o item <b>".$itemAntes['nome']."</b>";
$logData = $data;
gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

$sql = mysql_query("DELETE FROM sysagenda WHERE id='".$idGet."'");

$sql = mysql_query("DELETE FROM sys_arquivo WHERE numeroUnico='".$itemAntes['numeroUnico']."'");
?>
