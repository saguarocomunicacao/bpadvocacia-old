<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = $_GET['modS'];
$statGet = $_GET['statS'];

$update = mysql_query("UPDATE ".$modGet." SET stat='".$statGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");
?>
