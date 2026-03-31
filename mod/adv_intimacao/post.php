<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="muda_status_intimacao") {
		foreach ($_POST['msg_sel'] as $idcheck) {
			$item = mysql_fetch_array(mysql_query("SELECT numeroUnico FROM ".$mod." WHERE id='".$idcheck."'"));
			$sql = mysql_query("UPDATE ".$mod." SET pendente='".$_POST['pendente_novo']."' WHERE id='".$idcheck."'");

			$_CAMPOS['idsysusu'] = $sysusu['id'];
			$_CAMPOS['numeroUnico'] = $item['numeroUnico'];
			$_CAMPOS['pendente'] = $_POST['pendente_novo'];
			$_CAMPOS['situacao'] = $_POST['pendente_novo'];
			$_CAMPOS['dataModificacao'] = $data;

			adv_intimacao_caminho_acoes_set($_CAMPOS);
		}
	} else {

		$_POST['data'] = $data;
		$_POST['dataModificacao'] = $data;
		$_CAMPOS = $_POST;

		if(trim($_POST['acaoForm'])=="add"||trim($_POST['acaoForm'])=="add-continuar") {
	
			$itemN = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
			if(trim($_POST['acaoForm'])=="add-continuar"&&$itemN>0) {
				$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
				$idEditavel = $item['id'];
	
				$_POST['data_xml_date'] = normalTOdate($_POST['data_xml']);
		
				# Gravação do Log
				$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
				$logPerfil = "administrador";
				$logId = $sysusu['id'];
				$logAcao = "Salvou e Continou Editando";
				$logLocal = "".$caminho1."";
				$logDescricao = "Foi editado o item <b>".$itemAntes['cod']."</b>";
				$logData = $data;
				gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
				update($_POST,$mod."",$idEditavel);

				$_CAMPOS['idsysusu'] = $sysusu['id'];
				adv_intimacao_caminho_acoes_set($_CAMPOS);
	
			} else {
	
				$_POST['data_xml_date'] = normalTOdate($_POST['data_xml']);
	
				# Gravação do Log
				$logPerfil = "administrador";
				$logId = $sysusu['id'];
				$logAcao = "Adicionar";
				$logLocal = "".$caminho1."";
				$logDescricao = "Foi adicionado o item <b>".$_POST['cod']."</b>";
				$logData = $data;
				gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
		
				insert($_POST,$mod."");

				$_CAMPOS['idsysusu'] = $sysusu['id'];
				adv_intimacao_caminho_acoes_set($_CAMPOS);
			}
	
		} else {
			if(trim($_POST['acaoForm'])=="add-tarefas") {
	
				$numeroUnicoSend = $_POST['numeroUnico'];
	
				if(trim($_POST['somente_criador'])=="") { $_POST['somente_criador']=0; } else { $_POST['somente_criador']=1; }
				if(trim($_POST['edicao_aberta'])=="") { $_POST['edicao_aberta']=0; } else { $_POST['edicao_aberta']=1; }
	
				if(trim($_POST['data_inicio'])=="" || trim($_POST['data_inicio'])=="0000-00-00"  ) {
					if(trim($_POST['data_fim'])=="" || trim($_POST['data_fim'])=="0000-00-00"  ) {
						$_POST['data_inicio'] = "".date("Y-m-d")."";		
					} else {
						$_POST['data_inicio'] = normalTOdate($_POST['data_fim']);		
					}
				} else {
					$_POST['data_inicio'] = normalTOdate($_POST['data_inicio']);
				}
		
				if(trim($_POST['data_fim'])=="" || trim($_POST['data_fim'])=="0000-00-00"  ) {
					if(trim($_POST['data_inicio'])=="" || trim($_POST['data_inicio'])=="0000-00-00"  ) {
						$_POST['data_fim'] = "".date("Y-m-d")."";		
					} else {
						$_POST['data_fim'] = normalTOdate($_POST['data_inicio']);		
					}
				} else {
					$_POST['data_fim'] = normalTOdate($_POST['data_fim']);
				}
		
				upload_arquivo_nativo("adv_intimacao_agenda","arquivo_1","");
				upload_arquivo_nativo("adv_intimacao_agenda","arquivo_2","");
				upload_arquivo_nativo("adv_intimacao_agenda","arquivo_3","");
				upload_arquivo_nativo("adv_intimacao_agenda","arquivo_4","");
				upload_arquivo_nativo("adv_intimacao_agenda","arquivo_5","");
		
				# Gravação do Log
				$logPerfil = "administrador";
				$logId = $sysusu['id'];
				$logAcao = "Adicionar";
				$logLocal = "".$caminho1."";
				$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
				$logData = $data;
				gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
		
				$_CAMPOS['numeroUnico'] = $_POST['numeroUnico_pai'];
				$_CAMPOS['idsysusu'] = $sysusu['id'];
				$_CAMPOS['tipo'] = "tarefa";
				$_CAMPOS['acao'] = "add";
				$_CAMPOS['numeroUnico_agenda'] = $_POST['numeroUnico'];
				$_CAMPOS['dataModificacao'] = $data;

				insert($_POST,"adv_intimacao_agenda");
				sys_arquivoAdd("adv_intimacao_agenda",$numeroUnicoSend);
				
				adv_intimacao_caminho_acoes_set($_CAMPOS);
			} else {
				if(trim($_POST['acaoForm'])=="editar") {
					$idEditavel = $_POST['iditem'];
					$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
	
					$_POST['data_xml_date'] = normalTOdate($_POST['data_xml']);
		
					# Gravação do Log
					$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
					$logPerfil = "administrador";
					$logId = $sysusu['id'];
					$logAcao = "Editou";
					$logLocal = "".$caminho1."";
					$logDescricao = "Foi editado o item <b>".$itemAntes['cod']."</b>";
					$logData = $data;
					gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
		
					update($_POST,$mod."",$idEditavel);

					$_CAMPOS['idsysusu'] = $sysusu['id'];
					adv_intimacao_caminho_acoes_set($_CAMPOS);
				} else {
					if(trim($_POST['acaoForm'])=="editar-tarefas") {
						$idEditavel = $_POST['iditem'];
						$item = mysql_fetch_array(mysql_query("SELECT * FROM adv_intimacao_agenda WHERE id='".$idEditavel."'"));
		
						/*
						if(trim($_POST['somente_criador'])=="") { $_POST['somente_criador']=0; } else { $_POST['somente_criador']=1; }
						if(trim($_POST['edicao_aberta'])=="") { $_POST['edicao_aberta']=0; } else { $_POST['edicao_aberta']=1; }
						*/
			
						if(trim($_POST['data_inicio'])=="" || trim($_POST['data_inicio'])=="0000-00-00"  ) {
							if(trim($_POST['data_fim'])=="" || trim($_POST['data_fim'])=="0000-00-00"  ) {
								$_POST['data_inicio'] = "".date("Y-m-d")."";		
							} else {
								$_POST['data_inicio'] = normalTOdate($_POST['data_fim']);		
							}
						} else {
							$_POST['data_inicio'] = normalTOdate($_POST['data_inicio']);
						}
				
						if(trim($_POST['data_fim'])=="" || trim($_POST['data_fim'])=="0000-00-00"  ) {
							if(trim($_POST['data_inicio'])=="" || trim($_POST['data_inicio'])=="0000-00-00"  ) {
								$_POST['data_fim'] = "".date("Y-m-d")."";		
							} else {
								$_POST['data_fim'] = normalTOdate($_POST['data_inicio']);		
							}
						} else {
							$_POST['data_fim'] = normalTOdate($_POST['data_fim']);
						}
				
						upload_arquivo("adv_intimacao_agenda","arquivo_1","");
						upload_arquivo("adv_intimacao_agenda","arquivo_2","");
						upload_arquivo("adv_intimacao_agenda","arquivo_3","");
						upload_arquivo("adv_intimacao_agenda","arquivo_4","");
						upload_arquivo("adv_intimacao_agenda","arquivo_5","");
			
						# Gravação do Log
						$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM adv_intimacao_agenda WHERE id='".$idEditavel."'"));
						$logPerfil = "administrador";
						$logId = $sysusu['id'];
						$logAcao = "Editou";
						$logLocal = "".$caminho1."";
						$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
						$logData = $data;
						gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
			
						$_POST['dataModificacao'] = $data;
			
						$_CAMPOS['numeroUnico'] = $item['numeroUnico_pai'];
						$_CAMPOS['idsysusu'] = $sysusu['id'];
						$_CAMPOS['tipo'] = "tarefa";
						$_CAMPOS['acao'] = "editar";
						$_CAMPOS['numeroUnico_agenda'] = $_POST['numeroUnico'];
						$_CAMPOS['dataModificacao'] = $data;
		
						update($_POST,"adv_intimacao_agenda",$idEditavel);
						sys_arquivoUpdate("adv_intimacao_agenda",$idEditavel);
		
						adv_intimacao_caminho_acoes_set($_CAMPOS);
		
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
									if(trim($_POST['acaoForm'])=="abrir") {
										foreach ($_POST['msg_sel'] as $idcheck) {
											echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$idcheck."/','_blank','')</script>";
										}
									} else {
									}
								}
							}
						}
					}
				}
			}
		}
	}

	if(trim($_POST['acaoForm'])=="add-tarefas"||trim($_POST['acaoForm'])=="editar-tarefas") {
		$itemPai = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico_pai']."'"));
		echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$itemPai['id']."/tarefas/','_self','')</script>";
	} else {
		if(trim($_POST['acaoForm'])=="add-continuar") {
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$item['id']."/','_self','')</script>";
		} else {
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
		}
	}
?>