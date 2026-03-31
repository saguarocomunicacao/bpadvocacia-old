<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add"||trim($_POST['acaoForm'])=="add-continuar") {
		
		$itemN = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
		if(trim($_POST['acaoForm'])=="add-continuar"&&$itemN>0) {
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
			$idEditavel = $item['id'];

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

			# Gravação do Log
			$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Editou";
			$logLocal = "".$caminho1."";
			$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
			$logData = $data;
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

			$_POST['dataModificacao'] = $data;

			update($_POST,$mod."",$idEditavel);
		} else {
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
			$logLocal = "".$caminho1."";
			$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
			$logData = $data;
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
			$_POST['data'] = $data;
			$_POST['dataModificacao'] = $data;
	
			insert($_POST,$mod."");
		}

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

			# Gravação do Log
			$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Editou";
			$logLocal = "".$caminho1."";
			$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
			$logData = $data;
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

			$_POST['dataModificacao'] = $data;

			update($_POST,$mod."",$idEditavel);
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

						if(trim($_POST['acaoForm'])=="editar-permissoes"||trim($_POST['acaoForm'])=="add-continuar_formulario_permissoes") {
							$idEditavel = $_POST['iditem'];
							$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));

							$qSqlTipo = mysql_query("SELECT * FROM sysusu WHERE stat='1' ORDER BY nome");
							while($rSqlTipo = mysql_fetch_array($qSqlTipo)) {
								$nTipo = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_POST['iditem']."' AND idsysusu='".$rSqlTipo['id']."'"));
								if($nTipo==0) {
									$insert = mysql_query("INSERT INTO adv_parceiro (
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
																				 '".$rSqlTipo['id']."',
																				 '".$_POST['iditem']."',
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
									$item = mysql_fetch_array(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_POST['iditem']."' AND idsysusu='".$rSqlTipo['id']."'"));
									$update = mysql_query("UPDATE adv_parceiro SET 
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
						}




					}
				}
			}
		}
	}

	if(trim($_POST['acaoForm'])=="editar-permissoes"||trim($_POST['acaoForm'])=="add-continuar_formulario_permissoes") {
		if(trim($_POST['acaoForm'])=="add-continuar_formulario_permissoes") {
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$_POST['iditem']."/permissoes/','_self','')</script>";
		} else {
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
		}
	} else {
		if(trim($_POST['acaoForm'])=="add-continuar") {
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$item['id']."/','_self','')</script>";
		} else {
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
		}
	}
?>