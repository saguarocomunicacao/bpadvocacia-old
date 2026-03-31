<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";
$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";

$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet."_banco WHERE id='".$idGet."'");

include("lista_".$modGet."_banco.php");
?>
