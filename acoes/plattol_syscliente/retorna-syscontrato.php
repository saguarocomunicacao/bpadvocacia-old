<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$sufixoGet = $_GET['sufixoS'];
$idGet = $_GET['idS'];

$itemN = mysql_num_rows(mysql_query("SELECT * FROM syscontrato WHERE idplattol_syscliente='".$idGet."'"));
if(trim($itemN)==0) {
	echo "0";
} else {
?>

<option value="">---</option>
<?
$qSqlItem = mysql_query("SELECT * FROM syscontrato WHERE idplattol_syscliente='".$idGet."' AND aceito='1' AND stat='1' ORDER BY data_aceito");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['numeroUnico']?></option>
<? } } ?>
