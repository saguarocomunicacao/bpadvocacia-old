<?
include("../../include/inc/sess.php");
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$idTarefaGet = $_GET['idTarefaS'];

$tarefa = mysql_fetch_array(mysql_query("SELECT * FROM adv_intimacao_agenda WHERE id='".$idTarefaGet."'"));

$lista_admin_nova = str_replace("|".$idGet."|","",$tarefa['lista_admin']);

$sysusuLog    = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_GET['sysusuS']."'"));

# Gravação do Log
$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM adv_intimacao_agenda WHERE id='".$idGet."'"));
$logPerfil = "administrador";
$logId = $sysusuLog['id'];
$logAcao = "Editou";
$logLocal = "Tarefa da Intimação";
$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
$logData = $data;
gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

$update = mysql_query("UPDATE adv_intimacao_agenda SET lista_admin='".$lista_admin_nova."',dataModificacao='".$data."' WHERE id='".$idTarefaGet."'");
$sql = mysql_query("DELETE FROM sys_arquivo WHERE numeroUnico='".$itemAntes['numeroUnico']."'");
?>
