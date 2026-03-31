<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";             
	if(trim($_POST['acaoForm'])=="add") {

	} else {
		if(trim($_POST['acaoForm'])=="editar") {

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
					$insert = mysql_query("INSERT INTO ".$mod."_config (nome,
					                                                    imagem_descricao,
																		imagem_interna,
																		texto_descricao,
																		titulo_texto) 
					                                                   VALUES 
																	   ('".$_POST['nome']."',
																	    '".$_POST['imagem_descricao']."',
																		'".$_POST['imagem_interna']."',
																		'".$_POST['texto_descricao']."',
																		'".$_POST['titulo_texto']."')");
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
					$update = mysql_query("UPDATE ".$mod."_config SET nome='".$_POST['nome']."',
					                                                  imagem_descricao='".$_POST['imagem_descricao']."',
																	  imagem_interna='".$_POST['imagem_interna']."',
																	  texto_descricao='".$_POST['texto_descricao']."',
																	  titulo_texto='".$_POST['titulo_texto']."' WHERE id='".$itemAtual['id']."'");
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

					if(trim($_POST['seo'])=="") { $_POST['seo']=0; } else { $_POST['seo']=1; }
					if(trim($_POST['nome'])=="") { $_POST['nome']=0; } else { $_POST['nome']=1; }

					if(trim($_POST['imagem_descricao'])=="") { $_POST['imagem_descricao']=0; } else { $_POST['imagem_descricao']=1; }
					if(trim($_POST['imagem_interna'])=="") { $_POST['imagem_interna']=0; } else { $_POST['imagem_interna']=1; }
					if(trim($_POST['titulo_texto'])=="") { $_POST['titulo_texto']=0; } else { $_POST['titulo_texto']=1; }
					if(trim($_POST['chamada_descricao'])=="") { $_POST['chamada_descricao']=0; } else { $_POST['chamada_descricao']=1; }
					if(trim($_POST['texto_descricao'])=="") { $_POST['texto_descricao']=0; } else { $_POST['texto_descricao']=1; }

					if($nEstrutura==0) { 
						$insert = mysql_query("INSERT INTO ".$mod."_estrutura (
						                                                    seo,

						                                                    nome,
						                                                    imagem_descricao,
																			imagem_interna,
																			chamada_descricao,
																			texto_descricao,
																			titulo_texto, 

						                                                    seo_label,

						                                                    nome_label,
						                                                    imagem_descricao_label,
																			imagem_interna_label,
																			chamada_descricao_label,
																			texto_descricao_label,
																			titulo_texto_label,

						                                                    nome_info,

						                                                    imagem_descricao_info,
																			imagem_interna_info,
																			chamada_descricao_info,
																			texto_descricao_info,
																			titulo_texto_info
																			) 
																			
																			VALUES 
																			
																			(
																			 '".$_POST['seo']."',

																			 '".$_POST['nome']."',
																			 '".$_POST['imagem_descricao']."',
																			 '".$_POST['imagem_interna']."',
																			 '".$_POST['chamada_descricao']."',
																			 '".$_POST['texto_descricao']."',
																			 '".$_POST['titulo_texto']."',

																			 '".$_POST['seo_label']."',

																			 '".$_POST['nome_label']."',
																			 '".$_POST['imagem_descricao_label']."',
																			 '".$_POST['imagem_interna_label']."',
																			 '".$_POST['chamada_descricao_label']."',
																			 '".$_POST['texto_descricao_label']."',
																			 '".$_POST['titulo_texto_label']."',

																			 '".$_POST['nome_info']."',

																			 '".$_POST['imagem_descricao_info']."',
																			 '".$_POST['imagem_interna_info']."',
																			 '".$_POST['chamada_descricao_info']."',
																			 '".$_POST['texto_descricao_info']."',
																			 '".$_POST['titulo_texto_info']."'
																			 )");
					} else {
						$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_estrutura LIMIT 1"));

						$update = mysql_query("UPDATE ".$mod."_estrutura SET 
						                                                     seo='".$_POST['seo']."',

						                                                     nome='".$_POST['nome']."',
																			 imagem_descricao='".$_POST['imagem_descricao']."',
																			 imagem_interna='".$_POST['imagem_interna']."',
																			 chamada_descricao='".$_POST['chamada_descricao']."',
																			 texto_descricao='".$_POST['texto_descricao']."',
																			 titulo_texto='".$_POST['titulo_texto']."', 

						                                                     seo_label='".$_POST['seo_label']."',
						                                                     nome_label='".$_POST['nome_label']."',

																			 imagem_descricao_label='".$_POST['imagem_descricao_label']."',
																			 imagem_interna_label='".$_POST['imagem_interna_label']."',
																			 chamada_descricao_label='".$_POST['chamada_descricao_label']."',
																			 texto_descricao_label='".$_POST['texto_descricao_label']."',
																			 titulo_texto_label='".$_POST['titulo_texto_label']."', 

						                                                     nome_info='".$_POST['nome_info']."',

																			 imagem_descricao_info='".$_POST['imagem_descricao_info']."',
																			 imagem_interna_info='".$_POST['imagem_interna_info']."',
																			 chamada_descricao_info='".$_POST['chamada_descricao_info']."',
																			 texto_descricao_info='".$_POST['texto_descricao_info']."',
																			 titulo_texto_info='".$_POST['titulo_texto_info']."' 
																			 
																			 WHERE id='".$itemAtual['id']."'");
					}
				}

			}
		}
	}

	echo"<script>window.open('".$link."".$_REQUEST['var2']."/','_self','')</script>";
?>