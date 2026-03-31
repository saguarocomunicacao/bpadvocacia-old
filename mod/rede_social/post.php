<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add") {

		$qall = mysql_query("SELECT * FROM ".$mod."");
		while($rall = mysql_fetch_array($qall)) {
			if( $rall['ordem'] >= $_POST['ordem']) {
				$ordem = $rall['ordem'] + 1;
				$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
			}
		}

		if(trim($_POST['destaque'])=="") { $_POST['destaque']=0; } else { $_POST['destaque']=1; }

		upload_arquivo($mod."","imagem","");
		
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

		insert($_POST,$mod."");
	} else {
		if(trim($_POST['acaoForm'])=="editar") {
			$idEditavel = $_POST['iditem'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));

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
	
			if(trim($_POST['destaque'])=="") { $_POST['destaque']=0; } else { $_POST['destaque']=1; }

			upload_arquivo($mod."","imagem","");

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

			update($_POST,$mod."",$idEditavel);
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
							if(trim($_POST['acaoForm'])=="config_seo") {
								$nConfig = mysql_num_rows(mysql_query("SELECT * FROM ".$mod."_config"));
								if(trim($_POST['url_amigavel_ativa'])=="") { $_POST['url_amigavel_ativa']=0; } else { $_POST['url_amigavel_ativa']=1; }
								
								if($nConfig==0) { 
									$insert = mysql_query("INSERT INTO ".$mod."_config (url_amigavel,url_amigavel_ativa,titulo_seo,texto_seo) VALUES ('".$_POST['url_amigavel']."','".$_POST['url_amigavel_ativa']."','".$_POST['titulo_seo']."','".$_POST['texto_seo']."')");
								} else {
									$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_config ORDER BY data LIMIT 1"));
									$update = mysql_query("UPDATE ".$mod."_config SET url_amigavel='".$_POST['url_amigavel']."',url_amigavel_ativa='".$_POST['url_amigavel_ativa']."',titulo_seo='".$_POST['titulo_seo']."',texto_seo='".$_POST['texto_seo']."' WHERE id='".$itemAtual['id']."'");
								}
							} else {
								$nEstrutura = mysql_num_rows(mysql_query("SELECT * FROM ".$mod."_estrutura"));

								if(trim($_POST['ordem'])=="") { $_POST['ordem']=0; } else { $_POST['ordem']=1; }
								if(trim($_POST['destaque'])=="") { $_POST['destaque']=0; } else { $_POST['destaque']=1; }
								if(trim($_POST['nome'])=="") { $_POST['nome']=0; } else { $_POST['nome']=1; }
								if(trim($_POST['imagem'])=="") { $_POST['imagem']=0; } else { $_POST['imagem']=1; }
								if(trim($_POST['tipo'])=="") { $_POST['tipo']=0; } else { $_POST['tipo']=1; }
								if(trim($_POST['link'])=="") { $_POST['link']=0; } else { $_POST['link']=1; }

								if($nEstrutura==0) { 
									$insert = mysql_query("INSERT INTO ".$mod."_estrutura (
																						  campo_ordem_1,
																						  campo_ordem_tipo_1,
																						  campo_ordem_2,
																						  campo_ordem_tipo_2,

																						  ordem,
																						  nome,
																						  destaque,
																						  imagem,
																						  tipo,
																						  link,
																						  
																						  ordem_label,
																						  nome_label,
																						  destaque_label,
																						  imagem_label,
																						  tipo_label,
																						  link_label,

																						  ordem_info,
																						  nome_info,
																						  destaque_info,
																						  imagem_info,
																						  tipo_info,
																						  link_info
																						  
																						  )
																						  
																						  VALUES
																						  
																						  
																						  (
																						  '".$_POST['campo_ordem_1']."',
																						  '".$_POST['campo_ordem_tipo_1']."',
																						  '".$_POST['campo_ordem_2']."',
																						  '".$_POST['campo_ordem_tipo_2']."',

																						  '".$_POST['ordem']."',
																						  '".$_POST['nome']."',
																						  '".$_POST['destaque']."',
																						  '".$_POST['imagem']."',
																						  '".$_POST['tipo']."',
																						  '".$_POST['link']."',
																						  
																						  '".$_POST['ordem_label']."',
																						  '".$_POST['nome_label']."',
																						  '".$_POST['destaque_label']."',
																						  '".$_POST['imagem_label']."',
																						  '".$_POST['tipo_label']."',
																						  '".$_POST['link_label']."',
																						  
																						  '".$_POST['ordem_info']."',
																						  '".$_POST['nome_info']."',
																						  '".$_POST['destaque_info']."',
																						  '".$_POST['imagem_info']."',
																						  '".$_POST['tipo_info']."',
																						  '".$_POST['link_info']."'
																						  
																						  )");
								} else {
									$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_estrutura LIMIT 1"));
									
			
									$update = mysql_query("UPDATE ".$mod."_estrutura SET 
																						 campo_ordem_1='".$_POST['campo_ordem_1']."',
																						 campo_ordem_tipo_1='".$_POST['campo_ordem_tipo_1']."',
																						 campo_ordem_2='".$_POST['campo_ordem_2']."',
																						 campo_ordem_tipo_2='".$_POST['campo_ordem_tipo_2']."',

																						 ordem='".$_POST['ordem']."',
																						 nome='".$_POST['nome']."',
																						 destaque='".$_POST['destaque']."',
																						 imagem='".$_POST['imagem']."',
																						 tipo='".$_POST['tipo']."',
																						 link='".$_POST['link']."',

																						 ordem_label='".$_POST['ordem_label']."',
																						 nome_label='".$_POST['nome_label']."',
																						 destaque_label='".$_POST['destaque_label']."',
																						 imagem_label='".$_POST['imagem_label']."',
																						 tipo_label='".$_POST['tipo_label']."',
																						 link_label='".$_POST['link_label']."',

																						 ordem_info='".$_POST['ordem_info']."',
																						 nome_info='".$_POST['nome_info']."',
																						 destaque_info='".$_POST['destaque_info']."',
																						 imagem_info='".$_POST['imagem_info']."',
																						 tipo_info='".$_POST['tipo_info']."',
																						 link_info='".$_POST['link_info']."'
																						 
																						 WHERE id='".$itemAtual['id']."'");
								}
							}
						}
					}
				}

			}
		}
	}

	echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
?>