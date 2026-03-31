<?php
require_once("../../include/inc/sess.php");
require_once("../../include/inc/main.php");
require_once("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

if(trim($_REQUEST["numeroUnico_upload_arquivo"])=="") {
	if(trim($_POST["numeroUnicoS"])=="") {
		$numeroUnicoGet = $_REQUEST["numeroUnicoS"];
	} else {
		$numeroUnicoGet = $_POST["numeroUnicoS"];
	}
} else {
	$numeroUnicoGet = $_REQUEST["numeroUnico_upload_arquivo"];
}

if(is_dir("../../files/parceiro_adv_processo")) { 
	criaPastaComCaminho("files/parceiro_adv_processo/","".$numeroUnicoGet."");
} else {
	if(is_dir("../../files/parceiro_adv_processo/".$numeroUnicoGet."")) { 
	} else {
		criaPastaComCaminho("files/","parceiro_adv_processo");
		criaPastaComCaminho("files/parceiro_adv_processo/","".$numeroUnicoGet."");
	}
}

$extensao = $_FILES['file']['name'];
$extensao = substr($extensao, -4);
if($extensao[0] == '.'){
	$extensao = substr($extensao, -3);
}
$extensao = strtolower($extensao);

if(trim($extensao)=="zip") {

	require_once("../../include/lib/pclzip.lib.php");
	
	$caminhoUpload = "../../files/parceiro_adv_processo/".$numeroUnicoGet."/";
	$file = $caminhoUpload . basename($_FILES['file']['name']); 
	 
	if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) { } else { }
	
	
	$filezip = substr("".$_FILES['file']['name']."",0,-4);
	$qtd_fotos = mysql_num_rows(mysql_query("SELECT * FROM parceiro_adv_processo_galeria WHERE numeroUnico='".$numeroUnicoGet."'"));

	$archive = new PclZip("".$caminhoUpload."/".$_FILES['file']['name']."");
	if (($v_result_list = $archive->extract(PCLZIP_OPT_PATH, "".$caminhoUpload."",PCLZIP_OPT_REMOVE_PATH, "install/release")) == 0) {
		die("Error : ".$archive->errorInfo(true));
	}

	$narray = sizeof($v_result_list);
	$ordem = $qtd_fotos;
	for($i=0;$i < $narray; $i++) {
		$ordem = $ordem + 1;
		$nome_sujo = $v_result_list[$i]["stored_filename"];
		$file = $v_result_list[$i]["stored_filename"];
		$file = str_replace("?","",utf8_decode($file));
		$file = preg_replace("/[][><}{)(:;,!?*%~^`&#@]/", "", $file);
		$file = preg_replace("/ /", "_", $file);
		rename("".$caminhoUpload."/".$nome_sujo."", "".$caminhoUpload."/".$file."");
		
		$data = date("Y-m-d H:i:s");
		$insert = mysql_query("INSERT INTO parceiro_adv_processo_galeria (numeroUnico,ordem,nome,imagem,stat,data,dataModificacao) 
															VALUES 
														   ('".$numeroUnicoGet."','".$ordem."','sem legenda','".$file."','1','".$data."','".$data."')");
	}

	unlink("".$caminhoUpload."/".$_FILES['file']['name']."");

} else {
	if(trim($extensao)=="jpg"||trim($extensao)=="jpeg"||trim($extensao)=="gif"||trim($extensao)=="bmp"||trim($extensao)=="png") {
		
		$caminhoUpload = "../../files/parceiro_adv_processo/".$numeroUnicoGet."/"; 
		$arquivo = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($_FILES['file']['name']));
		$file = $caminhoUpload . basename($_FILES['file']['name']); 
		 
		if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) { } else { }

		rename("".$caminhoUpload."".$_FILES['file']['name']."", "".$caminhoUpload."/".$arquivo."");
		
		$qtd_fotos = mysql_num_rows(mysql_query("SELECT * FROM parceiro_adv_processo_galeria WHERE numeroUnico='".$numeroUnicoGet."'"));
		$ordem = $qtd_fotos + 1;
		
		$tamanhoGet = tamanhoArquivoSemExtensao("../../files/parceiro_adv_processo/".$numeroUnicoGet."/".$arquivo."");
		
		$insert = mysql_query("INSERT INTO parceiro_adv_processo_galeria (numeroUnico,ordem,nome,imagem,stat,data,dataModificacao) 
															VALUES 
														   ('".$numeroUnicoGet."','".$ordem."','".$arquivo."','".$arquivo."','1','".$data."','".$data."')");
		
		
	} else {
		echo "<div class='alert alert-error'><a data-dismiss='alert' class='close'>×</a>O arquivo <strong>".$_FILES['file']['name']."</strong> não esta em um formato de imagem permitido, e o mesmo não foi inserido na galeria.</div>";
	}
}

include("lista_galeria.php");
?>
