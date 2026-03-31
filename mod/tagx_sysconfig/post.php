<?
	$mod = $_POST['modulo'];
	$nConfig = mysql_num_rows(mysql_query("SELECT * FROM ".$mod.""));

	if($nConfig==0) { 

		if(trim($_POST['acaoForm'])=="site") {
			if(trim($_POST['manutencao'])=="") { $_POST['manutencao']=0; } else { $_POST['manutencao']=1; }
			$insert = mysql_query("INSERT INTO ".$mod." (nome,manutencao,manutencao_msg) VALUES ('".$_POST['nome']."','".$_POST['manutencao']."','".$_POST['manutencao_msg']."')");
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
			$insert = mysql_query("INSERT INTO ".$mod." (texto_seo,palavras_chave) VALUES ('".$_POST['texto_seo']."','".$_POST['palavras_chave']."')");
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

	} else {
		$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." ORDER BY data LIMIT 1"));

		if(trim($_POST['acaoForm'])=="site") {
			if(trim($_POST['manutencao'])=="") { $_POST['manutencao']=0; } else { $_POST['manutencao']=1; }
			$update = mysql_query("UPDATE ".$mod." SET nome='".$_POST['nome']."',manutencao='".$_POST['manutencao']."',manutencao_msg='".$_POST['manutencao_msg']."' WHERE id='".$itemAtual['id']."'");
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
			$update = mysql_query("UPDATE ".$mod." SET texto_seo='".$_POST['texto_seo']."',palavras_chave='".$_POST['palavras_chave']."' WHERE id='".$itemAtual['id']."'");
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

	}
	echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/".$_POST['acaoForm']."/','_self','')</script>";
?>