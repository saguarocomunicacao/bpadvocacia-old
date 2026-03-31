<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$nomeGet = $_GET['nomeS'];
$idGet = $_GET['idS'];
$modGet = $_GET['modS'];
$valorGet = $_GET['valorS'];

$update = mysql_query("UPDATE ".$modGet." SET ".$nomeGet."='".$valorGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");

echo $valorGet;
?>
