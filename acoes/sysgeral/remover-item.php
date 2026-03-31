<?
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$ordemSetGet = $_GET['ordemSetS'];
$ordemGet = $_GET['ordemS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet." WHERE id='".$idGet."'"));

if(trim($ordemSetGet)=="SIM") {
	$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."");
	while($rall = mysql_fetch_array($qall)) {
		if( $rall['ordem'] > $item['ordem']) {
			$ordem = $rall['ordem'] - 1;
			$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
		}
	}
}

$sysmod_post = mysql_fetch_array(mysql_query("SELECT nome FROM sysmod WHERE bd='".$modGet."'"));
$caminho1 = "".$sysmod_post['nome']."";

# Gravação do Log
$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet." WHERE id='".$idGet."'"));
$logPerfil = "administrador";
$logId = $sysusu['id'];
$logAcao = "Excluiu";
$logLocal = "".$caminho1."";
$logDescricao = "Foi excluído o item <b>".$itemAntes['nome']."</b>";
$logData = $data;
gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet." WHERE id='".$idGet."'");

?>
