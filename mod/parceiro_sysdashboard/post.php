<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add"||trim($_POST['acaoForm'])=="add-continuar") {

		$_POST['data_inicio'] = normalTOdate($_POST['data_inicio']);
		$_POST['data_fim'] = normalTOdate($_POST['data_fim']);
		
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
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

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
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
			$_POST['data'] = $data;
			$_POST['dataModificacao'] = $data;
	
			insert($_POST,$mod."");
		}

	} else {
		if(trim($_POST['acaoForm'])=="editar") {
			$idEditavel = $_POST['iditem'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));

			$_POST['data_inicio'] = normalTOdate($_POST['data_inicio']);
			$_POST['data_fim'] = normalTOdate($_POST['data_fim']);

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
					}
				}
			}
		}
	}

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	if(trim($_POST['acaoForm'])=="add-tarefas") {
		$itemPai = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico_pai']."'"));
		echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$itemPai['id']."/','_self','')</script>";
	} else {
		if(trim($_POST['acaoForm'])=="add-continuar") {
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$item['id']."/','_self','')</script>";
		} else {
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
		}
	}
?>