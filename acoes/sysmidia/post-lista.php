<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

if(trim($_POST['acaoForm'])=="compactar") {
	$_SESSION['lista_ids'] = "";

	foreach ($_POST['pasta_sel'] as $idcheck) { 
	
		$itemCheck = mysql_fetch_array(mysql_query("SELECT * FROM sysmidia WHERE id='".$idcheck."'"));
		
		if(trim($itemCheck['tipo'])=="file") {
			$_SESSION['lista_ids'] .= "|".$itemCheck['id']."|";
		} else {
			$qSqlFile = mysql_query("SELECT * FROM sysmidia WHERE idpai='".$itemCheck['id']."' AND tipo='file'");
			while($rSqlFile = mysql_fetch_array($qSqlFile)) {
				$_SESSION['lista_ids'] .= "|".$rSqlFile['id']."|";
			}
			compacta_arquivo($itemCheck['id']);
		}
	}
	

	if(trim($lista_ids_set)=="") {
		echo "<script>alert('Não existe nenhum arquivo dentro das pastas selecionadas!');</script>";
	} else {

		if(is_dir("../../files/sysmidia_zip")) {
		} else {
			criaPastaComCaminho("files/","sysmidia_zip");
		}
		
		$numeroUnicoFile = geraCodReturn();
		
		$caminhoDoArquivo = "../../files/sysmidia_zip/";
		
		$zip= new zipfile; //cria o objeto

		$lista_ids_set = str_replace("||","','",$_SESSION['lista_ids']);
		$lista_ids_set = str_replace("|","'",$lista_ids_set);
	
		$qSqlFile = mysql_query("SELECT * FROM sysmidia WHERE id IN (".$lista_ids_set.") AND tipo='file'");
		while($rSqlFile = mysql_fetch_array($qSqlFile)) {
			$file_name = $rSqlFile['arquivo'];
			$arq1 = "../../files/sysmidia/".$rSqlFile['numeroUnico']."/".$rSqlFile['arquivo'].""; //nome do arquivo a ser compactado
		
			$abre1 = fopen($arq1, "r");
			$com1 = fread($abre1, filesize($arq1)); //string contendo o arquivo a ser compactado
			fclose($abre1);
		
			$zip->addFile($com1,"".$file_name.""); //adiciona um arquivo ao zip
		}
	
		$strzip=$zip->file(); //string contendo o arquivo zip
		
		$arq="".$numeroUnicoFile.".zip";
		
		$abre = fopen($caminhoDoArquivo.$arq, "w");
		$salva = fwrite($abre, $strzip);
		fclose($abre);
	
		header("Content-Type: application/zip"); // informa o tipo do arquivo ao navegador
		header("Content-Length: ".filesize($caminhoDoArquivo.$arq)); // informa o tamanho do arquivo ao navegador
		header("Content-Disposition: attachment; filename=".basename($caminhoDoArquivo.$arq)); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
		readfile($caminhoDoArquivo.$arq); // lê o arquivo
		exit; // aborta pós-ações
	}
} else {
	include("../../header.php");
	if(trim($_POST['acaoForm'])=="excluir") {
		foreach ($_POST['pasta_sel'] as $idcheck) { 
		
			$itemCheck = mysql_fetch_array(mysql_query("SELECT * FROM sysmidia WHERE id='".$idcheck."'"));
			$idpaiGet = $itemCheck['idpai'];
			
			if(trim($itemCheck['tipo'])=="file") {
				unlink("../../files/sysmidia/".$itemCheck['numeroUnico']."/".$itemCheck['arquivo']."");
				rmdir("../../files/sysmidia/".$itemCheck['numeroUnico']."");
				$del = mysql_query("DELETE FROM sysmidia WHERE id='".$itemCheck['id']."'");
			} else {
				$qSqlFile = mysql_query("SELECT * FROM sysmidia WHERE idpai='".$itemCheck['id']."' AND tipo='file'");
				while($rSqlFile = mysql_fetch_array($qSqlFile)) {
					remove_arquivo("../../","sysmidia",$rSqlFile['id'],"arquivo",""); 
				}
				
				remove_pasta_arvore("../../","sysmidia",$itemCheck['id'],"");
				
				$sql = mysql_query("DELETE FROM sysmidia WHERE id='".$itemCheck['id']."'");
			}
		}
		echo "<script>abre_pasta_ajax('".$idpaiGet."');</script>";
		echo "<script>atualiza_pastas_laterais();</script>";
	} else {
	}
}
?>
