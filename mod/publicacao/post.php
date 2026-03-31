<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add") {

		upload_arquivo($mod."","imagem","");
		
		if(trim($_POST['destaque'])=="") { $_POST['destaque']=0; } else { $_POST['destaque']=1; }

		$_POST['data_post'] = normalTOdate($_POST['data_post']);
		$_POST['data_publicacao'] = normalTOdate($_POST['data_publicacao']);
		$_POST['data_despublicacao'] = normalTOdate($_POST['data_despublicacao']);

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

			upload_arquivo($mod."","imagem","");

			if(trim($_POST['destaque'])=="") { $_POST['destaque']=0; } else { $_POST['destaque']=1; }

			$_POST['data_post'] = normalTOdate($_POST['data_post']);
			$_POST['data_publicacao'] = normalTOdate($_POST['data_publicacao']);
			$_POST['data_despublicacao'] = normalTOdate($_POST['data_despublicacao']);

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
								if(trim($_POST['lista_categorias'])=="") { $_POST['lista_categorias']=0; } else { $_POST['lista_categorias']=1; }
								if(trim($_POST['lista_postagem'])=="") { $_POST['lista_postagem']=0; } else { $_POST['lista_postagem']=1; }
								if(trim($_POST['destaque'])=="") { $_POST['destaque']=0; } else { $_POST['destaque']=1; }
								if(trim($_POST['nome'])=="") { $_POST['nome']=0; } else { $_POST['nome']=1; }
								if(trim($_POST['autor'])=="") { $_POST['autor']=0; } else { $_POST['autor']=1; }
								if(trim($_POST['imagem'])=="") { $_POST['imagem']=0; } else { $_POST['imagem']=1; }
								if(trim($_POST['chamada'])=="") { $_POST['chamada']=0; } else { $_POST['chamada']=1; }
								if(trim($_POST['texto'])=="") { $_POST['texto']=0; } else { $_POST['texto']=1; }
								if(trim($_POST['link_video'])=="") { $_POST['link_video']=0; } else { $_POST['link_video']=1; }
								if(trim($_POST['data_publicacao'])=="") { $_POST['data_publicacao']=0; } else { $_POST['data_publicacao']=1; }
								if(trim($_POST['data_despublicacao'])=="") { $_POST['data_despublicacao']=0; } else { $_POST['data_despublicacao']=1; }
								if(trim($_POST['data_post'])=="") { $_POST['data_post']=0; } else { $_POST['data_post']=1; }
								if(trim($_POST['hora_post'])=="") { $_POST['hora_post']=0; } else { $_POST['hora_post']=1; }

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

																						  lista_categorias,
																						  lista_postagem,
																						  nome,
																						  autor,
																						  destaque,
																						  imagem,
																						  chamada,
																						  texto,
																						  link_video,
																						  data_publicacao,
																						  data_despublicacao,
																						  data_post,
																						  hora_post,
																						  
																						  
																						  seo_label,
																						  seo_item_label,
																						  lista_categorias_label,
																						  lista_postagem_label,
																						  nome_label,
																						  autor_label,
																						  destaque_label,
																						  imagem_label,
																						  chamada_label,
																						  texto_label,
																						  link_video_label,
																						  data_publicacao_label,
																						  data_despublicacao_label,
																						  data_post_label,
																						  hora_post_label,
																						  
																						  
																						  lista_categorias_info,
																						  lista_postagem_info,
																						  nome_info,
																						  autor_info,
																						  destaque_info,
																						  imagem_info,
																						  chamada_info,
																						  texto_info,
																						  link_video_info,
																						  data_publicacao_info,
																						  data_despublicacao_info,
																						  data_post_info,
																						  hora_post_info
																						  
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
			
																						  '".$_POST['lista_categorias']."',
																						  '".$_POST['lista_postagem']."',
																						  '".$_POST['nome']."',
																						  '".$_POST['autor']."',
																						  '".$_POST['destaque']."',
																						  '".$_POST['imagem']."',
																						  '".$_POST['chamada']."',
																						  '".$_POST['texto']."',
																						  '".$_POST['link_video']."',
																						  '".$_POST['data_publicacao']."',
																						  '".$_POST['data_despublicacao']."',
																						  '".$_POST['data_post']."',
																						  '".$_POST['hora_post']."',
																						  
																						  
																						  '".$_POST['seo_label']."',
																						  '".$_POST['seo_item_label']."',
																						  '".$_POST['lista_categorias_label']."',
																						  '".$_POST['lista_postagem_label']."',
																						  '".$_POST['nome_label']."',
																						  '".$_POST['autor_label']."',
																						  '".$_POST['destaque_label']."',
																						  '".$_POST['imagem_label']."',
																						  '".$_POST['chamada_label']."',
																						  '".$_POST['texto_label']."',
																						  '".$_POST['link_video_label']."',
																						  '".$_POST['data_publicacao_label']."',
																						  '".$_POST['data_despublicacao_label']."',
																						  '".$_POST['data_post_label']."',
																						  '".$_POST['hora_post_label']."',
																						  
																						  
																						  '".$_POST['lista_categorias_info']."',
																						  '".$_POST['lista_postagem_info']."',
																						  '".$_POST['nome_info']."',
																						  '".$_POST['autor_info']."',
																						  '".$_POST['destaque_info']."',
																						  '".$_POST['imagem_info']."',
																						  '".$_POST['chamada_info']."',
																						  '".$_POST['texto_info']."',
																						  '".$_POST['link_video_info']."',
																						  '".$_POST['data_publicacao_info']."',
																						  '".$_POST['data_despublicacao_info']."',
																						  '".$_POST['data_post_info']."',
																						  '".$_POST['hora_post_info']."'
																						  
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
			
																						 lista_categorias='".$_POST['lista_categorias']."',
																						 lista_postagem='".$_POST['lista_postagem']."',
																						 nome='".$_POST['nome']."',
																						 autor='".$_POST['autor']."',
																						 destaque='".$_POST['destaque']."',
																						 imagem='".$_POST['imagem']."',
																						 chamada='".$_POST['chamada']."',
																						 texto='".$_POST['texto']."',
																						 link_video='".$_POST['link_video']."',
																						 data_publicacao='".$_POST['data_publicacao']."', 
																						 data_despublicacao='".$_POST['data_despublicacao']."', 
																						 data_post='".$_POST['data_post']."', 
																						 hora_post='".$_POST['hora_post']."', 

																						 seo_label='".$_POST['seo_label']."',
																						 seo_item_label='".$_POST['seo_item_label']."',
																						 lista_categorias_label='".$_POST['lista_categorias_label']."',
																						 lista_postagem_label='".$_POST['lista_postagem_label']."',
																						 nome_label='".$_POST['nome_label']."',
																						 autor_label='".$_POST['autor_label']."',
																						 destaque_label='".$_POST['destaque_label']."',
																						 imagem_label='".$_POST['imagem_label']."',
																						 chamada_label='".$_POST['chamada_label']."',
																						 texto_label='".$_POST['texto_label']."',
																						 link_video_label='".$_POST['link_video_label']."',
																						 data_publicacao_label='".$_POST['data_publicacao_label']."', 
																						 data_despublicacao_label='".$_POST['data_despublicacao_label']."', 
																						 data_post_label='".$_POST['data_post_label']."', 
																						 hora_post_label='".$_POST['hora_post_label']."', 

																						 lista_categorias_info='".$_POST['lista_categorias_info']."',
																						 lista_postagem_info='".$_POST['lista_postagem_info']."',
																						 nome_info='".$_POST['nome_info']."',
																						 autor_info='".$_POST['autor_info']."',
																						 destaque_info='".$_POST['destaque_info']."',
																						 imagem_info='".$_POST['imagem_info']."',
																						 chamada_info='".$_POST['chamada_info']."',
																						 texto_info='".$_POST['texto_info']."',
																						 link_video_info='".$_POST['link_video_info']."',
																						 data_publicacao_info='".$_POST['data_publicacao_info']."', 
																						 data_despublicacao_info='".$_POST['data_despublicacao_info']."', 
																						 data_post_info='".$_POST['data_post_info']."', 
																						 hora_post_info='".$_POST['hora_post_info']."' 
																						 
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