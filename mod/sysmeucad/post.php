<?
	if(trim($_SESSION["perfil"])=="administrador") {
		$mod = "sysusu";
	} else {
		$mod = "painel_cliente";
	}

	$idEditavel = $_POST['iditem'];
	$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));

	if(trim($_POST['senha'])=="") { 
		$SenhaNova = $item['senha']; 
	} else { 
		$SenhaNova = Seguranca::encriptar($_POST['senha'],Seguranca::chave("infiniti")); 
	}
	$_POST['senha'] = $SenhaNova;

	$campo_imagem = "imagem";
	if(trim($_FILES[$campo_imagem]["name"])=="") {
		$_POST[$campo_imagem] = $item[$campo_imagem];
	} else {
		upload_arquivo($mod,$campo_imagem,"");
	}


	if(trim($_SESSION["perfil"])=="administrador") {
		# Gravação do Log
		$dataLogout = ajustaDataReturn($data,"d/m/Y");
		$logPerfil = "administrador";
		$logId = $rLogin['id'];
		$logAcao = "Editar";
		$logLocal = "Meus dados";
		$logDescricao = "O usuário administrativo <b>".$item['nome']."</b> editou seus dados";
		$logData = $data;
	} else {
		# Gravação do Log
		$dataLogout = ajustaDataReturn($data,"d/m/Y");
		$logPerfil = "cliente";
		$logId = $rLogin['id'];
		$logAcao = "Editar";
		$logLocal = "Meus dados";
		$logDescricao = "O cliente <b>".$item['nome']."</b> editou seus dados";
		$logData = $data;
	}

	$_POST['dataModificacao'] = $data;

	update($_POST,$mod,$idEditavel);

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	echo"<script>window.open('".$link."meus-dados/','_self','')</script>";
?>