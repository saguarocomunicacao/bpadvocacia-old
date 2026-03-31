<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$sufixoGet = $_GET['sufixoS'];
$numeroUnicoSysclienteGet = $_GET['numeroUnicoS'];
$nomeGet = $_GET['nomeS'];
$emailGet = $_GET['emailS'];
$senhaGet = $_GET['senhaS'];

$insert = mysql_query("INSERT INTO sysfornecedor (numeroUnico,nome,email,senha,stat,data,dataModificacao) 
													VALUES 
												     ('".$numeroUnicoSysclienteGet."','".$nomeGet."','".$emailGet."','".$senhaGet."','1','".$data."','".$data."')");

$item = mysql_fetch_array(mysql_query("SELECT * FROM sysfornecedor WHERE numeroUnico='".$numeroUnicoSysclienteGet."'"));
?>

<option value="">---</option>
<?
$qSqlItem = mysql_query("SELECT * FROM sysfornecedor WHERE stat='1' ORDER BY nome");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$item['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
<? } ?>
