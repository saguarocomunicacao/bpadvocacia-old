<?
	$mod = $_POST['modulo'];             
	if(trim($_POST['acaoForm'])=="add") {

		upload_arquivo($mod,"imagem","");
		
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
		$logLocal = "Controle de Módulos";
		$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
		$logData = $data;

		if(trim($_POST['pagina_inicial'])=="") { $_POST['pagina_inicial']=0; } else { $_POST['pagina_inicial']=1; }
		if(trim($_POST['menu'])=="") { $_POST['menu']=0; } else { $_POST['menu']=1; }
		if(trim($_POST['rodape'])=="") { $_POST['rodape']=0; } else { $_POST['rodape']=1; }

		$_POST['data'] = $data;
		$_POST['dataModificacao'] = $data;
		
		$alter = mysql_query("ALTER TABLE `syspermadmin` 
							  ADD `visualizar_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `visualizar_sysconfig`, 
							  ADD `todos_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `visualizar_".$_POST['bd']."`, 
							  ADD `inserir_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `todos_".$_POST['bd']."`, 
							  ADD `editar_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `inserir_".$_POST['bd']."`, 
							  ADD `excluir_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `editar_".$_POST['bd']."`, 
							  ADD `publicar_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `excluir_".$_POST['bd']."`, 
							  ADD `despublicar_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `publicar_".$_POST['bd']."`, 
							  ADD `lixeira_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `despublicar_".$_POST['bd']."`, 
							  ADD `restaurar_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `lixeira_".$_POST['bd']."`, 
							  ADD `descricao_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `restaurar_".$_POST['bd']."`, 
							  ADD `seo_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `descricao_".$_POST['bd']."`;
								");

		$alter = mysql_query("ALTER TABLE `sysgrupousuario` 
							  ADD `visualizar_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `visualizar_sysconfig`, 
							  ADD `todos_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `visualizar_".$_POST['bd']."`, 
							  ADD `inserir_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `todos_".$_POST['bd']."`, 
							  ADD `editar_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `inserir_".$_POST['bd']."`, 
							  ADD `excluir_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `editar_".$_POST['bd']."`, 
							  ADD `publicar_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `excluir_".$_POST['bd']."`, 
							  ADD `despublicar_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `publicar_".$_POST['bd']."`, 
							  ADD `lixeira_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `despublicar_".$_POST['bd']."`, 
							  ADD `restaurar_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `lixeira_".$_POST['bd']."`, 
							  ADD `descricao_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `restaurar_".$_POST['bd']."`, 
							  ADD `seo_".$_POST['bd']."` SET('0','1') NOT NULL AFTER `descricao_".$_POST['bd']."`;
								");

		insert($_POST,$mod);
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
	
			if(trim($_POST['pagina_inicial'])=="") { $_POST['pagina_inicial']=0; } else { $_POST['pagina_inicial']=1; }
			if(trim($_POST['menu'])=="") { $_POST['menu']=0; } else { $_POST['menu']=1; }
			if(trim($_POST['rodape'])=="") { $_POST['rodape']=0; } else { $_POST['rodape']=1; }
	
			$campo_imagem = "imagem";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $item[$campo_imagem];
			} else {
				upload_arquivo($mod,$campo_imagem,"");
			}
	
			# Gravação do Log
			$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Editou";
			$logLocal = "Controle de Módulos";
			$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
			$logData = $data;
	
			$_POST['dataModificacao'] = $data;
	
			update($_POST,$mod,$idEditavel);
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
					}
				}
			}
		}
	}

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
?>