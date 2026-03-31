<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add"||trim($_POST['acaoForm'])=="add-continuar"||trim($_POST['acaoForm'])=="add-clone") {

		if(trim($_POST['acaoForm'])=="add-clone") {
			$_POST['numeroUnico'] = geraCodReturn();
			$_POST['ordem'] = $_POST['ordem'] + 1;

			$CaracteresAceitos1 = 'abcdefghijklmnopqrstuwxyz';
			$max1 = strlen($CaracteresAceitos1)-1;
			$cod1 = null;
			for($i=0; $i < 3; $i++) {
				$cod1 .= $CaracteresAceitos1{mt_rand(0, $max1)};
			}
			
			$i=0;
			$CaracteresAceitos = '0123456789';
			$max = strlen($CaracteresAceitos)-1;
			$cod = null;
			for($i=0; $i < 5; $i++) {
				$cod .= $CaracteresAceitos{mt_rand(0, $max)};
			}
			$_POST['cod'] = strtoupper($cod1.$cod);
			
		}

		if(trim($_POST['destaque'])=="") { $_POST['destaque']=0; } else { $_POST['destaque']=1; }
		if(trim($_POST['promocao'])=="") { $_POST['promocao']=0; } else { $_POST['promocao']=1; }
		if(trim($_POST['lancamento'])=="") { $_POST['lancamento']=0; } else { $_POST['lancamento']=1; }

		$_POST['data_post'] = normalTOdate($_POST['data_post']);
		$_POST['data_publicacao'] = normalTOdate($_POST['data_publicacao']);
		$_POST['data_despublicacao'] = normalTOdate($_POST['data_despublicacao']);

		upload_arquivo($mod."","imagem","");

		$itemN = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
		if(trim($_POST['acaoForm'])=="add-continuar"&&$itemN>0) {
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
			$idEditavel = $item['id'];

			if(trim($_POST['ordem'])==trim($item['ordem'])) {
			} else {
				$qall = mysql_query("SELECT * FROM ".$mod."");
				while($rall = mysql_fetch_array($qall)) {
					if($rall['ordem'] > $item['ordem']) {
						$ordem = $rall['ordem'] - 1;
						$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
					}
				}
		
				$qall = mysql_query("SELECT * FROM ".$mod." WHERE id NOT IN('".$idEditavel."')");
				while($rall = mysql_fetch_array($qall)) {
					if($rall['ordem'] >= $_POST['ordem']) {
						$ordem = $rall['ordem'] + 1;
						$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
					}
				}
			}
			# Gravação do Log
			$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Salvou e Continou Editando";
			$logLocal = "".$caminho1."";
			$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
			$logData = $data;

			$_POST['dataModificacao'] = $data;

			update($_POST,$mod."",$idEditavel);

		} else {
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
	
			$_POST['data'] = $data;
			$_POST['dataModificacao'] = $data;
	
			insert($_POST,$mod."");
		}
		
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
			if(trim($_POST['promocao'])=="") { $_POST['promocao']=0; } else { $_POST['promocao']=1; }
			if(trim($_POST['lancamento'])=="") { $_POST['lancamento']=0; } else { $_POST['lancamento']=1; }

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
								if(trim($_POST['texto_promocao'])=="") { $_POST['texto_promocao']=0; } else { $_POST['texto_promocao']=1; }

								if(trim($_POST['idsysmodulos_categoria'])=="") { $_POST['idsysmodulos_categoria']=0; } else { $_POST['idsysmodulos_categoria']=1; }
								if(trim($_POST['ordem'])=="") { $_POST['ordem']=0; } else { $_POST['ordem']=1; }
								if(trim($_POST['nome'])=="") { $_POST['nome']=0; } else { $_POST['nome']=1; }
								if(trim($_POST['cod'])=="") { $_POST['cod']=0; } else { $_POST['cod']=1; }
								if(trim($_POST['tags'])=="") { $_POST['tags']=0; } else { $_POST['tags']=1; }
								if(trim($_POST['valor'])=="") { $_POST['valor']=0; } else { $_POST['valor']=1; }
								if(trim($_POST['promocao'])=="") { $_POST['promocao']=0; } else { $_POST['promocao']=1; }
								if(trim($_POST['valor_promocao'])=="") { $_POST['valor_promocao']=0; } else { $_POST['valor_promocao']=1; }
								if(trim($_POST['valor_mensalidade'])=="") { $_POST['valor_mensalidade']=0; } else { $_POST['valor_mensalidade']=1; }
								if(trim($_POST['imagem'])=="") { $_POST['imagem']=0; } else { $_POST['imagem']=1; }
								if(trim($_POST['chamada'])=="") { $_POST['chamada']=0; } else { $_POST['chamada']=1; }
								if(trim($_POST['texto'])=="") { $_POST['texto']=0; } else { $_POST['texto']=1; }
								if(trim($_POST['info_produto'])=="") { $_POST['info_produto']=0; } else { $_POST['info_produto']=1; }
								if(trim($_POST['info_tecnica'])=="") { $_POST['info_tecnica']=0; } else { $_POST['info_tecnica']=1; }
								if(trim($_POST['garantia'])=="") { $_POST['garantia']=0; } else { $_POST['garantia']=1; }
								if(trim($_POST['manual'])=="") { $_POST['manual']=0; } else { $_POST['manual']=1; }
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

																						  idsysmodulos_categoria,
																						  ordem,
																						  nome,
																						  cod,
																						  tags,
																						  valor,
																						  promocao,
																						  valor_promocao,
																						  valor_mensalidade,
																						  imagem,
																						  chamada,
																						  texto,
																						  info_produto,
																						  info_tecnica,
																						  garantia,
																						  manual,
																						  data_publicacao,
																						  data_despublicacao,
																						  data_post,
																						  hora_post,
																						  
																						  
																						  seo_label,
																						  seo_item_label,
																						  idsysmodulos_categoria_label,
																						  ordem_label,
																						  nome_label,
																						  cod_label,
																						  tags_label,
																						  valor_label,
																						  promocao_label,
																						  valor_promocao_label,
																						  valor_mensalidade_label,
																						  imagem_label,
																						  chamada_label,
																						  texto_label,
																						  info_produto_label,
																						  info_tecnica_label,
																						  garantia_label,
																						  manual_label,
																						  data_publicacao_label,
																						  data_despublicacao_label,
																						  data_post_label,
																						  hora_post_label,
																						  
																						  texto_promocao,
																						  texto_promocao_label,
																						  texto_promocao_info,
																						  
																						  
																						  idsysmodulos_categoria_info,
																						  ordem_info,
																						  nome_info,
																						  cod_info,
																						  tags_info,
																						  valor_info,
																						  promocao_info,
																						  valor_promocao_info,
																						  valor_mensalidade_info,
																						  imagem_info,
																						  chamada_info,
																						  texto_info,
																						  info_produto_info,
																						  info_tecnica_info,
																						  garantia_info,
																						  manual_info,
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
			
																						  '".$_POST['idsysmodulos_categoria']."',
																						  '".$_POST['ordem']."',
																						  '".$_POST['nome']."',
																						  '".$_POST['cod']."',
																						  '".$_POST['tags']."',
																						  '".$_POST['valor']."',
																						  '".$_POST['promocao']."',
																						  '".$_POST['valor_promocao']."',
																						  '".$_POST['valor_mensalidade']."',
																						  '".$_POST['imagem']."',
																						  '".$_POST['chamada']."',
																						  '".$_POST['texto']."',
																						  '".$_POST['info_produto']."',
																						  '".$_POST['info_tecnica']."',
																						  '".$_POST['garantia']."',
																						  '".$_POST['manual']."',
																						  '".$_POST['data_publicacao']."',
																						  '".$_POST['data_despublicacao']."',
																						  '".$_POST['data_post']."',
																						  '".$_POST['hora_post']."',
																						  
																						  
																						  '".$_POST['seo_label']."',
																						  '".$_POST['seo_item_label']."',
																						  '".$_POST['idsysmodulos_categoria_label']."',
																						  '".$_POST['ordem_label']."',
																						  '".$_POST['nome_label']."',
																						  '".$_POST['cod_label']."',
																						  '".$_POST['tags_label']."',
																						  '".$_POST['valor_label']."',
																						  '".$_POST['promocao_label']."',
																						  '".$_POST['valor_promocao_label']."',
																						  '".$_POST['valor_mensalidade_label']."',
																						  '".$_POST['imagem_label']."',
																						  '".$_POST['chamada_label']."',
																						  '".$_POST['texto_label']."',
																						  '".$_POST['info_produto_label']."',
																						  '".$_POST['info_tecnica_label']."',
																						  '".$_POST['garantia_label']."',
																						  '".$_POST['manual_label']."',
																						  '".$_POST['data_publicacao_label']."',
																						  '".$_POST['data_despublicacao_label']."',
																						  '".$_POST['data_post_label']."',
																						  '".$_POST['hora_post_label']."',

																						  '".$_POST['texto_promocao']."',
																						  '".$_POST['texto_promocao_label']."',
																						  '".$_POST['texto_promocao_info']."',
																						  
																						  
																						  '".$_POST['idsysmodulos_categoria_info']."',
																						  '".$_POST['ordem_info']."',
																						  '".$_POST['nome_info']."',
																						  '".$_POST['cod_info']."',
																						  '".$_POST['tags_info']."',
																						  '".$_POST['valor_info']."',
																						  '".$_POST['promocao_info']."',
																						  '".$_POST['valor_promocao_info']."',
																						  '".$_POST['valor_mensalidade_info']."',
																						  '".$_POST['imagem_info']."',
																						  '".$_POST['chamada_info']."',
																						  '".$_POST['texto_info']."',
																						  '".$_POST['info_produto_info']."',
																						  '".$_POST['info_tecnica_info']."',
																						  '".$_POST['garantia_info']."',
																						  '".$_POST['manual_info']."',
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
			
																						 idsysmodulos_categoria='".$_POST['idsysmodulos_categoria']."',
																						 ordem='".$_POST['ordem']."',
																						 nome='".$_POST['nome']."',
																						 cod='".$_POST['cod']."',
																						 tags='".$_POST['tags']."',
																						 valor='".$_POST['valor']."',
																						 promocao='".$_POST['promocao']."',
																						 valor_promocao='".$_POST['valor_promocao']."',
																						 valor_mensalidade='".$_POST['valor_mensalidade']."',
																						 imagem='".$_POST['imagem']."',
																						 chamada='".$_POST['chamada']."',
																						 texto='".$_POST['texto']."',
																						 info_produto='".$_POST['info_produto']."',
																						 info_tecnica='".$_POST['info_tecnica']."',
																						 garantia='".$_POST['garantia']."',
																						 manual='".$_POST['manual']."',
																						 data_publicacao='".$_POST['data_publicacao']."', 
																						 data_despublicacao='".$_POST['data_despublicacao']."', 
																						 data_post='".$_POST['data_post']."', 
																						 hora_post='".$_POST['hora_post']."', 

																						 seo_label='".$_POST['seo_label']."',
																						 seo_item_label='".$_POST['seo_item_label']."',
																						 idsysmodulos_categoria_label='".$_POST['idsysmodulos_categoria_label']."',
																						 ordem_label='".$_POST['ordem_label']."',
																						 nome_label='".$_POST['nome_label']."',
																						 cod_label='".$_POST['cod_label']."',
																						 tags_label='".$_POST['tags_label']."',
																						 valor_label='".$_POST['valor_label']."',
																						 promocao_label='".$_POST['promocao_label']."',
																						 valor_promocao_label='".$_POST['valor_promocao_label']."',
																						 valor_mensalidade_label='".$_POST['valor_mensalidade_label']."',
																						 imagem_label='".$_POST['imagem_label']."',
																						 chamada_label='".$_POST['chamada_label']."',
																						 texto_label='".$_POST['texto_label']."',
																						 info_produto_label='".$_POST['info_produto_label']."',
																						 info_tecnica_label='".$_POST['info_tecnica_label']."',
																						 garantia_label='".$_POST['garantia_label']."',
																						 manual_label='".$_POST['manual_label']."',
																						 data_publicacao_label='".$_POST['data_publicacao_label']."', 
																						 data_despublicacao_label='".$_POST['data_despublicacao_label']."', 
																						 data_post_label='".$_POST['data_post_label']."', 
																						 hora_post_label='".$_POST['hora_post_label']."', 

																						 texto_promocao='".$_POST['texto_promocao']."', 
																						 texto_promocao_label='".$_POST['texto_promocao_label']."', 
																						 texto_promocao_info='".$_POST['texto_promocao_info']."', 

																						 idsysmodulos_categoria_info='".$_POST['idsysmodulos_categoria_info']."',
																						 ordem_info='".$_POST['ordem_info']."',
																						 nome_info='".$_POST['nome_info']."',
																						 cod_info='".$_POST['cod_info']."',
																						 tags_info='".$_POST['tags_info']."',
																						 valor_info='".$_POST['valor_info']."',
																						 promocao_info='".$_POST['promocao_info']."',
																						 valor_promocao_info='".$_POST['valor_promocao_info']."',
																						 valor_mensalidade_info='".$_POST['valor_mensalidade_info']."',
																						 imagem_info='".$_POST['imagem_info']."',
																						 chamada_info='".$_POST['chamada_info']."',
																						 texto_info='".$_POST['texto_info']."',
																						 info_produto_info='".$_POST['info_produto_info']."',
																						 info_tecnica_info='".$_POST['info_tecnica_info']."',
																						 garantia_info='".$_POST['garantia_info']."',
																						 manual_info='".$_POST['manual_info']."',
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

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	if(trim($_POST['acaoForm'])=="add-continuar") {
		$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
		echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$item['id']."/','_self','')</script>";
	} else {
		echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
	}
?>