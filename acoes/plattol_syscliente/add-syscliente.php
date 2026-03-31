<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$sufixoGet = $_GET['sufixoS'];
$numeroUnicoSysclienteGet = $_GET['numeroUnicoS'];
$nomeGet = $_GET['nomeS'];
$emailGet = $_GET['emailS'];
$senhaGet = $_GET['senhaS'];
$como_conheceuGet = $_GET['como_conheceuS'];
$como_conheceu_outroGet = $_GET['como_conheceu_outroS'];
$telefone_1_operadoraGet = $_GET['telefone_1_operadoraS'];
$telefone_1_dddGet = $_GET['telefone_1_dddS'];
$telefone_1Get = $_GET['telefone_1S'];

$insert = mysql_query("INSERT INTO plattol_syscliente (numeroUnico,nome,email,senha,como_conheceu,como_conheceu_outro,telefone_1_operadora,telefone_1_ddd,telefone_1,stat,data,dataModificacao) 
													VALUES 
												     ('".$numeroUnicoSysclienteGet."','".$nomeGet."','".$emailGet."','".$senhaGet."','".$como_conheceuGet."','".$como_conheceu_outroGet."','".$telefone_1_operadoraGet."','".$telefone_1_dddGet."','".$telefone_1Get."','1','".$data."','".$data."')");

$item = mysql_fetch_array(mysql_query("SELECT * FROM plattol_syscliente WHERE numeroUnico='".$numeroUnicoSysclienteGet."'"));
?>

<option value="">---</option>
<?
$qSqlItem = mysql_query("SELECT * FROM plattol_syscliente WHERE stat='1' ORDER BY nome");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$item['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
<? } ?>
