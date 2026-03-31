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
$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_agenda WHERE id='".$idGet."'"));
$logPerfil = "administrador";
$logId = $sysusuLog['id'];
$logAcao = "Concluiu";
$logLocal = "Tarefa";
$logDescricao = "[7] ".$sysusuLog['nome']." concluiu o item <b>".$itemAntes['nome']."</b> de id <b title=\"parceiro_adv_processo\">".$itemAntes['id']."</b>";
$logData = $data;
gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

$parceiro_adv_processo_tipo = mysql_fetch_array(mysql_query("SELECT id,nome FROM parceiro_adv_processo_tipo WHERE id='".$itemAntes['idparceiro_adv_processo_tipo']."'"));
$idparceiro_adv_processo_tipo_de_acao = "".$parceiro_adv_processo_tipo['id']."";
$idparceiro_adv_processo_tipo_de_acao_txt = "".$parceiro_adv_processo_tipo['nome']."";

$sysusu_criador_processo = mysql_fetch_array(mysql_query("SELECT id,nome FROM sysusu WHERE id='".$sysusuLog['id']."'"));
$sysusu_criador = "".$sysusu_criador_processo['id'].""; 
$sysusu_criador_txt = "".$sysusu_criador_processo['nome'].""; 
$insert = mysql_query("INSERT INTO parceiro_adv_processo_log (
														 idparceiro_adv_processo,
														 criador,
														 criador_txt,
														 idparceiro_adv_processo_tipo_de_acao,
														 idparceiro_adv_processo_tipo_de_acao_txt,
														 idparceiro_adv_processo_tipo,
														 idparceiro_adv_processo_tipo_txt,
														 data
														 ) 
														 VALUES 
														(
														 '".$idEditavel."',
														 '".$sysusu_criador."',
														 '".$sysusu_criador_txt."',
														 '".$idparceiro_adv_processo_tipo_de_acao."',
														 '".$idparceiro_adv_processo_tipo_de_acao_txt."',
														 '0',
														 'Concluído',
														 '".$data."'
														 )");

$update = mysql_query("UPDATE parceiro_adv_processo_agenda SET concluidor='".$sysusuLog['id']."',concluido='".$acaoGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");
$update = mysql_query("UPDATE sys_arquivo SET concluidor='".$sysusuLog['id']."',concluido='".$acaoGet."',dataModificacao='".$data."' WHERE numeroUnico='".$itemAntes['numeroUnico']."'");
?>
