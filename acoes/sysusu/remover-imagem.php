<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = $_GET['modS'];
$campoGet = $_GET['campoS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet." WHERE id='".$idGet."'"));

if(trim($item['numeroUnico'])=="") {
	unlink("".$link."files/".$modGet."/".$item[$campoGet]."");
} else {
	unlink("".$link."files/".$modGet."/".$item['numeroUnico']."/".$item[$campoGet]."");
}

$update = mysql_query("UPDATE ".$modGet." SET ".$campoGet."='',dataModificacao='".$data."' WHERE id='".$idGet."'");
?>
