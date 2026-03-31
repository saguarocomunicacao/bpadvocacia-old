<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$sufixoGet = $_GET['sufixoS'];
$idGet = $_GET['idS'];

$syscontrato = mysql_fetch_array(mysql_query("SELECT * FROM syscontrato WHERE id='".$idGet."'"));

$itemN = mysql_num_rows(mysql_query("SELECT * FROM syscontrato_item WHERE numeroUnico_pai='".$syscontrato['numeroUnico']."'"));
if(trim($itemN)==0) {
	echo "0";
} else {
?>

<option value="">---</option>
<?
$qSqlItem = mysql_query("SELECT * FROM syscontrato_item WHERE numeroUnico_pai='".$syscontrato['numeroUnico']."' ORDER BY data");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
	$sysproduto = mysql_fetch_array(mysql_query("SELECT * FROM sysproduto WHERE id='".$rSqlItem['idsysproduto']."'"));
?>
<option value="<?= $rSqlItem['id'] ?>"><?=$sysproduto['nome']?></option>
<? } } ?>
