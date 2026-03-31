<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$listaIdGet = str_replace("||","','",$_GET['listaIdS']);
$listaIdGet = str_replace("|","'",$listaIdGet);
$modGet = "".$_GET['modS']."";

$zip= new zipfile; //cria o objeto

$qSqlItem = mysql_query("SELECT * FROM ".$modGet." WHERE id IN (".$listaIdGet.")");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
	$file_name = $itemCheck['imagem'];

	$arq1 = "../../files/".$modGet."/".$itemCheck['numeroUnico']."/".$itemCheck['imagem'].""; //nome do arquivo a ser compactado

	$abre1 = fopen($arq1, "r");
	$com1 = fread($abre1, filesize($arq1)); //string contendo o arquivo a ser compactado
	fclose($abre1);

	$zip->addFile($com1,"$file_name"); //adiciona um arquivo ao zip
	
	$numeroUnicoSet = $itemCheck['numeroUnico'];
}

$strzip=$zip->file(); //string contendo o arquivo zip

$arq="".$numeroUnicoSet.".zip";

$abre = fopen($arq, "w");
$salva = fwrite($abre, $strzip);
fclose($abre);
?>
