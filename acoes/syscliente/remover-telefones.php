<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";
$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";

$rSql = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet."_telefones WHERE id='".$idGet."'"));

$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet."_telefones WHERE id='".$idGet."'");

$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet."_telefones WHERE numeroUnico_pai='".$rSql['numeroUnico_pai']."' ORDER BY data DESC"));
if($nSql==0) { } else {
	$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet."_telefones WHERE numeroUnico_pai='".$rSql['numeroUnico_pai']."' AND principal='1' ORDER BY data DESC"));

	if($nSql==0) {
		$qSql = mysql_query("SELECT * FROM ".$modGet."_telefones WHERE numeroUnico_pai='".$rSql['numeroUnico_pai']."' ORDER BY data DESC LIMIT 1");
		while($rSql = mysql_fetch_array($qSql)) {
			$update = mysql_query("UPDATE ".$modGet."_telefones SET principal='1',dataModificacao='".$data."' WHERE id='".$rSql['id']."'");
		}
	}
}

include("lista_".$modGet."_telefones.php");
?>
