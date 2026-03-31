<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add"||trim($_POST['acaoForm'])=="add-continuar") {

		$_POST['data_inicio'] = normalTOdate($_POST['data_inicio']);
		$_POST['data_fim'] = normalTOdate($_POST['data_fim']);
		
		if(trim($_POST['mostrar_agenda'])=="") { $_POST['mostrar_agenda']=0; } else { $_POST['mostrar_agenda']=1; }
		if(trim($_POST['mostrar_dashboard'])=="") { $_POST['mostrar_dashboard']=0; } else { $_POST['mostrar_dashboard']=1; }
		
		$criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_POST['criador']."'"));
		$_POST['criador_nome'] = $criador_processo['nome'];

		$itemN = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
		if(trim($_POST['acaoForm'])=="add-continuar"&&$itemN>0) {

			$_POST['dataModificacao'] = $data;

			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
			$idEditavel = $item['id'];

			$update = mysql_query("UPDATE adv_processo SET lista_syscliente_nome='' WHERE id='".$item['id']."'");
			$lista_de_clientes="";
			$qSqlCategoria = mysql_query("SELECT * FROM adv_processo_syscliente WHERE numeroUnico_pai='".$item['numeroUnico']."' ORDER BY data DESC");
			while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
		
				$syscliente_set = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$rSqlCategoria['idsyscliente']."'"));
		
				if(trim($lista_de_clientes)=="") {
					$lista_de_clientes = "".$syscliente_set['nome']."";
				} else {
					$lista_de_clientes = $lista_de_clientes.", ".$syscliente_set['nome']."";
				}
			}
		
			$_POST['lista_syscliente_nome'] = $lista_de_clientes;
			$_POST['dataModificacao_txt'] = date( 'j M Y H:i:s', strtotime($_POST['dataModificacao']));

			# Gravação do Log
			$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Salvou e Continou Editando";
			$logLocal = "".$caminho1."";
			$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
			$logData = $data;
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

			update($_POST,$mod."",$idEditavel);

		} else {

			$_POST['data'] = $data;
			$_POST['dataModificacao'] = $data;
	
			$lista_de_clientes="";
			$qSqlCategoria = mysql_query("SELECT * FROM adv_processo_syscliente WHERE numeroUnico_pai='".$_POST['numeroUnico']."' ORDER BY data DESC");
			while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
		
				$syscliente_set = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$rSqlCategoria['idsyscliente']."'"));
		
				if(trim($lista_de_clientes)=="") {
					$lista_de_clientes = "".$syscliente_set['nome']."";
				} else {
					$lista_de_clientes = $lista_de_clientes.", ".$syscliente_set['nome']."";
				}
			}
		
			$_POST['lista_syscliente_nome'] = $lista_de_clientes;
			$_POST['dataModificacao_txt'] = date( 'j M Y H:i:s', strtotime($_POST['dataModificacao']));
		
			# Gravação do Log
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Adicionar";
			$logLocal = "".$caminho1."";
			$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
			$logData = $data;
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
			insert($_POST,$mod."");
		}

	} else {
		if(trim($_POST['acaoForm'])=="add-tarefas") {
	

			$numeroUnicoSend = $_POST['numeroUnico'];
	
			$_POST['data_fim'] = normalTOdate($_POST['data_fim']);
	
			upload_arquivo("adv_processo_agenda","imagem","");
	
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
	
			insert($_POST,"adv_processo_agenda");
			sys_arquivoAdd("adv_processo_agenda",$numeroUnicoSend);
		} else {
			if(trim($_POST['acaoForm'])=="editar") {
				$_POST['dataModificacao'] = $data;
	
				$idEditavel = $_POST['iditem'];
				$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
	
				$_POST['data_criacao'] = normalTOdate($_POST['data_criacao']);
				$_POST['data_inicio'] = normalTOdate($_POST['data_inicio']);
				$_POST['data_fim'] = normalTOdate($_POST['data_fim']);
				
				if(trim($_POST['mostrar_agenda'])=="") { $_POST['mostrar_agenda']=0; } else { $_POST['mostrar_agenda']=1; }
				if(trim($_POST['mostrar_dashboard'])=="") { $_POST['mostrar_dashboard']=0; } else { $_POST['mostrar_dashboard']=1; }
	
				$criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_POST['criador']."'"));
				$_POST['criador_nome'] = $criador_processo['nome'];
	
				$update = mysql_query("UPDATE adv_processo SET lista_syscliente_nome='' WHERE id='".$item['id']."'");
				$lista_de_clientes="";
				$qSqlCategoria = mysql_query("SELECT * FROM adv_processo_syscliente WHERE numeroUnico_pai='".$item['numeroUnico']."' ORDER BY data DESC");
				while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
			
					$syscliente_set = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$rSqlCategoria['idsyscliente']."'"));
			
					if(trim($lista_de_clientes)=="") {
						$lista_de_clientes = "".$syscliente_set['nome']."";
					} else {
						$lista_de_clientes = $lista_de_clientes.", ".$syscliente_set['nome']."";
					}
				}
			
				$_POST['lista_syscliente_nome'] = $lista_de_clientes;
				$_POST['dataModificacao_txt'] = date( 'j M Y H:i:s', strtotime($_POST['dataModificacao']));

				# Gravação do Log
				$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
				$logPerfil = "administrador";
				$logId = $sysusu['id'];
				$logAcao = "Editou";
				$logLocal = "".$caminho1."";
				$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
				$logData = $data;
				gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
				update($_POST,$mod."",$idEditavel);
				sys_arquivoUpdate("adv_processo_agenda",$idEditavel);

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
						$sql = mysql_query("DELETE FROM sys_arquivo WHERE numeroUnico='".$itemAntes['numeroUnico']."'");
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
	}

	if(trim($_POST['acaoForm'])=="add-tarefas") {
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