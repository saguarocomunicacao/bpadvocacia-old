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

		$_POST['data_post'] = normalTOdate($_POST['data_post']);
		$_POST['data_publicacao'] = normalTOdate($_POST['data_publicacao']);
		$_POST['data_despublicacao'] = normalTOdate($_POST['data_despublicacao']);

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

			$_POST['data_post'] = normalTOdate($_POST['data_post']);
			$_POST['data_publicacao'] = normalTOdate($_POST['data_publicacao']);
			$_POST['data_despublicacao'] = normalTOdate($_POST['data_despublicacao']);

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

					if(trim($_POST['produtos_set'])=="") { $_POST['produtos_set']=0; } else { $_POST['produtos_set']=1; }
					if(trim($_POST['texto_promocao_set'])=="") { $_POST['texto_promocao_set']=0; } else { $_POST['texto_promocao_set']=1; }

					$insert = mysql_query("INSERT INTO ".$mod."_config (
					                                                    nome,
																		imagem_descricao,
																		imagem_interna,
																		chamada_descricao,
																		texto_descricao,
																		titulo_texto,
																		produtos_set,
																		texto_promocao_set,
																		texto_promocao
																		) 
																		VALUES 
																		(
																		'".$_POST['nome']."',
																		'".$_POST['imagem_descricao']."',
																		'".$_POST['imagem_interna']."',
																		'".$_POST['chamada_descricao']."',
																		'".$_POST['texto_descricao']."',
																		'".$_POST['titulo_texto']."',
																		'".$_POST['produtos_set']."',
																		'".$_POST['texto_promocao_set']."',
																		'".$_POST['texto_promocao']."'
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

					if(trim($_POST['produtos_set'])=="") { $_POST['produtos_set']=0; } else { $_POST['produtos_set']=1; }
					if(trim($_POST['texto_promocao_set'])=="") { $_POST['texto_promocao_set']=0; } else { $_POST['texto_promocao_set']=1; }

					$update = mysql_query("UPDATE ".$mod."_config SET 
					                                                 nome='".$_POST['nome']."',
																	 imagem_descricao='".$_POST['imagem_descricao']."',
																	 imagem_interna='".$_POST['imagem_interna']."',
																	 chamada_descricao='".$_POST['chamada_descricao']."',
																	 texto_descricao='".$_POST['texto_descricao']."',
																	 titulo_texto='".$_POST['titulo_texto']."',
																	 produtos_set='".$_POST['produtos_set']."', 
																	 texto_promocao_set='".$_POST['texto_promocao_set']."', 
																	 texto_promocao='".$_POST['texto_promocao']."' 
																	 
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
								if(trim($_POST['galeria'])=="") { $_POST['galeria']=0; } else { $_POST['galeria']=1; }
								if(trim($_POST['video'])=="") { $_POST['video']=0; } else { $_POST['video']=1; }
								if(trim($_POST['seo'])=="") { $_POST['seo']=0; } else { $_POST['seo']=1; }
								if(trim($_POST['seo_item'])=="") { $_POST['seo_item']=0; } else { $_POST['seo_item']=1; }
								if(trim($_POST['nome_seo'])=="") { $_POST['nome_seo']=0; } else { $_POST['nome_seo']=1; }
								if(trim($_POST['imagem_descricao'])=="") { $_POST['imagem_descricao']=0; } else { $_POST['imagem_descricao']=1; }
								if(trim($_POST['imagem_interna'])=="") { $_POST['imagem_interna']=0; } else { $_POST['imagem_interna']=1; }
								if(trim($_POST['titulo_texto'])=="") { $_POST['titulo_texto']=0; } else { $_POST['titulo_texto']=1; }
								if(trim($_POST['chamada_descricao'])=="") { $_POST['chamada_descricao']=0; } else { $_POST['chamada_descricao']=1; }
								if(trim($_POST['texto_descricao'])=="") { $_POST['texto_descricao']=0; } else { $_POST['texto_descricao']=1; }
								if(trim($_POST['texto_promocao'])=="") { $_POST['texto_promocao']=0; } else { $_POST['texto_promocao']=1; }

								if(trim($_POST['idproduto_categoria'])=="") { $_POST['idproduto_categoria']=0; } else { $_POST['idproduto_categoria']=1; }
								if(trim($_POST['lista_postagem'])=="") { $_POST['lista_postagem']=0; } else { $_POST['lista_postagem']=1; }
								if(trim($_POST['ordem'])=="") { $_POST['ordem']=0; } else { $_POST['ordem']=1; }
								if(trim($_POST['destaque'])=="") { $_POST['destaque']=0; } else { $_POST['destaque']=1; }
								if(trim($_POST['nome'])=="") { $_POST['nome']=0; } else { $_POST['nome']=1; }
								if(trim($_POST['valor'])=="") { $_POST['valor']=0; } else { $_POST['valor']=1; }
								if(trim($_POST['imagem'])=="") { $_POST['imagem']=0; } else { $_POST['imagem']=1; }
								if(trim($_POST['chamada'])=="") { $_POST['chamada']=0; } else { $_POST['chamada']=1; }
								if(trim($_POST['texto'])=="") { $_POST['texto']=0; } else { $_POST['texto']=1; }
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
																						  galeria,
																						  video,
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

																						  idproduto_categoria,
																						  lista_postagem,
																						  ordem,
																						  nome,
																						  valor,
																						  imagem,
																						  destaque,
																						  chamada,
																						  texto,
																						  data_publicacao,
																						  data_despublicacao,
																						  data_post,
																						  hora_post,
																						  
																						  
																						  seo_label,
																						  seo_item_label,
																						  idproduto_categoria_label,
																						  lista_postagem_label,
																						  ordem_label,
																						  nome_label,
																						  valor_label,
																						  imagem_label,
																						  destaque_label,
																						  chamada_label,
																						  texto_label,
																						  data_publicacao_label,
																						  data_despublicacao_label,
																						  data_post_label,
																						  hora_post_label,
																						  
																						  texto_promocao,
																						  texto_promocao_label,
																						  texto_promocao_info,
																						  
																						  
																						  idproduto_categoria_info,
																						  lista_postagem_info,
																						  ordem_info,
																						  nome_info,
																						  valor_info,
																						  imagem_info,
																						  destaque_info,
																						  chamada_info,
																						  texto_info,
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
																						  '".$_POST['galeria']."',
																						  '".$_POST['video']."',
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
			
																						  '".$_POST['idproduto_categoria']."',
																						  '".$_POST['lista_postagem']."',
																						  '".$_POST['ordem']."',
																						  '".$_POST['nome']."',
																						  '".$_POST['valor']."',
																						  '".$_POST['imagem']."',
																						  '".$_POST['destaque']."',
																						  '".$_POST['chamada']."',
																						  '".$_POST['texto']."',
																						  '".$_POST['data_publicacao']."',
																						  '".$_POST['data_despublicacao']."',
																						  '".$_POST['data_post']."',
																						  '".$_POST['hora_post']."',
																						  
																						  
																						  '".$_POST['seo_label']."',
																						  '".$_POST['seo_item_label']."',
																						  '".$_POST['idproduto_categoria_label']."',
																						  '".$_POST['lista_postagem_label']."',
																						  '".$_POST['ordem_label']."',
																						  '".$_POST['nome_label']."',
																						  '".$_POST['valor_label']."',
																						  '".$_POST['imagem_label']."',
																						  '".$_POST['destaque_label']."',
																						  '".$_POST['chamada_label']."',
																						  '".$_POST['texto_label']."',
																						  '".$_POST['data_publicacao_label']."',
																						  '".$_POST['data_despublicacao_label']."',
																						  '".$_POST['data_post_label']."',
																						  '".$_POST['hora_post_label']."',

																						  '".$_POST['texto_promocao']."',
																						  '".$_POST['texto_promocao_label']."',
																						  '".$_POST['texto_promocao_info']."',
																						  
																						  
																						  '".$_POST['idproduto_categoria_info']."',
																						  '".$_POST['lista_postagem_info']."',
																						  '".$_POST['ordem_info']."',
																						  '".$_POST['nome_info']."',
																						  '".$_POST['valor_info']."',
																						  '".$_POST['imagem_info']."',
																						  '".$_POST['destaque_info']."',
																						  '".$_POST['chamada_info']."',
																						  '".$_POST['texto_info']."',
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
																						 galeria='".$_POST['galeria']."',
																						 video='".$_POST['video']."',
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
			
																						 idproduto_categoria='".$_POST['idproduto_categoria']."',
																						 lista_postagem='".$_POST['lista_postagem']."',
																						 ordem='".$_POST['ordem']."',
																						 nome='".$_POST['nome']."',
																						 valor='".$_POST['valor']."',
																						 imagem='".$_POST['imagem']."',
																						 destaque='".$_POST['destaque']."',
																						 chamada='".$_POST['chamada']."',
																						 texto='".$_POST['texto']."',
																						 data_publicacao='".$_POST['data_publicacao']."', 
																						 data_despublicacao='".$_POST['data_despublicacao']."', 
																						 data_post='".$_POST['data_post']."', 
																						 hora_post='".$_POST['hora_post']."', 

																						 seo_label='".$_POST['seo_label']."',
																						 seo_item_label='".$_POST['seo_item_label']."',
																						 idproduto_categoria_label='".$_POST['idproduto_categoria_label']."',
																						 lista_postagem_label='".$_POST['lista_postagem_label']."',
																						 ordem_label='".$_POST['ordem_label']."',
																						 nome_label='".$_POST['nome_label']."',
																						 valor_label='".$_POST['valor_label']."',
																						 imagem_label='".$_POST['imagem_label']."',
																						 destaque_label='".$_POST['destaque_label']."',
																						 chamada_label='".$_POST['chamada_label']."',
																						 texto_label='".$_POST['texto_label']."',
																						 data_publicacao_label='".$_POST['data_publicacao_label']."', 
																						 data_despublicacao_label='".$_POST['data_despublicacao_label']."', 
																						 data_post_label='".$_POST['data_post_label']."', 
																						 hora_post_label='".$_POST['hora_post_label']."', 

																						 texto_promocao='".$_POST['texto_promocao']."', 
																						 texto_promocao_label='".$_POST['texto_promocao_label']."', 
																						 texto_promocao_info='".$_POST['texto_promocao_info']."', 

																						 idproduto_categoria_info='".$_POST['idproduto_categoria_info']."',
																						 lista_postagem_info='".$_POST['lista_postagem_info']."',
																						 ordem_info='".$_POST['ordem_info']."',
																						 nome_info='".$_POST['nome_info']."',
																						 valor_info='".$_POST['valor_info']."',
																						 imagem_info='".$_POST['imagem_info']."',
																						 destaque_info='".$_POST['destaque_info']."',
																						 chamada_info='".$_POST['chamada_info']."',
																						 texto_info='".$_POST['texto_info']."',
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

	echo"<script>window.open('".$link."".$_REQUEST['var2']."/','_self','')</script>";
?>