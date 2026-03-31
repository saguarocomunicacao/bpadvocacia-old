<?
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";
$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";

$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet."_parceiro_syscliente WHERE id='".$idGet."'");

include("lista_".$modGet."_parceiro_syscliente.php");
?>
