<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = "".$_GET['idS']."";

$rSqlItem = mysql_fetch_array(mysql_query("SELECT * FROM sysplano WHERE id='".$idGet."'"));

echo "".$rSqlItem['valor']."";
?>
