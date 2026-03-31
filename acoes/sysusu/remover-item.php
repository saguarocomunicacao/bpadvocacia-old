<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = $_GET['modS'];
$ordemSetGet = $_GET['ordemSetS'];
$ordemGet = $_GET['ordemS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet." WHERE id='".$idGet."'"));

if(trim($ordemSetGet)=="SIM") {
	$qall = mysql_query("SELECT * FROM ".$modGet."");
	while($rall = mysql_fetch_array($qall)) {
		if( $rall['ordem'] > $item['ordem']) {
			$ordem = $rall['ordem'] - 1;
			$update = mysql_query("UPDATE ".$modGet." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
		}
	}
}

$sql = mysql_query("DELETE FROM ".$modGet." WHERE id='".$idGet."'");

?>
