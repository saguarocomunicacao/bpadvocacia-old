<?
	$mod = $_POST['modulo'];             
	if(trim($_POST['acaoForm'])=="add") {

		upload_arquivo($mod,"imagem","");

		# Gravação do Log
		$logPerfil = "administrador";
		$logId = $sysusu['id'];
		$logAcao = "Adicionar";
		$logLocal = "Suporte";
		$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
		$logData = $data;

		$_POST['data'] = $data;
		$_POST['dataModificacao'] = $data;

		insert($_POST,$mod);
		
		$idChamado = $_POST['idchamado'];
		
		include("mod/syssuporte/email-abertura.php");

		echo"<script>window.open('".$link."suporte/','_self','')</script>";
	} else {
		if(trim($_POST['acaoForm'])=="editar") {
			$idEditavel = $_POST['idpai'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM syssuporte WHERE id='".$idEditavel."'"));

			upload_arquivo($mod,"imagem","");

			# Gravação do Log
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Respondeu";
			$logLocal = "Suporte";
			$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
			$logData = $data;

			$_POST['data'] = $data;
			$_POST['dataModificacao'] = $data;

			insert($_POST,$mod);

			$idChamado = $item['idchamado'];
			
			if(trim($_POST['idsysusu'])==""||trim($_POST['idsysusu'])==0) {
				$usuario_chamado = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$item['idsysusu']."'"));
				include("mod/syssuporte/email-resposta-admin.php");
				echo"<script>window.open('".$link."suporte/responder/".$item['idchamado']."','_self','')</script>";
			} else {
				include("mod/syssuporte/email-resposta.php");
				echo"<script>window.open('".$link."suporte/detalhes/".$item['idchamado']."','_self','')</script>";
			}
		} else {
		}
	}
?>