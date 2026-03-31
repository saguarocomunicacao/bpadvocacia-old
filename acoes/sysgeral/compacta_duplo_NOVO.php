<?php
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$listaIdGet = str_replace("||","','",$_REQUEST['listaIdS']);
$listaIdGet = str_replace("|","'",$listaIdGet);

$lista2IdGet = str_replace("||","','",$_REQUEST['lista2IdS']);
$lista2IdGet = str_replace("|","'",$lista2IdGet);

$lista3IdGet = str_replace("||","','",$_REQUEST['lista3IdS']);
$lista3IdGet = str_replace("|","'",$lista3IdGet);

$numeroUnicoGet = $_REQUEST["numeroUnicoS"];

$modGet = "".$_REQUEST['modS']."";
$mod2Get = "".$_REQUEST['mod2S']."";
$mod3Get = "".$_REQUEST['mod3S']."";

/*
if(is_dir("../../files/".$modGet."")) { 
	if(is_dir("../../files/".$modGet."/".$numeroUnicoGet."")) { 
	} else {
		criaPastaComCaminho("files/".$modGet."/","".$numeroUnicoGet."");
	}
} else {
	if(is_dir("../../files/".$modGet."/".$numeroUnicoGet."/")) { 
	} else {
		criaPastaComCaminho("files/","".$modGet."");
		criaPastaComCaminho("files/".$modGet."/","".$numeroUnicoGet."");
	}
}
*/

$zip= new zipfile; //cria o objeto

$qSqlItem = mysql_query("SELECT * FROM ".$modGet." WHERE id IN (".$listaIdGet.")");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
	$file_name = $rSqlItem['arquivo'];

	$arq1 = "../../files/".str_replace("_galeria","",$modGet)."/".$rSqlItem['numeroUnico']."/".$rSqlItem['arquivo'].""; //nome do arquivo a ser compactado

	$abre1 = fopen($arq1, "r");
	$com1 = fread($abre1, filesize($arq1)); //string contendo o arquivo a ser compactado
	fclose($abre1);

	$zip->addFile($com1,"$file_name"); //adiciona um arquivo ao zip
}

$qSqlItem = mysql_query("SELECT * FROM ".$mod2Get." WHERE id IN (".$lista2IdGet.")");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
	$file_name = $rSqlItem['imagem'];

	$arq1 = "../../files/".str_replace("_galeria","",$mod2Get)."/".$rSqlItem['numeroUnico']."/".$rSqlItem['imagem'].""; //nome do arquivo a ser compactado

	$abre1 = fopen($arq1, "r");
	$com1 = fread($abre1, filesize($arq1)); //string contendo o arquivo a ser compactado
	fclose($abre1);

	$zip->addFile($com1,"$file_name"); //adiciona um arquivo ao zip
}

$strzip=$zip->file(); //string contendo o arquivo zip

$qSqlItem = mysql_query("SELECT * FROM ".$mod3Get." WHERE id IN (".$lista2IdGet.")");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
	$file_name = $rSqlItem['arquivo'];

	$arq1 = "../../files/".str_replace("_galeria","",$mod3Get)."/".$rSqlItem['numeroUnico_pasta']."/".$rSqlItem['arquivo'].""; //nome do arquivo a ser compactado

	$abre1 = fopen($arq1, "r");
	$com1 = fread($abre1, filesize($arq1)); //string contendo o arquivo a ser compactado
	fclose($abre1);

	$zip->addFile($com1,"$file_name"); //adiciona um arquivo ao zip
}

$strzip=$zip->file(); //string contendo o arquivo zip

$arq="../../files/".$modGet."/".$numeroUnicoGet.".zip";

echo $arq;
$abre = fopen($arq, "w");
$salva = fwrite($abre, $strzip);
fclose($abre);
?>
