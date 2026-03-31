<?
	if(trim($_SESSION["perfil"])=="administrador") {
		$mod = "sysusu";
	} else {
		$mod = "painel_cliente";
	}

	$idEditavel = $_POST['iditem'];
	$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));

	$SenhaAntiga = Seguranca::decriptar($item['senha'],Seguranca::chave("infiniti"));
	if(trim($_POST['senha'])==$SenhaAntiga) { 
		$SenhaNova = Seguranca::encriptar($_POST['senhanova'],Seguranca::chave("infiniti"));
		$SenhaNovaConf = $_POST['senhanova'];
		$urlRetorno = "sucesso";
	} else { 
		$SenhaNova = Seguranca::encriptar($SenhaAntiga,Seguranca::chave("infiniti")); 
		$SenhaNovaConf = $SenhaAntiga;
		$urlRetorno = "erro";
	}
	$_POST['senha'] = $SenhaNova;

	if(trim($_SESSION["perfil"])=="administrador") {
		# Gravação do Log
		$dataLogout = ajustaDataReturn($data,"d/m/Y");
		$logPerfil = "administrador";
		$logId = $rLogin['id'];
		$logAcao = "Editar";
		$logLocal = "Alterar senha de acesso";
		$logDescricao = "O usuário administrativo <b>".$item['nome']."</b> editou sua senha";
		$logData = $data;
	} else {
		# Gravação do Log
		$dataLogout = ajustaDataReturn($data,"d/m/Y");
		$logPerfil = "cliente";
		$logId = $rLogin['id'];
		$logAcao = "Editar";
		$logLocal = "Alterar senha de acesso";
		$logDescricao = "O cliente <b>".$item['nome']."</b> editou sua senha";
		$logData = $data;
	}

	$update = mysql_query("UPDATE ".$mod." SET senha='".$SenhaNova."',confsenha='".$SenhaNovaConf."' WHERE id='".$idEditavel."'");
	$_SESSION["senha"] = $SenhaNova;

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	echo"<script>window.open('".$link."alterar-senha-de-acesso/".$urlRetorno."/','_self','')</script>";
?>