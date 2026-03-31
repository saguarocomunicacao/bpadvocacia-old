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
$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM adv_intimacao_agenda WHERE id='".$idGet."'"));
$logPerfil = "administrador";
$logId = $sysusuLog['id'];
$logAcao = "Concluiu";
$logLocal = "Tarefa";
$logDescricao = "".$sysusuLog['nome']." concluiu o item <b>".$itemAntes['nome']."</b> de id <b title=\"adv_intimacao\">".$itemAntes['id']."</b>";
$logData = $data;
gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

$_CAMPOS['numeroUnico'] = $itemAntes['numeroUnico_pai'];
$_CAMPOS['idsysusu'] = $sysusuLog['id'];
$_CAMPOS['tipo'] = "tarefa";
if(trim($_GET['acaoS'])=="1") {
	$_CAMPOS['acao'] = "concluiu";
} else if(trim($_GET['acaoS'])=="0") {
	$_CAMPOS['acao'] = "nao_concluiu";
} else if(trim($_GET['acaoS'])=="99") {
	$_CAMPOS['acao'] = "analise_mh";
}
$_CAMPOS['numeroUnico_agenda'] = $itemAntes['numeroUnico'];
$_CAMPOS['dataModificacao'] = $data;

adv_intimacao_caminho_acoes_set($_CAMPOS);

$update = mysql_query("UPDATE adv_intimacao_agenda SET concluidor='".$sysusuLog['id']."',concluido='".$acaoGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");
$update = mysql_query("UPDATE sys_arquivo SET concluidor='".$sysusuLog['id']."',concluido='".$acaoGet."',dataModificacao='".$data."' WHERE numeroUnico='".$itemAntes['numeroUnico']."'");
?>
