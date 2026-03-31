<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add") {

		upload_arquivo($mod."","imagem","");

		$_POST['data_cadastro'] = normalTOdate($_POST['data_cadastro']);
		$_POST['data_prospecto'] = normalTOdate($_POST['data_prospecto']);
		$_POST['data_cliente'] = normalTOdate($_POST['data_cliente']);

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
	} else {
		if(trim($_POST['acaoForm'])=="editar") {
			$idEditavel = $_POST['iditem'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));

			upload_arquivo($mod."","imagem","");

			$_POST['data_cadastro'] = normalTOdate($_POST['data_cadastro']);
			$_POST['data_prospecto'] = normalTOdate($_POST['data_prospecto']);
			$_POST['data_cliente'] = normalTOdate($_POST['data_cliente']);
	
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

	echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
?>