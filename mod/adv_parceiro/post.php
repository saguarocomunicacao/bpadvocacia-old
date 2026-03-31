<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add") {

		$_POST['senha'] = Seguranca::encriptar($_POST['senha'],Seguranca::chave("infiniti"));

		upload_arquivo($mod,"imagem","");
		
		# Gravação do Log
		$logPerfil = "administrador";
		$logId = $sysusu['id'];
		$logAcao = "Adicionar";
		$logLocal = "Usuário";
		$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
		$logData = $data;
		gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

		$_POST['data'] = $data;
		$_POST['dataModificacao'] = $data;

		insert($_POST,$mod);

		$perfilSet = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE numeroUnico='".$_POST['numeroUnico']."'"));
		$perfilExist = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$perfilSet['id']."'"));
	
		$_POST['visualizar_adv_processo']=1;          
		$_POST['inserir_adv_processo']=1;            
		$_POST['editar_adv_processo']=1;           
		$_POST['excluir_adv_processo']=1;             
		$_POST['publicar_adv_processo']=1;            
		$_POST['despublicar_adv_processo']=1;           
		$_POST['lixeira_adv_processo']=1;           
		$_POST['restaurar_adv_processo']=1;             
		$_POST['descricao_adv_processo']=1;      
		$_POST['seo_adv_processo']=1;           

		$_POST['visualizar_adv_processo_tipo']=1;          
		$_POST['inserir_adv_processo_tipo']=1;            
		$_POST['editar_adv_processo_tipo']=1;           
		$_POST['excluir_adv_processo_tipo']=1;             
		$_POST['publicar_adv_processo_tipo']=1;            
		$_POST['despublicar_adv_processo_tipo']=1;           
		$_POST['lixeira_adv_processo_tipo']=1;           
		$_POST['restaurar_adv_processo_tipo']=1;             
		$_POST['descricao_adv_processo_tipo']=1;      
		$_POST['seo_adv_processo_tipo']=1;           

		if(trim($perfilExist)==0) {
			$_POST['senha_sysusu']=1;          
			$_POST['dados_sysusu']=1;            
	
			insert($_POST,"syspermadmin");
		} else {
			update($_POST,"syspermadmin",$perfilSet['id']);
		}

	} else {
		if(trim($_POST['acaoForm'])=="add-continuar") {
			
			$qSqlTipo = mysql_query("SELECT * FROM adv_processo_tipo WHERE stat='1' ORDER BY ordem");
			while($rSqlTipo = mysql_fetch_array($qSqlTipo)) {
				$nTipo = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_POST['iditem']."' AND idadv_processo_tipo='".$rSqlTipo['id']."'"));
				if($nTipo==0) {
					$insert = mysql_query("INSERT INTO ".$mod." (
																 idsysusu,
																 idadv_processo_tipo,
																 auth,
																 ver,
																 editar,
																 excluir,
																 publicar,
																 despublicar,
																 data,
																 dataModificacao
																 ) 
																 VALUES 
																(
																 '".$_POST['iditem']."',
																 '".$rSqlTipo['id']."',
																 '".$_POST['auth_'.$rSqlTipo['id'].'']."',
																 '".$_POST['ver_'.$rSqlTipo['id'].'']."',
																 '".$_POST['editar_'.$rSqlTipo['id'].'']."',
																 '".$_POST['excluir_'.$rSqlTipo['id'].'']."',
																 '".$_POST['publicar_'.$rSqlTipo['id'].'']."',
																 '".$_POST['despublicar_'.$rSqlTipo['id'].'']."',
																 '".$data."',
																 '".$data."'
																 )");
				} else {
					$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_POST['iditem']."' AND idadv_processo_tipo='".$rSqlTipo['id']."'"));
					$update = mysql_query("UPDATE ".$linguagem_set."".$mod." SET 
																			 auth='".$_POST['auth_'.$rSqlTipo['id'].'']."',
																			 ver='".$_POST['ver_'.$rSqlTipo['id'].'']."',
																			 editar='".$_POST['editar_'.$rSqlTipo['id'].'']."',
																			 excluir='".$_POST['excluir_'.$rSqlTipo['id'].'']."',
																			 publicar='".$_POST['publicar_'.$rSqlTipo['id'].'']."',
																			 despublicar='".$_POST['publicar_'.$rSqlTipo['id'].'']."',
																			 dataModificacao='".$data."' 
																			 WHERE id='".$item['id']."'");
				}
			}
	
		} else {
			if(trim($_POST['acaoForm'])=="editar") {
				$qSqlTipo = mysql_query("SELECT * FROM adv_processo_tipo WHERE stat='1' ORDER BY ordem");
				while($rSqlTipo = mysql_fetch_array($qSqlTipo)) {
					$nTipo = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_POST['iditem']."' AND idadv_processo_tipo='".$rSqlTipo['id']."'"));
					if($nTipo==0) {
						$insert = mysql_query("INSERT INTO ".$mod." (
																	 idsysusu,
																	 idadv_processo_tipo,
																	 auth,
																	 ver,
																	 editar,
																	 excluir,
																	 publicar,
																	 despublicar,
																	 data,
																	 dataModificacao
																	 ) 
																	 VALUES 
																	(
																	 '".$_POST['iditem']."',
																	 '".$rSqlTipo['id']."',
																	 '".$_POST['auth_'.$rSqlTipo['id'].'']."',
																	 '".$_POST['ver_'.$rSqlTipo['id'].'']."',
																	 '".$_POST['editar_'.$rSqlTipo['id'].'']."',
																	 '".$_POST['excluir_'.$rSqlTipo['id'].'']."',
																	 '".$_POST['publicar_'.$rSqlTipo['id'].'']."',
																	 '".$_POST['despublicar_'.$rSqlTipo['id'].'']."',
																	 '".$data."',
																	 '".$data."'
																	 )");
					} else {
						$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_POST['iditem']."' AND idadv_processo_tipo='".$rSqlTipo['id']."'"));
						$update = mysql_query("UPDATE ".$linguagem_set."".$mod." SET 
																				 auth='".$_POST['auth_'.$rSqlTipo['id'].'']."',
																				 ver='".$_POST['ver_'.$rSqlTipo['id'].'']."',
																				 editar='".$_POST['editar_'.$rSqlTipo['id'].'']."',
																				 excluir='".$_POST['excluir_'.$rSqlTipo['id'].'']."',
																				 publicar='".$_POST['publicar_'.$rSqlTipo['id'].'']."',
																				 despublicar='".$_POST['publicar_'.$rSqlTipo['id'].'']."',
																				 dataModificacao='".$data."' 
																				 WHERE id='".$item['id']."'");
					}
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
					}
				}
			}
		}
	}

	if(trim($_POST['acaoForm'])=="add-continuar") {
		echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$_POST['iditem']."/','_self','')</script>";
	} else {
		echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
	}
?>