<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idsysusuGet = $_REQUEST['idsysusuS'];
$numeroUnicoGet = geraCodReturn();
$idpaiGet = $_POST['idpai'];


if(is_dir("../../files/sysmidia")) { 
	if(is_dir("../../files/sysmidia/".$numeroUnicoGet."")) { 
	} else {
		criaPastaComCaminho("files/sysmidia/","".$numeroUnicoGet."");
	}
} else {
	if(is_dir("../../files/sysmidia/".$numeroUnicoGet."/")) { 
	} else {
		criaPastaComCaminho("files/","sysmidia");
		criaPastaComCaminho("files/sysmidia/","".$numeroUnicoGet."");
	}
}


$uploaddir = "../../files/sysmidia/".$numeroUnicoGet."/"; 
$file = $uploaddir . basename($_FILES['file']['name']); 
 
if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) { 
  echo "success"; 
} else {
	echo "error";
}

$extensao = $_FILES['file']['name'];
$extensao = substr($extensao, -4);
if($extensao[0] == '.'){
	$extensao = substr($extensao, -3);
}
$extensao = strtolower($extensao);

$tamanhoGet = tamanhoArquivoSemExtensao("../../files/sysmidia/".$numeroUnicoGet."/".$_FILES['file']['name']."");

$insert = mysql_query("INSERT INTO sysmidia (numeroUnico,idsysusu,idpai,nome,arquivo,tipo,extensao,tamanho,data,dataModificacao) 
													VALUES 
												   ('".$numeroUnicoGet."','".$idsysusuGet."','".$idpaiGet."','".$_FILES['file']['name']."','".$_FILES['file']['name']."','file','".$extensao."','".$tamanhoGet."','".$data."','".$data."')");


include("lista_pasta.php");
?>
