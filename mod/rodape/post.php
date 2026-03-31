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
			
					upload_arquivo($mod."_config","imagem_box_1","");
					upload_arquivo($mod."_config","imagem_box_2","");
					upload_arquivo($mod."_config","imagem_box_3","");
					upload_arquivo($mod."_config","imagem_box_4","");

					$insert = mysql_query("INSERT INTO ".$mod."_config (numeroUnico,
					 													titulo_box_1,
					                                                    titulo_box_2,
					                                                    titulo_box_3,
					                                                    titulo_box_4,
																		tipo_box_1,
																		tipo_box_2,
																		tipo_box_3,
																		tipo_box_4,
																		modulo_box_1,
																		modulo_box_2,
																		modulo_box_3,
																		modulo_box_4,
																		rede_social_box_1_tipo,
																		rede_social_box_1,
																		rede_social_box_1_id,
																		rede_social_box_2_tipo,
																		rede_social_box_2,
																		rede_social_box_2_id,
																		rede_social_box_3_tipo,
																		rede_social_box_3,
																		rede_social_box_3_id,
																		rede_social_box_4_tipo,
																		rede_social_box_4,
																		rede_social_box_4_id,
																		texto_box_1,
																		texto_box_2,
																		texto_box_3,
																		texto_box_4,
																		link_box_1,
																		link_box_2,
																		link_box_3,
																		link_box_4,
																		imagem_box_1,
																		imagem_box_2,
																		imagem_box_3,
																		imagem_box_4,
																		data,
																		dataModificacao
																		) 
					                                                   VALUES 
																	   ('".$_POST['numeroUnico']."',
																	    '".$_POST['titulo_box_1']."',
																	    '".$_POST['titulo_box_2']."',
																		'".$_POST['titulo_box_3']."',
																		'".$_POST['titulo_box_4']."',
																		'".$_POST['tipo_box_1']."',
																		'".$_POST['tipo_box_2']."',
																		'".$_POST['tipo_box_3']."',
																		'".$_POST['tipo_box_4']."',
																		'".$_POST['modulo_box_1']."',
																		'".$_POST['modulo_box_2']."',
																		'".$_POST['modulo_box_3']."',
																		'".$_POST['modulo_box_4']."',
																		'".$_POST['rede_social_box_1_tipo']."',
																		'".$_POST['rede_social_box_1']."',
																		'".$_POST['rede_social_box_1_id']."',
																		'".$_POST['rede_social_box_2_tipo']."',
																		'".$_POST['rede_social_box_2']."',
																		'".$_POST['rede_social_box_2_id']."',
																		'".$_POST['rede_social_box_3_tipo']."',
																		'".$_POST['rede_social_box_3']."',
																		'".$_POST['rede_social_box_3_id']."',
																		'".$_POST['rede_social_box_4_tipo']."',
																		'".$_POST['rede_social_box_4']."',
																		'".$_POST['rede_social_box_4_id']."',
																		'".$_POST['texto_box_1']."',
																		'".$_POST['texto_box_2']."',
																		'".$_POST['texto_box_3']."',
																		'".$_POST['texto_box_4']."',
																		'".$_POST['link_box_1']."',
																		'".$_POST['link_box_2']."',
																		'".$_POST['link_box_3']."',
																		'".$_POST['link_box_4']."',
																		'".$_POST['imagem_box_1']."',
																		'".$_POST['imagem_box_2']."',
																		'".$_POST['imagem_box_3']."',
																		'".$_POST['imagem_box_4']."',
																		'".$data."',
																		'".$data."'
																		)");
				} else {
					$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_config ORDER BY id DESC LIMIT 1"));

					# Gravação do Log
					$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_config WHERE id='".$itemAtual['id']."'"));
					$logPerfil = "administrador";
					$logId = $sysusu['id'];
					$logAcao = "Editou";
					$logLocal = "".$caminho1."";
					$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
					$logData = $data;
					gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
		
					if(trim($_FILES["imagem_box_1"]["name"])=="") { 
						$imagem_box_1_set = $itemAtual["imagem_box_1"];
					} else {
						upload_arquivo($mod."_config","imagem_box_1","");
						$imagem_box_1_set = $_FILES["imagem_box_1"]["name"];
					}
					if(trim($_FILES["imagem_box_2"]["name"])=="") { 
						$imagem_box_2_set = $itemAtual["imagem_box_2"];
					} else {
						upload_arquivo($mod."_config","imagem_box_2","");
						$imagem_box_2_set = $_FILES["imagem_box_2"]["name"];
					}
					if(trim($_FILES["imagem_box_3"]["name"])=="") { 
						$imagem_box_3_set = $itemAtual["imagem_box_3"];
					} else {
						upload_arquivo($mod."_config","imagem_box_3","");
						$imagem_box_3_set = $_FILES["imagem_box_3"]["name"];
					}
					if(trim($_FILES["imagem_box_4"]["name"])=="") { 
						$imagem_box_4_set = $itemAtual["imagem_box_4"];
					} else {
						upload_arquivo($mod."_config","imagem_box_4","");
						$imagem_box_4_set = $_FILES["imagem_box_4"]["name"];
					}

					$update = mysql_query("UPDATE ".$mod."_config SET numeroUnico='".$_POST['numeroUnico']."',
					                                                  titulo_box_1='".$_POST['titulo_box_1']."',
					                                                  titulo_box_2='".$_POST['titulo_box_2']."',
					                                                  titulo_box_3='".$_POST['titulo_box_3']."',
					                                                  titulo_box_4='".$_POST['titulo_box_4']."',
																	  tipo_box_1='".$_POST['tipo_box_1']."',
																	  tipo_box_2='".$_POST['tipo_box_2']."',
																	  tipo_box_3='".$_POST['tipo_box_3']."',
																	  tipo_box_4='".$_POST['tipo_box_4']."',
																	  modulo_box_1='".$_POST['modulo_box_1']."',
																	  modulo_box_2='".$_POST['modulo_box_2']."',
																	  modulo_box_3='".$_POST['modulo_box_3']."',
																	  modulo_box_4='".$_POST['modulo_box_4']."',

																	  rede_social_box_1_tipo='".$_POST['rede_social_box_1_tipo']."',
																	  rede_social_box_1='".$_POST['rede_social_box_1']."',
																	  rede_social_box_1_id='".$_POST['rede_social_box_1_id']."',

																	  rede_social_box_2_tipo='".$_POST['rede_social_box_2_tipo']."',
																	  rede_social_box_2='".$_POST['rede_social_box_2']."',
																	  rede_social_box_2_id='".$_POST['rede_social_box_2_id']."',

																	  rede_social_box_3_tipo='".$_POST['rede_social_box_3_tipo']."',
																	  rede_social_box_3='".$_POST['rede_social_box_3']."',
																	  rede_social_box_3_id='".$_POST['rede_social_box_3_id']."',

																	  rede_social_box_4_tipo='".$_POST['rede_social_box_4_tipo']."',
																	  rede_social_box_4='".$_POST['rede_social_box_4']."',
																	  rede_social_box_4_id='".$_POST['rede_social_box_4_id']."' ,
																	  
																	  texto_box_1='".$_POST['texto_box_1']."',
																	  texto_box_2='".$_POST['texto_box_2']."',
																	  texto_box_3='".$_POST['texto_box_3']."',
																	  texto_box_4='".$_POST['texto_box_4']."',

																	  link_box_1='".$_POST['link_box_1']."',
																	  link_box_2='".$_POST['link_box_2']."',
																	  link_box_3='".$_POST['link_box_3']."',
																	  link_box_4='".$_POST['link_box_4']."',

																	  imagem_box_1='".$imagem_box_1_set."',
																	  imagem_box_2='".$imagem_box_2_set."',
																	  imagem_box_3='".$imagem_box_3_set."',
																	  imagem_box_4='".$imagem_box_4_set."',
																	  dataModificacao='".$data."'

																	  WHERE id='".$itemAtual['id']."'");
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

	echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
?>