<?
include("../../include/inc/sess.php");
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$acaoGet = $_GET['acaoS'];


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
$logDescricao = "[6] ".$sysusuLog['nome']." concluiu o item <b>".$itemAntes['nome']."</b> de id <b title=\"sys_agenda\">".$itemAntes['id']."</b>";
$logData = $data;
gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

$update = mysql_query("UPDATE sysagenda SET concluidor='".$sysusuLog['id']."',concluido='".$acaoGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");
$update = mysql_query("UPDATE sys_arquivo SET concluidor='".$sysusuLog['id']."',concluido='".$acaoGet."',dataModificacao='".$data."' WHERE numeroUnico='".$itemAntes['numeroUnico']."'");
?>

