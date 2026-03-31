<?
	$mod = $_POST['modulo'];
	$nConfig = mysql_num_rows(mysql_query("SELECT * FROM ".$mod.""));

	if($nConfig==0) { 

		if(trim($_POST['acaoForm'])=="administrativo") {
			$insert = mysql_query("INSERT INTO ".$mod." (dias_de_atualizacao,modulo_abertura,linguagem_padrao) VALUES ('".$_POST['dias_de_atualizacao']."','".$_POST['modulo_abertura']."','".$_POST['linguagem_padrao']."')");
		}

		if(trim($_POST['acaoForm'])=="site") {
			if(trim($_POST['manutencao'])=="") { $_POST['manutencao']=0; } else { $_POST['manutencao']=1; }
			$insert = mysql_query("INSERT INTO ".$mod." (nome,manutencao,manutencao_msg,linguagem_padrao_site) VALUES ('".$_POST['nome']."','".$_POST['manutencao']."','".$_POST['manutencao_msg']."','".$_POST['linguagem_padrao_site']."')");
		}

		if(trim($_POST['acaoForm'])=="layout") {
			$campo_imagem = "background_imagem";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}
			$insert = mysql_query("INSERT INTO ".$mod." (
			                                             cor1,
														 cor_icone,
														 cor_de_fundo,
														 tipo_moldura,
														 cor_moldura,
														 cor_over,
														 cabecalho_cor_fonte,
														 cabecalho_cor_fundo,
														 rodape_cor_fonte,
														 rodape_cor_fundo,
														 menu_tipo,
														 menu_px,
														 menu_fundo_cor,
														 menu_fonte,
														 menu_fonte_cor,
														 menu_fonte_cor_over,
														 background_tipo,
														 background_cor,
														 background_imagem,
														 background_imagem_tipo,
														 titulo_tipo,
														 titulo_px,
														 titulo_fonte,
														 titulo_cor,
														 subtitulo_tipo,
														 subtitulo_px,
														 subtitulo_fonte,
														 subtitulo_cor,
														 texto_tipo,
														 texto_px,
														 texto_fonte,
														 texto_cor,
														 copy_cor_fonte,
														 copy_cor_fundo
														 ) 
														 VALUES (
														 '".$_POST['cor1']."',
														 '".$_POST['cor_icone']."',
														 '".$_POST['cor_de_fundo']."',
														 '".$_POST['tipo_moldura']."',
														 '".$_POST['cor_moldura']."',
														 '".$_POST['cor_over']."',
														 '".$_POST['cabecalho_cor_fonte']."',
														 '".$_POST['cabecalho_cor_fundo']."',
														 '".$_POST['rodape_cor_fonte']."',
														 '".$_POST['rodape_cor_fundo']."',
														 '".$_POST['menu_tipo']."',
														 '".$_POST['menu_px']."',
														 '".$_POST['menu_fundo_cor']."',
														 '".$_POST['menu_fonte']."',
														 '".$_POST['menu_fonte_cor']."',
														 '".$_POST['menu_fonte_cor_over']."',
														 '".$_POST['background_tipo']."',
														 '".$_POST['background_cor']."',
														 '".$_POST['background_imagem']."',
														 '".$_POST['background_imagem_tipo']."',
														 '".$_POST['titulo_tipo']."',
														 '".$_POST['titulo_px']."',
														 '".$_POST['titulo_fonte']."',
														 '".$_POST['titulo_cor']."',
														 '".$_POST['subtitulo_tipo']."',
														 '".$_POST['subtitulo_px']."',
														 '".$_POST['subtitulo_fonte']."',
														 '".$_POST['subtitulo_cor']."',
														 '".$_POST['texto_tipo']."',
														 '".$_POST['texto_px']."',
														 '".$_POST['texto_fonte']."',
														 '".$_POST['texto_cor']."',
														 '".$_POST['copy_cor_fonte']."',
														 '".$_POST['copy_cor_fundo']."'
														 )");
		}

		if(trim($_POST['acaoForm'])=="imagens") {
			$campo_imagem = "logotipo";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}

			$campo_imagem = "favicon";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}

			$campo_imagem = "banner_imagem";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}

			if(trim($_POST['banner'])=="") { $_POST['banner']=0; } else { $_POST['banner']=1; }

			$insert = mysql_query("INSERT INTO ".$mod." (logotipo,favicon,banner_imagem,banner) VALUES ('".$_POST['logotipo']."','".$_POST['favicon']."','".$_POST['banner_imagem']."','".$_POST['banner']."')");
		}

		if(trim($_POST['acaoForm'])=="mensagens") {
			$campo_imagem = "email_imagem";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}
			$insert = mysql_query("INSERT INTO ".$mod." (email,email_imagem,email_texto) VALUES ('".$_POST['email']."','".$_POST['email_imagem']."','".$_POST['email_texto']."')");
		}

		if(trim($_POST['acaoForm'])=="seo") {
			$insert = mysql_query("INSERT INTO ".$mod." (nome_seo,texto_seo,palavras_chave) VALUES ('".$_POST['nome_seo']."','".$_POST['texto_seo']."','".$_POST['palavras_chave']."')");
		}

		if(trim($_POST['acaoForm'])=="indexacao") {
			if(trim($_POST['busca'])=="") { $_POST['busca']=0; } else { $_POST['busca']=1; }
			$insert = mysql_query("INSERT INTO ".$mod." (busca) VALUES ('".$_POST['busca']."')");
		}

		if(trim($_POST['acaoForm'])=="google-analytics") {
			$insert = mysql_query("INSERT INTO ".$mod." (id_google) VALUES ('".$_POST['id_google']."')");
		}

		if(trim($_POST['acaoForm'])=="pagina-de-erro404") {
			$campo_imagem = "erro404_imagem";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}
			$insert = mysql_query("INSERT INTO ".$mod." (erro404_titulo,erro404_imagem,erro404_msg) VALUES ('".$_POST['erro404_titulo']."','".$_POST['erro404_imagem']."','".$_POST['erro404_msg']."')");
		}

		if(trim($_POST['acaoForm'])=="dominio") {
			$insert = mysql_query("INSERT INTO ".$mod." (url_site,url_admin) VALUES ('".$_POST['url_site']."','".$_POST['url_admin']."')");
		}

		if(trim($_POST['acaoForm'])=="servidor") {
			$insert = mysql_query("INSERT INTO ".$mod." (ftp_host,ftp_user,ftp_pass,ftp_root) VALUES ('".$_POST['ftp_host']."','".$_POST['ftp_user']."','".$_POST['ftp_pass']."','".$_POST['ftp_root']."')");
		}

		if(trim($_POST['acaoForm'])=="instalacao") {
			$campo_imagem = "sql";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}

		}

	} else {
		$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." ORDER BY data LIMIT 1"));

		if(trim($_POST['acaoForm'])=="administrativo") {
			$update = mysql_query("UPDATE ".$mod." SET dias_de_atualizacao='".$_POST['dias_de_atualizacao']."',modulo_abertura='".$_POST['modulo_abertura']."',linguagem_padrao='".$_POST['linguagem_padrao']."' WHERE id='".$itemAtual['id']."'");
		}

		if(trim($_POST['acaoForm'])=="site") {
			if(trim($_POST['manutencao'])=="") { $_POST['manutencao']=0; } else { $_POST['manutencao']=1; }
			$update = mysql_query("UPDATE ".$mod." SET nome='".$_POST['nome']."',manutencao='".$_POST['manutencao']."',manutencao_msg='".$_POST['manutencao_msg']."',linguagem_padrao_site='".$_POST['linguagem_padrao_site']."' WHERE id='".$itemAtual['id']."'");
		}

		if(trim($_POST['acaoForm'])=="layout") {
			$campo_imagem = "background_imagem";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}
			$update = mysql_query("UPDATE ".$mod." SET 
			                                           cor1='".$_POST['cor1']."',
													   cor_icone='".$_POST['cor_icone']."',
													   cor_de_fundo='".$_POST['cor_de_fundo']."',
													   tipo_moldura='".$_POST['tipo_moldura']."',
													   cor_moldura='".$_POST['cor_moldura']."',
													   cor_over='".$_POST['cor_over']."', 
													   cabecalho_cor_fonte='".$_POST['cabecalho_cor_fonte']."', 
													   cabecalho_cor_fundo='".$_POST['cabecalho_cor_fundo']."', 
													   rodape_cor_fonte='".$_POST['rodape_cor_fonte']."', 
													   rodape_cor_fundo='".$_POST['rodape_cor_fundo']."', 
													   menu_tipo='".$_POST['menu_tipo']."', 
													   menu_px='".$_POST['menu_px']."',
													   menu_fundo_cor='".$_POST['menu_fundo_cor']."', 
													   menu_fonte='".$_POST['menu_fonte']."', 
													   menu_fonte_cor='".$_POST['menu_fonte_cor']."', 
													   menu_fonte_cor_over='".$_POST['menu_fonte_cor_over']."', 
													   background_tipo='".$_POST['background_tipo']."', 
													   background_cor='".$_POST['background_cor']."', 
													   background_imagem='".$_POST['background_imagem']."', 
													   background_imagem_tipo='".$_POST['background_imagem_tipo']."', 
													   titulo_tipo='".$_POST['titulo_tipo']."', 
													   titulo_px='".$_POST['titulo_px']."', 
													   titulo_fonte='".$_POST['titulo_fonte']."', 
													   titulo_cor='".$_POST['titulo_cor']."', 
													   subtitulo_tipo='".$_POST['subtitulo_tipo']."', 
													   subtitulo_px='".$_POST['subtitulo_px']."', 
													   subtitulo_fonte='".$_POST['subtitulo_fonte']."', 
													   subtitulo_cor='".$_POST['subtitulo_cor']."', 
													   texto_tipo='".$_POST['texto_tipo']."',
													   texto_px='".$_POST['texto_px']."', 
													   texto_fonte='".$_POST['texto_fonte']."', 
													   texto_cor='".$_POST['texto_cor']."', 
													   copy_cor_fonte='".$_POST['copy_cor_fonte']."', 
													   copy_cor_fundo='".$_POST['copy_cor_fundo']."' 

													   WHERE id='".$itemAtual['id']."'");
		}

		if(trim($_POST['acaoForm'])=="imagens") {
			$campo_imagem = "logotipo";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}

			$campo_imagem = "favicon";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}

			$campo_imagem = "banner_imagem";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}

			if(trim($_POST['banner'])=="") { $_POST['banner']=0; } else { $_POST['banner']=1; }

			$update = mysql_query("UPDATE ".$mod." SET logotipo='".$_POST['logotipo']."',favicon='".$_POST['favicon']."',banner_imagem='".$_POST['banner_imagem']."',banner='".$_POST['banner']."' WHERE id='".$itemAtual['id']."'");
		}

		if(trim($_POST['acaoForm'])=="mensagens") {
			$campo_imagem = "email_imagem";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}
			$update = mysql_query("UPDATE ".$mod." SET email='".$_POST['email']."',email_imagem='".$_POST['email_imagem']."',email_texto='".$_POST['email_texto']."' WHERE id='".$itemAtual['id']."'");
		}

		if(trim($_POST['acaoForm'])=="seo") {
			$update = mysql_query("UPDATE ".$mod." SET nome_seo='".$_POST['nome_seo']."',texto_seo='".$_POST['texto_seo']."',palavras_chave='".$_POST['palavras_chave']."' WHERE id='".$itemAtual['id']."'");
		}

		if(trim($_POST['acaoForm'])=="indexacao") {
			if(trim($_POST['busca'])=="") { $_POST['busca']=0; } else { $_POST['busca']=1; }
			$update = mysql_query("UPDATE ".$mod." SET busca='".$_POST['busca']."' WHERE id='".$itemAtual['id']."'");
		}

		if(trim($_POST['acaoForm'])=="google-analytics") {
			$update = mysql_query("UPDATE ".$mod." SET id_google='".$_POST['id_google']."' WHERE id='".$itemAtual['id']."'");
		}

		if(trim($_POST['acaoForm'])=="pagina-de-erro404") {
			$campo_imagem = "erro404_imagem";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}
			$update = mysql_query("UPDATE ".$mod." SET erro404_titulo='".$_POST['erro404_titulo']."',erro404_imagem='".$_POST['erro404_imagem']."',erro404_msg='".$_POST['erro404_msg']."' WHERE id='".$itemAtual['id']."'");
		}

		if(trim($_POST['acaoForm'])=="dominio") {
			$update = mysql_query("UPDATE ".$mod." SET url_site='".$_POST['url_site']."',url_admin='".$_POST['url_admin']."' WHERE id='".$itemAtual['id']."'");
		}

		if(trim($_POST['acaoForm'])=="servidor") {
			$update = mysql_query("UPDATE ".$mod." SET ftp_host='".$_POST['ftp_host']."',ftp_user='".$_POST['ftp_user']."',ftp_pass='".$_POST['ftp_pass']."',ftp_root='".$_POST['ftp_root']."' WHERE id='".$itemAtual['id']."'");
		}

		if(trim($_POST['acaoForm'])=="instalacao") {

			criaPastaComCaminho("./mod/","".$_POST['numeroUnico']."_".$_POST['modulo_install']."/");


			$origem = "http://www.tagx.com.br/install/".$_POST['modulo_install']."/";
			$pasta_destino = "./mod/".$_POST['numeroUnico']."_".$_POST['modulo_install']."/";

			if(!@copy("".$origem."list.txt","".$pasta_destino."list.php")) { } else { }
			if(!@copy("".$origem."navega.txt","".$pasta_destino."navega.php")) { } else { }
			if(!@copy("".$origem."post.txt","".$pasta_destino."post.php")) { } else { }
			if(!@copy("".$origem."consulta.txt","".$pasta_destino."consulta.php")) { } else { }
			
			include("".$pasta_destino."consulta.php");
			unlink("".$pasta_destino."consulta.php");

		}
	}
	echo"<script>window.open('".$link."".$_REQUEST['var1']."/configuracoes/".$_POST['acaoForm']."/','_self','')</script>";
?>