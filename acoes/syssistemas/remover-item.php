<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";
$numeroUnicoGet = $_GET['numeroUnicoS'];
$sufixoGet = $_GET['sufixoS'];
$idGet = $_GET['idS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet."_item WHERE id='".$idGet."'"));

$sql = mysql_query("DELETE FROM ".$modGet."_item WHERE id='".$idGet."'");

include("lista-itens.php");
?>
 
 