<?
include("../../include/inc/sess.php");
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$somente_criadorGet = $_GET['somente_criadorS'];

$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM adv_intimacao_agenda WHERE id='".$idGet."'"));

$update = mysql_query("UPDATE adv_intimacao_agenda SET somente_criador='".$somente_criadorGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");
$update = mysql_query("UPDATE sys_arquivo SET somente_criador='".$somente_criadorGet."',dataModificacao='".$data."' WHERE numeroUnico='".$itemAntes['numeroUnico']."'");
?>
