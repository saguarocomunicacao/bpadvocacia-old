<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idsysusuGet = $_GET['idsysusuS'];
$numeroUnicoSysclienteGet = $_GET['numeroUnicoS'];
$idsyscliente_categoriaGet = $_GET['idsyscliente_categoriaS'];
$nomeGet = $_GET['nomeS'];
$emailGet = $_GET['emailS'];
$senhaGet = $_GET['senhaS'];
$como_conheceuGet = $_GET['como_conheceuS'];
$como_conheceu_outroGet = $_GET['como_conheceu_outroS'];
$telefone_1_operadoraGet = $_GET['telefone_1_operadoraS'];
$telefone_1_dddGet = $_GET['telefone_1_dddS'];
$telefone_1Get = $_GET['telefone_1S'];

$insert = mysql_query("INSERT INTO syscliente (numeroUnico,idsysusu,idsyscliente_categoria,nome,email,senha,como_conheceu,como_conheceu_outro,telefone_1_operadora,telefone_1_ddd,telefone_1,stat,data,dataModificacao) 
													VALUES 
												     ('".$numeroUnicoSysclienteGet."','".$idsysusuGet."','".$idsyscliente_categoriaGet."','".$nomeGet."','".$emailGet."','".$senhaGet."','".$como_conheceuGet."','".$como_conheceu_outroGet."','".$telefone_1_operadoraGet."','".$telefone_1_dddGet."','".$telefone_1Get."','1','".$data."','".$data."')");

$item = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE numeroUnico='".$numeroUnicoSysclienteGet."'"));
?>

<?
if(trim($sysperm_set_addcliente['todos_syscliente'])==1) {
	$qSqlItem = mysql_query("SELECT * FROM syscliente WHERE stat='1' AND nome LIKE '%".$nomeGet."%' ORDER BY nome");
} else {
	$qSqlItem = mysql_query("SELECT * FROM syscliente WHERE idsysusu='".$idsysusuGet."' AND stat='1' AND nome LIKE '%".$nomeGet."%' ORDER BY nome");
}
while($rSqlItem = mysql_fetch_array($qSqlItem)) {

 if($rSqlItem['id']==$item['id']) { echo $rSqlItem['id']; } 

}
?>

