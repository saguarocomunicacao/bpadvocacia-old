<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

$update = mysql_query("UPDATE parceiro_sysagenda SET concluido='1',dataModificacao='".$data."' WHERE id='".$idGet."'");
?>
