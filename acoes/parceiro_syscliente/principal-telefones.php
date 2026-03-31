<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";
$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";

$qSql = mysql_query("SELECT * FROM ".$modGet."_telefones WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC");
while($rSql = mysql_fetch_array($qSql)) {
	$update = mysql_query("UPDATE ".$modGet."_telefones SET principal='0',dataModificacao='".$data."' WHERE id='".$rSql['id']."'");
}

$update = mysql_query("UPDATE ".$modGet."_telefones SET principal='1',dataModificacao='".$data."' WHERE id='".$idGet."'");

include("lista_".$modGet."_telefones.php");
?>
