<?
include("../../include/inc/sess.php");
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";
$idGet = $_GET['idS'];

$sql = mysql_query("DELETE FROM adv_processo_processo WHERE id='".$idGet."'");

# Gravação do Log
$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo_processo WHERE id='".$idGet."'"));
$logPerfil = "administrador";
$logId = $sysusu['id'];
$logAcao = "Excluiu";
$logLocal = "Processo";
$logDescricao = "Foi excluído o item <b>".$itemAntes['nome']."</b>";
$logData = $data;
gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

include("lista_adv_processo_processo.php");
?>
