<?php
include("../../include/inc/data.php");

$mod = "sysmensagem";
$data = date("Y-m-d H:i:s");
$numeroUnicoGerado = $_GET['numeroUnicoS'];
$idGet = $_GET['idS'];
$importanteGet = $_GET['importanteS'];

$rSqlMsg = mysql_fetch_array(mysql_query("SELECT * FROM sysmensagem WHERE id='".$idGet."'"));

if(trim($rSqlMsg['importante'])==0) {
	$importanteGet = 1;
} else {
	$importanteGet = 0;
}


$update = mysql_query("UPDATE ".$mod." SET importante='$importanteGet',dataModificacao='$data' WHERE id='".$idGet."'");

if(trim($importanteGet)==0) {
	echo "<i class='splashy-star_empty mbox_star'></i>";
} else {
	echo "<i class='splashy-star_full mbox_star'></i>";
}
?>
