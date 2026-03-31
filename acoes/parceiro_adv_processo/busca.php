<?php
require_once("../../include/inc/sess.php");
require_once("../../include/inc/main.php");
require_once("../../include/inc/data.php");

$chaveGet = $_GET["chaveS"];

?>
<option value="">---</option>
<?
if(trim($sysperm['todos_parceiro_syscliente'])==1) {
	$qSqlItem = mysql_query("SELECT * FROM parceiro_adv_processo WHERE stat='1' AND cod LIKE '%".$chaveGet."%' ORDER BY dataModificacao DESC");
} else {
	$qSqlItem = mysql_query("SELECT * FROM parceiro_adv_processo WHERE idsysusu='".$sysusu['id']."' AND stat='1' AND cod LIKE '%".$chaveGet."%' ORDER BY dataModificacao DESC");
}
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?> <?=$rSqlItem['cod']?></option>
<? } ?>
