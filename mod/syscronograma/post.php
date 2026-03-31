<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add"||trim($_POST['acaoForm'])=="add-continuar") {

		$_POST['data_criacao'] = normalTOdate($_POST['data_criacao']);
		$_POST['data_inicio'] = normalTOdate($_POST['data_inicio']);
		$_POST['data_fim'] = normalTOdate($_POST['data_fim']);
		
		if(trim($_POST['mostrar_agenda'])=="") { $_POST['mostrar_agenda']=0; } else { $_POST['mostrar_agenda']=1; }
		/*if(trim($_POST['mostrar_dashboard'])=="") { $_POST['mostrar_dashboard']=0; } else { $_POST['mostrar_dashboard']=1; }*/

		$itemN = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
		if(trim($_POST['acaoForm'])=="add-continuar"&&$itemN>0) {
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
			$idEditavel = $item['id'];

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
		if(trim($_POST['acaoForm'])=="add-tarefas") {
	
			$numeroUnicoSend = $_POST['numeroUnico'];
	
			$qall = mysql_query("SELECT * FROM syscronograma_item WHERE numeroUnico_pai='".$_POST['numeroUnico_pai']."'");
			while($rall = mysql_fetch_array($qall)) {
				if( $rall['ordem'] >= $_POST['ordem']) {
					$ordem = $rall['ordem'] + 1;
					$update = mysql_query("UPDATE syscronograma_item SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
				}
			}
	
			upload_arquivo("syscronograma_item","imagem","");
	
			# Gravação do Log
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Adicionar";
			$logLocal = "".$caminho1."";
			$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
			$logData = $data;
	
			$_POST['data'] = $data;
			$_POST['dataModificacao'] = $data;
	
			insert($_POST,"syscronograma_item");
			sys_arquivoAdd("syscronograma_item",$numeroUnicoSend);

		} else {
			if(trim($_POST['acaoForm'])=="editar-tarefas") {
				$mod = "syscronograma_item";
				$idEditavel = $_POST['iditem'];
				$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
	
				$qall = mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico_pai='".$_POST['numeroUnico_pai']."'");
				while($rall = mysql_fetch_array($qall)) {
					if($rall['ordem'] > $item['ordem']) {
						$ordem = $rall['ordem'] - 1;
						$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
					}
				}
	
				$qall = mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico_pai='".$_POST['numeroUnico_pai']."'");
				while($rall = mysql_fetch_array($qall)) {
					if($rall['ordem'] >= $_POST['ordem']) {
						$ordem = $rall['ordem'] + 1;
						$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
					}
				}
		
				upload_arquivo($mod,"imagem","");
	
				# Gravação do Log
				$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
				$logPerfil = "administrador";
				$logId = $sysusu['id'];
				$logAcao = "Editou";
				$logLocal = "".$caminho1."";
				$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
				$logData = $data;
	
				$_POST['dataModificacao'] = $data;
	
				update($_POST,$mod,$idEditavel);
				sys_arquivoUpdate($mod,$idEditavel);
	
			} else {
				if(trim($_POST['acaoForm'])=="editar") {
					$idEditavel = $_POST['iditem'];
					$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
		
					$_POST['data_criacao'] = normalTOdate($_POST['data_criacao']);
					$_POST['data_inicio'] = normalTOdate($_POST['data_inicio']);
					$_POST['data_fim'] = normalTOdate($_POST['data_fim']);
					
					if(trim($_POST['mostrar_agenda'])=="") { $_POST['mostrar_agenda']=0; } else { $_POST['mostrar_agenda']=1; }
					/*if(trim($_POST['mostrar_dashboard'])=="") { $_POST['mostrar_dashboard']=0; } else { $_POST['mostrar_dashboard']=1; }*/
		
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
					if(trim($_POST['acaoForm'])=="excluir") {
						foreach ($_POST['msg_sel'] as $idcheck) {
							$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idcheck."'"));
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
	}

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	if(trim($_POST['acaoForm'])=="add-tarefas"||trim($_POST['acaoForm'])=="editar-tarefas") {
		$itemPai = mysql_fetch_array(mysql_query("SELECT * FROM syscronograma WHERE numeroUnico='".$_POST['numeroUnico_pai']."'"));
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