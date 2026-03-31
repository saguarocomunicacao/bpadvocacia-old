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

					# Gravação do Log
					$logPerfil = "administrador";
					$logId = $sysusu['id'];
					$logAcao = "Adicionar";
					$logLocal = "".$caminho1."";
					$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
					$logData = $data;
					gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

					$campo_imagem = "imagem_descricao";
					if(trim($_FILES[$campo_imagem]["name"])=="") {
					} else {
						upload_arquivo($mod,$campo_imagem,"_config");
					}

					$campo_imagem = "imagem_interna";
					if(trim($_FILES[$campo_imagem]["name"])=="") {
					} else {
						upload_arquivo($mod,$campo_imagem,"_config");
					}
					$insert = mysql_query("INSERT INTO ".$mod."_config (
					                                                    nome,
																		imagem_descricao,
																		imagem_interna,
																		chamada_descricao,
																		texto_descricao,
																		titulo_texto
																		) 
																		VALUES 
																		(
																		'".$_POST['nome']."',
																		'".$_POST['imagem_descricao']."',
																		'".$_POST['imagem_interna']."',
																		'".$_POST['chamada_descricao']."',
																		'".$_POST['texto_descricao']."',
																		'".$_POST['titulo_texto']."'
																		)");
				} else {
					$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_config ORDER BY data LIMIT 1"));


					# Gravação do Log
					$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_config WHERE id='".$itemAtual['id']."'"));
					$logPerfil = "administrador";
					$logId = $sysusu['id'];
					$logAcao = "Editou";
					$logLocal = "".$caminho1."";
					$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
					$logData = $data;
					gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

					$campo_imagem = "imagem_descricao";
					if(trim($_FILES[$campo_imagem]["name"])=="") {
						$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
					} else {
						upload_arquivo($mod,$campo_imagem,"_config");
					}

					$campo_imagem = "imagem_interna";
					if(trim($_FILES[$campo_imagem]["name"])=="") {
						$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
					} else {
						upload_arquivo($mod,$campo_imagem,"_config");
					}
					$update = mysql_query("UPDATE ".$mod."_config SET 
					                                                 nome='".$_POST['nome']."',
																	 imagem_descricao='".$_POST['imagem_descricao']."',
																	 imagem_interna='".$_POST['imagem_interna']."',
																	 chamada_descricao='".$_POST['chamada_descricao']."',
																	 texto_descricao='".$_POST['texto_descricao']."',
																	 titulo_texto='".$_POST['titulo_texto']."' 
																	 
																	 WHERE id='".$itemAtual['id']."'");
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

								if(trim($_POST['categoria'])=="") { $_POST['categoria']=0; } else { $_POST['categoria']=1; }
								if(trim($_POST['seo'])=="") { $_POST['seo']=0; } else { $_POST['seo']=1; }
								if(trim($_POST['seo_item'])=="") { $_POST['seo_item']=0; } else { $_POST['seo_item']=1; }
								if(trim($_POST['nome_seo'])=="") { $_POST['nome_seo']=0; } else { $_POST['nome_seo']=1; }
								if(trim($_POST['imagem_descricao'])=="") { $_POST['imagem_descricao']=0; } else { $_POST['imagem_descricao']=1; }
								if(trim($_POST['imagem_interna'])=="") { $_POST['imagem_interna']=0; } else { $_POST['imagem_interna']=1; }
								if(trim($_POST['titulo_texto'])=="") { $_POST['titulo_texto']=0; } else { $_POST['titulo_texto']=1; }
								if(trim($_POST['chamada_descricao'])=="") { $_POST['chamada_descricao']=0; } else { $_POST['chamada_descricao']=1; }
								if(trim($_POST['texto_descricao'])=="") { $_POST['texto_descricao']=0; } else { $_POST['texto_descricao']=1; }

								if(trim($_POST['idlink_util_categoria'])=="") { $_POST['idlink_util_categoria']=0; } else { $_POST['idlink_util_categoria']=1; }
								if(trim($_POST['ordem'])=="") { $_POST['ordem']=0; } else { $_POST['ordem']=1; }
								if(trim($_POST['nome'])=="") { $_POST['nome']=0; } else { $_POST['nome']=1; }
								if(trim($_POST['link'])=="") { $_POST['link']=0; } else { $_POST['link']=1; }
								if(trim($_POST['imagem'])=="") { $_POST['imagem']=0; } else { $_POST['imagem']=1; }
								if(trim($_POST['texto'])=="") { $_POST['texto']=0; } else { $_POST['texto']=1; }
								if(trim($_POST['chamada'])=="") { $_POST['chamada']=0; } else { $_POST['chamada']=1; }

								if($nEstrutura==0) { 
									$insert = mysql_query("INSERT INTO ".$mod."_estrutura (
																						  campo_ordem_1,
																						  campo_ordem_tipo_1,
																						  campo_ordem_2,
																						  campo_ordem_tipo_2,

																						  categoria,
																						  seo,
																						  seo_item,

																						  nome_seo,
																						  imagem_descricao,
																						  imagem_interna,
																						  chamada_descricao,
																						  texto_descricao,
																						  titulo_texto, 
																						  nome_seo_label,
																						  imagem_descricao_label,
																						  imagem_interna_label,
																						  chamada_descricao_label,
																						  texto_descricao_label,
																						  titulo_texto_label,
																						  nome_seo_info,
																						  imagem_descricao_info,
																						  imagem_interna_info,
																						  chamada_descricao_info,
																						  texto_descricao_info,
																						  titulo_texto_info, 

																						  idlink_util_categoria,
																						  ordem,
																						  nome,
																						  link,
																						  imagem,
																						  texto,
																						  chamada,
																						  
																						  
																						  seo_label,
																						  seo_item_label,
																						  idlink_util_categoria_label,
																						  ordem_label,
																						  nome_label,
																						  link_label,
																						  imagem_label,
																						  texto_label,
																						  chamada_label,
																						  
																						  
																						  idlink_util_categoria_info,
																						  ordem_info,
																						  nome_info,
																						  link_info,
																						  imagem_info,
																						  texto_info,
																						  chamada_info
																						  
																						  )
																						  
																						  VALUES
																						  
																						  
																						  (
																						  '".$_POST['campo_ordem_1']."',
																						  '".$_POST['campo_ordem_tipo_1']."',
																						  '".$_POST['campo_ordem_2']."',
																						  '".$_POST['campo_ordem_tipo_2']."',

																						  '".$_POST['categoria']."',
																						  '".$_POST['seo']."',
																						  '".$_POST['seo_item']."',

 																						  '".$_POST['nome_seo']."',
																						  '".$_POST['imagem_descricao']."',
																						  '".$_POST['imagem_interna']."',
																						  '".$_POST['chamada_descricao']."',
																						  '".$_POST['texto_descricao']."',
																						  '".$_POST['titulo_texto']."',
																						  '".$_POST['nome_seo_label']."',
																						  '".$_POST['imagem_descricao_label']."',
																						  '".$_POST['imagem_interna_label']."',
																						  '".$_POST['chamada_descricao_label']."',
																						  '".$_POST['texto_descricao_label']."',
																						  '".$_POST['titulo_texto_label']."',
																						  '".$_POST['nome_seo_info']."',
																						  '".$_POST['imagem_descricao_info']."',
																						  '".$_POST['imagem_interna_info']."',
																						  '".$_POST['chamada_descricao_info']."',
																						  '".$_POST['texto_descricao_info']."',
																						  '".$_POST['titulo_texto_info']."',
			
																						  '".$_POST['idlink_util_categoria']."',
																						  '".$_POST['ordem']."',
																						  '".$_POST['nome']."',
																						  '".$_POST['link']."',
																						  '".$_POST['imagem']."',
																						  '".$_POST['texto']."',
																						  '".$_POST['chamada']."',
																						  
																						  
																						  '".$_POST['seo_label']."',
																						  '".$_POST['seo_item_label']."',
																						  '".$_POST['idlink_util_categoria_label']."',
																						  '".$_POST['ordem_label']."',
																						  '".$_POST['nome_label']."',
																						  '".$_POST['link_label']."',
																						  '".$_POST['imagem_label']."',
																						  '".$_POST['texto_label']."',
																						  '".$_POST['chamada_label']."',
																						  
																						  
																						  '".$_POST['idlink_util_categoria_info']."',
																						  '".$_POST['ordem_info']."',
																						  '".$_POST['nome_info']."',
																						  '".$_POST['link_info']."',
																						  '".$_POST['imagem_info']."',
																						  '".$_POST['texto_info']."',
																						  '".$_POST['chamada_info']."'
																						  
																						  )");
								} else {
									$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_estrutura LIMIT 1"));
									
			
									$update = mysql_query("UPDATE ".$mod."_estrutura SET 
																						 campo_ordem_1='".$_POST['campo_ordem_1']."',
																						 campo_ordem_tipo_1='".$_POST['campo_ordem_tipo_1']."',
																						 campo_ordem_2='".$_POST['campo_ordem_2']."',
																						 campo_ordem_tipo_2='".$_POST['campo_ordem_tipo_2']."',

																						 categoria='".$_POST['categoria']."',
																						 seo='".$_POST['seo']."',
																						 seo_item='".$_POST['seo_item']."',

																						 nome_seo='".$_POST['nome_seo']."',
																						 imagem_descricao='".$_POST['imagem_descricao']."',
																						 imagem_interna='".$_POST['imagem_interna']."',
																						 chamada_descricao='".$_POST['chamada_descricao']."',
																						 texto_descricao='".$_POST['texto_descricao']."',
																						 titulo_texto='".$_POST['titulo_texto']."', 
																						 seo_label='".$_POST['seo_label']."',
																						 nome_seo_label='".$_POST['nome_seo_label']."',
																						 imagem_descricao_label='".$_POST['imagem_descricao_label']."',
																						 imagem_interna_label='".$_POST['imagem_interna_label']."',
																						 chamada_descricao_label='".$_POST['chamada_descricao_label']."',
																						 texto_descricao_label='".$_POST['texto_descricao_label']."',
																						 titulo_texto_label='".$_POST['titulo_texto_label']."', 
																						 nome_seo_info='".$_POST['nome_seo_info']."',
																						 imagem_descricao_info='".$_POST['imagem_descricao_info']."',
																						 imagem_interna_info='".$_POST['imagem_interna_info']."',
																						 chamada_descricao_info='".$_POST['chamada_descricao_info']."',
																						 texto_descricao_info='".$_POST['texto_descricao_info']."',
																						 titulo_texto_info='".$_POST['titulo_texto_info']."',
			
																						 idlink_util_categoria='".$_POST['idlink_util_categoria']."',
																						 ordem='".$_POST['ordem']."',
																						 nome='".$_POST['nome']."',
																						 link='".$_POST['link']."',
																						 imagem='".$_POST['imagem']."',
																						 texto='".$_POST['texto']."',
																						 chamada='".$_POST['chamada']."',

																						 seo_label='".$_POST['seo_label']."',
																						 seo_item_label='".$_POST['seo_item_label']."',
																						 idlink_util_categoria_label='".$_POST['idlink_util_categoria_label']."',
																						 ordem_label='".$_POST['ordem_label']."',
																						 nome_label='".$_POST['nome_label']."',
																						 link_label='".$_POST['link_label']."',
																						 imagem_label='".$_POST['imagem_label']."',
																						 texto_label='".$_POST['texto_label']."',
																						 chamada_label='".$_POST['chamada_label']."',

																						 idlink_util_categoria_info='".$_POST['idlink_util_categoria_info']."',
																						 ordem_info='".$_POST['ordem_info']."',
																						 nome_info='".$_POST['nome_info']."',
																						 link_info='".$_POST['link_info']."',
																						 imagem_info='".$_POST['imagem_info']."',
																						 texto_info='".$_POST['texto_info']."',
																						 chamada_info='".$_POST['chamada_info']."'
																						 
																						 WHERE id='".$itemAtual['id']."'");
								}
							}
						}
					}
				}

			}
		}
	}

	echo"<script>window.open('".$link."".$_REQUEST['var2']."/','_self','')</script>";
?>