<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$criadorGet = $_GET['criadorS'];
$idGet = $_GET['idS'];
$statGet = $_GET['statS'];

$update = mysql_query("UPDATE parceiro_sysagenda_categoria SET stat='".$statGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");

include("lista_categoria.php");
?>
