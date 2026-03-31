<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add") {

		echo"<script>alert('[".$_FILES['arquivo']['name']."]')</script>";

		$numeroUnicoGet = $_POST["numeroUnico"];
	
		if(is_dir("../../files/envio_de_arquivos")) { 
			if(is_dir("../../files/envio_de_arquivos/".$numeroUnicoGet."")) { 
			} else {
				criaPastaComCaminho("files/envio_de_arquivos/","".$numeroUnicoGet."");
			}
		} else {
			if(is_dir("../../files/envio_de_arquivos/".$numeroUnicoGet."/")) { 
			} else {
				criaPastaComCaminho("files/","envio_de_arquivos");
				criaPastaComCaminho("files/envio_de_arquivos/","".$numeroUnicoGet."");
			}
		}
	
		$extensao = $_FILES['arquivo']['name'];
		$extensao = substr($extensao, -4);
		if($extensao[0] == '.'){
			$extensao = substr($extensao, -3);
		}
		$extensao = strtolower($extensao);
		
		if(trim($extensao)=="zip") {
			$caminhoUpload = "../../files/envio_de_arquivos/".$numeroUnicoGet."/"; 
			$arquivo = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($_FILES['arquivo']['name']));
			$file = $caminhoUpload . basename($_FILES['arquivo']['name']); 
			 
			if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $file)) { } else { }
		
			rename("".$caminhoUpload."".$_FILES['arquivo']['name']."", "".$caminhoUpload."/".$arquivo."");

			echo"<script>alert('[".$caminhoUpload."]')</script>";
	
			require_once("../../include/lib/pclzip.lib.php");
		
			$filezip = substr("".$_FILES['arquivo']['name']."",0,-4);
		
			$archive = new PclZip("".$caminhoUpload."/".$_FILES['arquivo']['name']."");
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
				$numeroUnicoGerado = geraCodReturn();
				$insert = mysql_query("INSERT INTO envio_de_arquivos_lista (numeroUnico,numeroUnico_pai,arquivo,data,dataModificacao) 
																	VALUES 
																   ('".$numeroUnicoGerado."','".$numeroUnicoGet."','".$file."','".$data."','".$data."')");
			}
		
			unlink("".$caminhoUpload."/".$_FILES['arquivo']['name']."");

			# Gravação do Log
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Adicionar";
			$logLocal = "Usuário";
			$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
			$logData = $data;
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
			$_POST['data'] = $data;
			$_POST['dataModificacao'] = $data;
	
			insert($_POST,$mod);
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
	
		} else {
			echo"<script>alert('O arquivo enviado não é do tipo ZIP')</script>";
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/#tb1_novo','_self','')</script>";
		}

	}

?>