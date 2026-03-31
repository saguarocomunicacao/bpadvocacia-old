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
																		endereco,
																		url_google,
																		tel_1_tipo,
																		tel_1,
																		tel_2_tipo,
																		tel_2,
																		tel_3_tipo,
																		tel_3,
																		tel_4_tipo,
																		tel_4,
																		tel_5_tipo,
																		tel_5,
																		email_1,
																		email_2,
																		email_3,
																		email_4,
																		email_5,
																		titulo_texto) 
					                                                   VALUES 
																	   ('".$_POST['nome']."',
																	    '".$_POST['imagem_descricao']."',
																		'".$_POST['imagem_interna']."',
																		'".$_POST['texto_descricao']."',
																		'".$_POST['endereco']."',
																		'".$_POST['url_google']."',
																		'".$_POST['tel_1_tipo']."',
																		'".$_POST['tel_1']."',
																		'".$_POST['tel_2_tipo']."',
																		'".$_POST['tel_2']."',
																		'".$_POST['tel_3_tipo']."',
																		'".$_POST['tel_3']."',
																		'".$_POST['tel_4_tipo']."',
																		'".$_POST['tel_4']."',
																		'".$_POST['tel_5_tipo']."',
																		'".$_POST['tel_5']."',
																		'".$_POST['email_1']."',
																		'".$_POST['email_2']."',
																		'".$_POST['email_3']."',
																		'".$_POST['email_4']."',
																		'".$_POST['email_5']."',
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
																	  endereco='".$_POST['endereco']."',
																	  url_google='".$_POST['url_google']."',
																	  tel_1_tipo='".$_POST['tel_1_tipo']."',
																	  tel_1='".$_POST['tel_1']."',
																	  tel_2_tipo='".$_POST['tel_2_tipo']."',
																	  tel_2='".$_POST['tel_2']."',
																	  tel_3_tipo='".$_POST['tel_3_tipo']."',
																	  tel_3='".$_POST['tel_3']."',
																	  tel_4_tipo='".$_POST['tel_4_tipo']."',
																	  tel_4='".$_POST['tel_4']."',
																	  tel_5_tipo='".$_POST['tel_5_tipo']."',
																	  tel_5='".$_POST['tel_5']."',
																	  email_1='".$_POST['email_1']."',
																	  email_2='".$_POST['email_2']."',
																	  email_3='".$_POST['email_3']."',
																	  email_4='".$_POST['email_4']."',
																	  email_5='".$_POST['email_5']."',
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

					if(trim($_POST['endereco'])=="") { $_POST['endereco']=0; } else { $_POST['endereco']=1; }
					if(trim($_POST['tel1'])=="") { $_POST['tel1']=0; } else { $_POST['tel1']=1; }
					if(trim($_POST['tel2'])=="") { $_POST['tel2']=0; } else { $_POST['tel2']=1; }
					if(trim($_POST['tel3'])=="") { $_POST['tel3']=0; } else { $_POST['tel3']=1; }
					if(trim($_POST['tel4'])=="") { $_POST['tel4']=0; } else { $_POST['tel4']=1; }
					if(trim($_POST['tel5'])=="") { $_POST['tel5']=0; } else { $_POST['tel5']=1; }
					if(trim($_POST['email1'])=="") { $_POST['email1']=0; } else { $_POST['email1']=1; }
					if(trim($_POST['email2'])=="") { $_POST['email2']=0; } else { $_POST['email2']=1; }
					if(trim($_POST['email3'])=="") { $_POST['email3']=0; } else { $_POST['email3']=1; }
					if(trim($_POST['email4'])=="") { $_POST['email4']=0; } else { $_POST['email4']=1; }
					if(trim($_POST['email5'])=="") { $_POST['email5']=0; } else { $_POST['email5']=1; }

					if(trim($_POST['imagem_descricao'])=="") { $_POST['imagem_descricao']=0; } else { $_POST['imagem_descricao']=1; }
					if(trim($_POST['imagem_interna'])=="") { $_POST['imagem_interna']=0; } else { $_POST['imagem_interna']=1; }
					if(trim($_POST['titulo_texto'])=="") { $_POST['titulo_texto']=0; } else { $_POST['titulo_texto']=1; }
					if(trim($_POST['chamada_descricao'])=="") { $_POST['chamada_descricao']=0; } else { $_POST['chamada_descricao']=1; }
					if(trim($_POST['texto_descricao'])=="") { $_POST['texto_descricao']=0; } else { $_POST['texto_descricao']=1; }

					if($nEstrutura==0) { 
						$insert = mysql_query("INSERT INTO ".$mod."_estrutura (
						                                                    seo,

						                                                    endereco,
						                                                    tel1,
						                                                    tel2,
						                                                    tel3,
						                                                    tel4,
						                                                    tel5,
						                                                    email1,
						                                                    email2,
						                                                    email3,
						                                                    email4,
						                                                    email5,

						                                                    nome,
						                                                    imagem_descricao,
																			imagem_interna,
																			chamada_descricao,
																			texto_descricao,
																			titulo_texto, 

						                                                    seo_label,

						                                                    endereco_label,
						                                                    tel1_label,
						                                                    tel2_label,
						                                                    tel3_label,
						                                                    tel4_label,
						                                                    tel5_label,
						                                                    email1_label,
						                                                    email2_label,
						                                                    email3_label,
						                                                    email4_label,
						                                                    email5_label,

						                                                    nome_label,
						                                                    imagem_descricao_label,
																			imagem_interna_label,
																			chamada_descricao_label,
																			texto_descricao_label,
																			titulo_texto_label,

						                                                    nome_info,

						                                                    endereco_info,
						                                                    tel1_info,
						                                                    tel2_info,
						                                                    tel3_info,
						                                                    tel4_info,
						                                                    tel5_info,
						                                                    email1_info,
						                                                    email2_info,
						                                                    email3_info,
						                                                    email4_info,
						                                                    email5_info,

						                                                    imagem_descricao_info,
																			imagem_interna_info,
																			chamada_descricao_info,
																			texto_descricao_info,
																			titulo_texto_info
																			) 
																			
																			VALUES 
																			
																			(
																			 '".$_POST['seo']."',

																			 '".$_POST['endereco']."',
																			 '".$_POST['tel1']."',
																			 '".$_POST['tel2']."',
																			 '".$_POST['tel3']."',
																			 '".$_POST['tel4']."',
																			 '".$_POST['tel5']."',
																			 '".$_POST['email1']."',
																			 '".$_POST['email2']."',
																			 '".$_POST['email3']."',
																			 '".$_POST['email4']."',
																			 '".$_POST['email5']."',

																			 '".$_POST['nome']."',
																			 '".$_POST['imagem_descricao']."',
																			 '".$_POST['imagem_interna']."',
																			 '".$_POST['chamada_descricao']."',
																			 '".$_POST['texto_descricao']."',
																			 '".$_POST['titulo_texto']."',

																			 '".$_POST['seo_label']."',

																			 '".$_POST['endereco_label']."',
																			 '".$_POST['tel1_label']."',
																			 '".$_POST['tel2_label']."',
																			 '".$_POST['tel3_label']."',
																			 '".$_POST['tel4_label']."',
																			 '".$_POST['tel5_label']."',
																			 '".$_POST['email1_label']."',
																			 '".$_POST['email2_label']."',
																			 '".$_POST['email3_label']."',
																			 '".$_POST['email4_label']."',
																			 '".$_POST['email5_label']."',

																			 '".$_POST['nome_label']."',
																			 '".$_POST['imagem_descricao_label']."',
																			 '".$_POST['imagem_interna_label']."',
																			 '".$_POST['chamada_descricao_label']."',
																			 '".$_POST['texto_descricao_label']."',
																			 '".$_POST['titulo_texto_label']."',

																			 '".$_POST['nome_info']."',

																			 '".$_POST['endereco_info']."',
																			 '".$_POST['tel1_info']."',
																			 '".$_POST['tel2_info']."',
																			 '".$_POST['tel3_info']."',
																			 '".$_POST['tel4_info']."',
																			 '".$_POST['tel5_info']."',
																			 '".$_POST['email1_info']."',
																			 '".$_POST['email2_info']."',
																			 '".$_POST['email3_info']."',
																			 '".$_POST['email4_info']."',
																			 '".$_POST['email5_info']."',

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

						                                                     endereco='".$_POST['endereco']."',
						                                                     tel1='".$_POST['tel1']."',
						                                                     tel2='".$_POST['tel2']."',
						                                                     tel3='".$_POST['tel3']."',
						                                                     tel4='".$_POST['tel4']."',
						                                                     tel5='".$_POST['tel5']."',
						                                                     email1='".$_POST['email1']."',
						                                                     email2='".$_POST['email2']."',
						                                                     email3='".$_POST['email3']."',
						                                                     email4='".$_POST['email4']."',
						                                                     email5='".$_POST['email5']."',

						                                                     nome='".$_POST['nome']."',
																			 imagem_descricao='".$_POST['imagem_descricao']."',
																			 imagem_interna='".$_POST['imagem_interna']."',
																			 chamada_descricao='".$_POST['chamada_descricao']."',
																			 texto_descricao='".$_POST['texto_descricao']."',
																			 titulo_texto='".$_POST['titulo_texto']."', 

						                                                     seo_label='".$_POST['seo_label']."',
						                                                     nome_label='".$_POST['nome_label']."',

						                                                     endereco_label='".$_POST['endereco_label']."',
						                                                     tel1_label='".$_POST['tel1_label']."',
						                                                     tel2_label='".$_POST['tel2_label']."',
						                                                     tel3_label='".$_POST['tel3_label']."',
						                                                     tel4_label='".$_POST['tel4_label']."',
						                                                     tel5_label='".$_POST['tel5_label']."',
						                                                     email1_label='".$_POST['email1_label']."',
						                                                     email2_label='".$_POST['email2_label']."',
						                                                     email3_label='".$_POST['email3_label']."',
						                                                     email4_label='".$_POST['email4_label']."',
						                                                     email5_label='".$_POST['email5_label']."',

																			 imagem_descricao_label='".$_POST['imagem_descricao_label']."',
																			 imagem_interna_label='".$_POST['imagem_interna_label']."',
																			 chamada_descricao_label='".$_POST['chamada_descricao_label']."',
																			 texto_descricao_label='".$_POST['texto_descricao_label']."',
																			 titulo_texto_label='".$_POST['titulo_texto_label']."', 

						                                                     nome_info='".$_POST['nome_info']."',

						                                                     endereco_info='".$_POST['endereco_info']."',
						                                                     tel1_info='".$_POST['tel1_info']."',
						                                                     tel2_info='".$_POST['tel2_info']."',
						                                                     tel3_info='".$_POST['tel3_info']."',
						                                                     tel4_info='".$_POST['tel4_info']."',
						                                                     tel5_info='".$_POST['tel5_info']."',
						                                                     email1_info='".$_POST['email1_info']."',
						                                                     email2_info='".$_POST['email2_info']."',
						                                                     email3_info='".$_POST['email3_info']."',
						                                                     email4_info='".$_POST['email4_info']."',
						                                                     email5_info='".$_POST['email5_info']."',

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

	echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
?>