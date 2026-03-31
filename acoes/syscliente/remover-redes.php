<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";

$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet."_redes WHERE id='".$idGet."'");

include("lista_".$modGet."_redes.php");
?>
