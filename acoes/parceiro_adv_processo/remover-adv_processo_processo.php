<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";
$idGet = $_GET['idS'];

$sql = mysql_query("DELETE FROM parceiro_adv_processo_processo WHERE id='".$idGet."'");

include("lista_parceiro_adv_processo_processo.php");
?>
