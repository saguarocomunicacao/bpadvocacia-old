<?
	$mod = $_POST['modulo'];
	
	if(trim($_POST['visualizar_sysusu'])=="") { $_POST['visualizar_sysusu']=0; } else { $_POST['visualizar_sysusu']=1; }             
	if(trim($_POST['inserir_sysusu'])=="") { $_POST['inserir_sysusu']=0; } else { $_POST['inserir_sysusu']=1; }             
	if(trim($_POST['editar_sysusu'])=="") { $_POST['editar_sysusu']=0; } else { $_POST['editar_sysusu']=1; }             
	if(trim($_POST['excluir_sysusu'])=="") { $_POST['excluir_sysusu']=0; } else { $_POST['excluir_sysusu']=1; }             
	if(trim($_POST['publicar_sysusu'])=="") { $_POST['publicar_sysusu']=0; } else { $_POST['publicar_sysusu']=1; }             
	if(trim($_POST['despublicar_sysusu'])=="") { $_POST['despublicar_sysusu']=0; } else { $_POST['despublicar_sysusu']=1; }             
	if(trim($_POST['lixeira_sysusu'])=="") { $_POST['lixeira_sysusu']=0; } else { $_POST['lixeira_sysusu']=1; }             
	if(trim($_POST['restaurar_sysusu'])=="") { $_POST['restaurar_sysusu']=0; } else { $_POST['restaurar_sysusu']=1; }             
	if(trim($_POST['senha_sysusu'])=="") { $_POST['senha_sysusu']=0; } else { $_POST['senha_sysusu']=1; }             
	if(trim($_POST['dados_sysusu'])=="") { $_POST['dados_sysusu']=0; } else { $_POST['dados_sysusu']=1; }             
	if(trim($_POST['configuracao_sysusu'])=="") { $_POST['configuracao_sysusu']=0; } else { $_POST['configuracao_sysusu']=1; }
	if(trim($_POST['chat_sysusu'])=="") { $_POST['chat_sysusu']=0; } else { $_POST['chat_sysusu']=1; }

	if(trim($_POST['visualizar_sysgrupousuario'])=="") { $_POST['visualizar_sysgrupousuario']=0; } else { $_POST['visualizar_sysgrupousuario']=1; }             
	if(trim($_POST['inserir_sysgrupousuario'])=="") { $_POST['inserir_sysgrupousuario']=0; } else { $_POST['inserir_sysgrupousuario']=1; }             
	if(trim($_POST['editar_sysgrupousuario'])=="") { $_POST['editar_sysgrupousuario']=0; } else { $_POST['editar_sysgrupousuario']=1; }             
	if(trim($_POST['excluir_sysgrupousuario'])=="") { $_POST['excluir_sysgrupousuario']=0; } else { $_POST['excluir_sysgrupousuario']=1; }             
	if(trim($_POST['publicar_sysgrupousuario'])=="") { $_POST['publicar_sysgrupousuario']=0; } else { $_POST['publicar_sysgrupousuario']=1; }             
	if(trim($_POST['despublicar_sysgrupousuario'])=="") { $_POST['despublicar_sysgrupousuario']=0; } else { $_POST['despublicar_sysgrupousuario']=1; }             
	if(trim($_POST['lixeira_sysgrupousuario'])=="") { $_POST['lixeira_sysgrupousuario']=0; } else { $_POST['lixeira_sysgrupousuario']=1; }             
	if(trim($_POST['restaurar_sysgrupousuario'])=="") { $_POST['restaurar_sysgrupousuario']=0; } else { $_POST['restaurar_sysgrupousuario']=1; }             

	if(trim($_POST['visualizar_sysmidia'])=="") { $_POST['visualizar_sysmidia']=0; } else { $_POST['visualizar_sysmidia']=1; }             

	if(trim($_POST['visualizar_syspermadmin'])=="") { $_POST['visualizar_syspermadmin']=0; } else { $_POST['visualizar_syspermadmin']=1; }             
	if(trim($_POST['editar_syspermadmin'])=="") { $_POST['editar_syspermadmin']=0; } else { $_POST['editar_syspermadmin']=1; }             

	if(trim($_POST['visualizar_syssuporte'])=="") { $_POST['visualizar_syssuporte']=0; } else { $_POST['visualizar_syssuporte']=1; }             
	if(trim($_POST['inserir_syssuporte'])=="") { $_POST['inserir_syssuporte']=0; } else { $_POST['inserir_syssuporte']=1; }             

	if(trim($_POST['visualizar_sysacesso'])=="") { $_POST['visualizar_sysacesso']=0; } else { $_POST['visualizar_sysacesso']=1; }             
	if(trim($_POST['admin_sysacesso'])=="") { $_POST['admin_sysacesso']=0; } else { $_POST['admin_sysacesso']=1; }             

	if(trim($_POST['visualizar_syslog'])=="") { $_POST['visualizar_syslog']=0; } else { $_POST['visualizar_syslog']=1; }             
	if(trim($_POST['admin_syslog'])=="") { $_POST['admin_syslog']=0; } else { $_POST['admin_syslog']=1; }             

	if(trim($_POST['visualizar_sysfonte'])=="") { $_POST['visualizar_sysfonte']=0; } else { $_POST['visualizar_sysfonte']=1; }             
	if(trim($_POST['visualizar_sysagenda'])=="") { $_POST['visualizar_sysagenda']=0; } else { $_POST['visualizar_sysagenda']=1; }             

	if(trim($_POST['admin_sysconfig'])=="") { $_POST['admin_sysconfig']=0; } else { $_POST['admin_sysconfig']=1; }             
	if(trim($_POST['site_sysconfig'])=="") { $_POST['site_sysconfig']=0; } else { $_POST['site_sysconfig']=1; }             
	if(trim($_POST['layout_sysconfig'])=="") { $_POST['layout_sysconfig']=0; } else { $_POST['layout_sysconfig']=1; }             
	if(trim($_POST['imagens_sysconfig'])=="") { $_POST['imagens_sysconfig']=0; } else { $_POST['imagens_sysconfig']=1; }             
	if(trim($_POST['mensagens_sysconfig'])=="") { $_POST['mensagens_sysconfig']=0; } else { $_POST['mensagens_sysconfig']=1; }             
	if(trim($_POST['seo_sysconfig'])=="") { $_POST['seo_sysconfig']=0; } else { $_POST['seo_sysconfig']=1; }             
	if(trim($_POST['indexacao_sysconfig'])=="") { $_POST['indexacao_sysconfig']=0; } else { $_POST['indexacao_sysconfig']=1; }             
	if(trim($_POST['analytics_sysconfig'])=="") { $_POST['analytics_sysconfig']=0; } else { $_POST['analytics_sysconfig']=1; }             
	if(trim($_POST['erro404_sysconfig'])=="") { $_POST['erro404_sysconfig']=0; } else { $_POST['erro404_sysconfig']=1; }             
	if(trim($_POST['instalacao_sysconfig'])=="") { $_POST['instalacao_sysconfig']=0; } else { $_POST['instalacao_sysconfig']=1; }             
	if(trim($_POST['dominios_sysconfig'])=="") { $_POST['dominios_sysconfig']=0; } else { $_POST['dominios_sysconfig']=1; }             
	if(trim($_POST['servidor_sysconfig'])=="") { $_POST['servidor_sysconfig']=0; } else { $_POST['servidor_sysconfig']=1; }             
	if(trim($_POST['visualizar_sysconfig'])=="") { $_POST['visualizar_sysconfig']=0; } else { $_POST['visualizar_sysconfig']=1; }             

	$qSql = mysql_query("SELECT * FROM sysmod WHERE stat='1' ORDER BY ordem");
	while($rSql = mysql_fetch_array($qSql)) {
		if(trim($_POST['visualizar_'.$rSql['bd'].''])=="") { $_POST['visualizar_'.$rSql['bd'].'']=0; } else { $_POST['visualizar_'.$rSql['bd'].'']=1; }             
		if(trim($_POST['todos_'.$rSql['bd'].''])=="") { $_POST['todos_'.$rSql['bd'].'']=0; } else { $_POST['todos_'.$rSql['bd'].'']=1; }             
		if(trim($_POST['inserir_'.$rSql['bd'].''])=="") { $_POST['inserir_'.$rSql['bd'].'']=0; } else { $_POST['inserir_'.$rSql['bd'].'']=1; }             
		if(trim($_POST['editar_'.$rSql['bd'].''])=="") { $_POST['editar_'.$rSql['bd'].'']=0; } else { $_POST['editar_'.$rSql['bd'].'']=1; }             
		if(trim($_POST['excluir_'.$rSql['bd'].''])=="") { $_POST['excluir_'.$rSql['bd'].'']=0; } else { $_POST['excluir_'.$rSql['bd'].'']=1; }             
		if(trim($_POST['publicar_'.$rSql['bd'].''])=="") { $_POST['publicar_'.$rSql['bd'].'']=0; } else { $_POST['publicar_'.$rSql['bd'].'']=1; }             
		if(trim($_POST['despublicar_'.$rSql['bd'].''])=="") { $_POST['despublicar_'.$rSql['bd'].'']=0; } else { $_POST['despublicar_'.$rSql['bd'].'']=1; }             
		if(trim($_POST['lixeira_'.$rSql['bd'].''])=="") { $_POST['lixeira_'.$rSql['bd'].'']=0; } else { $_POST['lixeira_'.$rSql['bd'].'']=1; }             
		if(trim($_POST['restaurar_'.$rSql['bd'].''])=="") { $_POST['restaurar_'.$rSql['bd'].'']=0; } else { $_POST['restaurar_'.$rSql['bd'].'']=1; }             
		if(trim($_POST['descricao_'.$rSql['bd'].''])=="") { $_POST['descricao_'.$rSql['bd'].'']=0; } else { $_POST['descricao_'.$rSql['bd'].'']=1; }             
		if(trim($_POST['seo_'.$rSql['bd'].''])=="") { $_POST['seo_'.$rSql['bd'].'']=0; } else { $_POST['seo_'.$rSql['bd'].'']=1; }             
	}

	$idEditavel = $_POST['idsysusu'];

	$perfilExist = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$idEditavel."'"));
	$perfilSet = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$idEditavel."'"));
	
	# Gravação do Log
	$dataLogout = ajustaDataReturn($data,"d/m/Y");
	$logPerfil = "administrador";
	$logId = $sysusu['id'];
	$logAcao = "Editar";
	$logLocal = "Permissões";
	$logDescricao = "Foi alterada as permissões <b>".$perfilSet['nome']."</b> na seguinte data: <b>".$dataLogout."</b>";
	$logData = $data;

	if(trim($perfilExist)==0) {
		insert($_POST,$mod);
	} else {
		$perfilExistSet = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$idEditavel."'"));
		update($_POST,$mod,$perfilExistSet['id']);
	}

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
	echo"<script>window.open('".$link."".$_REQUEST['var1']."/usuarios/permissoes/".$idEditavel."/','_self','')</script>";
?>