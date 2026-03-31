<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

$sql = mysql_query("DELETE FROM parceiro_sysagenda WHERE id='".$idGet."'");
?>
