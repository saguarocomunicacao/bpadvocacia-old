<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = $_GET['modS'];
$destaqueGet = $_GET['destaqueS'];

$update = mysql_query("UPDATE ".$modGet." SET destaque='".$destaqueGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");
?>
