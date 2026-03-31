<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

if(is_dir("../../files/sysmidia_zip")) {
} else {
	criaPastaComCaminho("files/","sysmidia_zip");
}

$numeroUnicoFile = geraCodReturn();

$caminhoDoArquivo = "../../files/sysmidia_zip/";

$zip= new zipfile; //cria o objeto

foreach ($_POST['pasta_sel'] as $idcheck) { 

	$itemCheck = mysql_fetch_array(mysql_query("SELECT * FROM sysmidia WHERE id='".$idcheck."'"));
	$file_name = $itemCheck['arquivo'];

	$arq1 = "../../files/sysmidia/".$itemCheck['numeroUnico']."/".$itemCheck['arquivo'].""; //nome do arquivo a ser compactado

	$abre1 = fopen($arq1, "r");
	$com1 = fread($abre1, filesize($arq1)); //string contendo o arquivo a ser compactado
	fclose($abre1);

	$zip->addFile($com1,"".$file_name.""); //adiciona um arquivo ao zip
}

$strzip=$zip->file(); //string contendo o arquivo zip

$arq="".$numeroUnicoFile.".zip";

$abre = fopen($arq, "w");
$salva = fwrite($abre, $strzip);
fclose($abre);
?>
