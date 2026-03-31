<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

$sql = mysql_query("DELETE FROM sysconfig_links WHERE id='".$idGet."'");

include("lista_links.php");
?>
