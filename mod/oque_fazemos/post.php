<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add") {

		upload_arquivo($mod,"imagem","");
		
		if(trim($_POST['destaque'])=="") { $_POST['destaque']=0; } else { $_POST['destaque']=1; }

		$qall = mysql_query("SELECT * FROM ".$mod."");
		while($rall = mysql_fetch_array($qall)) {
			if( $rall['ordem'] >= $_POST['ordem']) {
				$ordem = $rall['ordem'] + 1;
				$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
			}
		}

		# Gravação do Log
		$logPerfil = "administrador";
		$logId = $sysusu['id'];
		$logAcao = "Adicionar";
		$logLocal = "".$caminho1."";
		$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
		$logData = $data;
		gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

		$_POST['data'] = $data;
		$_POST['dataModificacao'] = $data;

		insert($_POST,$mod);
	} else {
		if(trim($_POST['acaoForm'])=="editar") {
			$idEditavel = $_POST['iditem'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));

			upload_arquivo($mod,"imagem","");

			if(trim($_POST['destaque'])=="") { $_POST['destaque']=0; } else { $_POST['destaque']=1; }

			$qall = mysql_query("SELECT * FROM ".$mod."");
			while($rall = mysql_fetch_array($qall)) {
				if($rall['ordem'] > $item['ordem']) {
					$ordem = $rall['ordem'] - 1;
					$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
				}
			}

			$qall = mysql_query("SELECT * FROM ".$mod."");
			while($rall = mysql_fetch_array($qall)) {
				if($rall['ordem'] >= $_POST['ordem']) {
					$ordem = $rall['ordem'] + 1;
					$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
				}
			}

			# Gravação do Log
			$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Editou";
			$logLocal = "".$caminho1."";
			$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
			$logData = $data;
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

			$_POST['dataModificacao'] = $data;

			update($_POST,$mod,$idEditavel);
		} else {
			if(trim($_POST['acaoForm'])=="config") {
				$nConfig = mysql_num_rows(mysql_query("SELECT * FROM ".$mod."_config"));
				if($nConfig==0) { 
					$campo_imagem = "imagem_descricao";
					if(trim($_FILES[$campo_imagem]["name"])=="") {
					} else {
						upload_arquivo($mod,$campo_imagem,"_config");
					}
					$insert = mysql_query("INSERT INTO ".$mod."_config (nome,imagem_descricao,texto_descricao) VALUES ('".$_POST['nome']."','".$_POST['imagem_descricao']."','".$_POST['texto_descricao']."')");
				} else {
					$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_config ORDER BY data LIMIT 1"));
					$campo_imagem = "imagem_descricao";
					if(trim($_FILES[$campo_imagem]["name"])=="") {
						$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
					} else {
						upload_arquivo($mod,$campo_imagem,"_config");
					}
					$update = mysql_query("UPDATE ".$mod."_config SET nome='".$_POST['nome']."',imagem_descricao='".$_POST['imagem_descricao']."',texto_descricao='".$_POST['texto_descricao']."' WHERE id='".$itemAtual['id']."'");
				}
			} else {
				if(trim($_POST['acaoForm'])=="excluir") {
					foreach ($_POST['msg_sel'] as $idcheck) {
						$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$mod." WHERE id='".$idcheck."'"));
	
						$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$mod."");
						while($rall = mysql_fetch_array($qall)) {
							if( $rall['ordem'] > $item['ordem']) {
								$ordem = $rall['ordem'] - 1;
								$update = mysql_query("UPDATE ".$linguagem_set."".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
							}
						}
	
						# Gravação do Log
						$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idcheck."'"));
						$logPerfil = "administrador";
						$logId = $sysusu['id'];
						$logAcao = "Excluiu";
						$logLocal = "".$caminho1."";
						$logDescricao = "Foi excluído o item <b>".$itemAntes['nome']."</b>";
						$logData = $data;
						gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
						$sql = mysql_query("DELETE FROM ".$mod." WHERE id='".$idcheck."'");
					}
				} else {
					if(trim($_POST['acaoForm'])=="publicar") {
						foreach ($_POST['msg_sel'] as $idcheck) {
							$sql = mysql_query("UPDATE ".$mod." SET stat='1' WHERE id='".$idcheck."'");
						}
					} else {
						if(trim($_POST['acaoForm'])=="despublicar") {
							foreach ($_POST['msg_sel'] as $idcheck) {
								$sql = mysql_query("UPDATE ".$mod." SET stat='0' WHERE id='".$idcheck."'");
							}
						} else {
	
							$nConfig = mysql_num_rows(mysql_query("SELECT * FROM ".$mod."_config"));
							if(trim($_POST['url_amigavel_ativa'])=="") { $_POST['url_amigavel_ativa']=0; } else { $_POST['url_amigavel_ativa']=1; }
							
							if($nConfig==0) { 
								$insert = mysql_query("INSERT INTO ".$mod."_config (url_amigavel,url_amigavel_ativa,titulo_seo,texto_seo) VALUES ('".$_POST['url_amigavel']."','".$_POST['url_amigavel_ativa']."','".$_POST['titulo_seo']."','".$_POST['texto_seo']."')");
							} else {
								$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_config ORDER BY data LIMIT 1"));
								$update = mysql_query("UPDATE ".$mod."_config SET url_amigavel='".$_POST['url_amigavel']."',url_amigavel_ativa='".$_POST['url_amigavel_ativa']."',titulo_seo='".$_POST['titulo_seo']."',texto_seo='".$_POST['texto_seo']."' WHERE id='".$itemAtual['id']."'");
							}
						}
					}
				}

			}
		}
	}

	echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
?>