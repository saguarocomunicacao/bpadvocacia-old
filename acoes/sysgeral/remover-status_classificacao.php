<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$subLocalGet = $_GET['subLocalS'];
$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."".$subLocalGet." WHERE id='".$idGet."'"));

if(trim($ordemSetGet)=="SIM") {
	$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."".$subLocalGet."");
	while($rall = mysql_fetch_array($qall)) {
		if( $rall['ordem'] > $item['ordem']) {
			$ordem = $rall['ordem'] - 1;
			$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."".$subLocalGet." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
		}
	}
}


$alter = mysql_query("ALTER TABLE `yscliente_classificacao_set` DROP `".$item['numeroUnico']."`;");

$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet."".$subLocalGet." WHERE id='".$idGet."'");
?>
