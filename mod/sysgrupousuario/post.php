<?
	$mod = $_POST['modulo'];             
	if(trim($_POST['acaoForm'])=="add") {

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

		# Gravação do Log
		$logPerfil = "administrador";
		$logId = $sysusu['id'];
		$logAcao = "Adicionar";
		$logLocal = "Grupo de Usuário";
		$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
		$logData = $data;

		$_POST['data'] = $data;
		$_POST['dataModificacao'] = $data;

		insert($_POST,$mod);
	} else {
		if(trim($_POST['acaoForm'])=="editar") {
			$idEditavel = $_POST['iditem'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
	
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

			# Gravação do Log
			$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Editou";
			$logLocal = "Grupo de Usuários";
			$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
			$logData = $data;
	
			$_POST['dataModificacao'] = $data;
	
			update($_POST,$mod,$idEditavel);
			
			$sysgrupousuario_set = mysql_fetch_array(mysql_query("SELECT * FROM sysgrupousuario WHERE id='".$idEditavel."'"));

			$_POST = array();
			
			$qSqlSysusu = mysql_query("SELECT * FROM sysusu WHERE idsysgrupousuario='".$idEditavel."'");
			while($rSqlSysusu = mysql_fetch_array($qSqlSysusu)) {

				$_POST['acaoLocal'] = "interno";
				$_POST['acaoForm'] = "editar";
				$_POST['modulo'] = "syspermadmin";
				$_POST['idsysusu'] = $rSqlSysusu['id'];

				if(trim($sysgrupousuario_set['visualizar_sysusu'])==""||trim($sysgrupousuario_set['visualizar_sysusu'])=="0") { $_POST['visualizar_sysusu']=0; } else { $_POST['visualizar_sysusu']=1; }             
				if(trim($sysgrupousuario_set['inserir_sysusu'])==""||trim($sysgrupousuario_set['inserir_sysusu'])=="0") { $_POST['inserir_sysusu']=0; } else { $_POST['inserir_sysusu']=1; }             
				if(trim($sysgrupousuario_set['editar_sysusu'])==""||trim($sysgrupousuario_set['editar_sysusu'])=="0") { $_POST['editar_sysusu']=0; } else { $_POST['editar_sysusu']=1; }             
				if(trim($sysgrupousuario_set['excluir_sysusu'])==""||trim($sysgrupousuario_set['excluir_sysusu'])=="0") { $_POST['excluir_sysusu']=0; } else { $_POST['excluir_sysusu']=1; }             
				if(trim($sysgrupousuario_set['publicar_sysusu'])==""||trim($sysgrupousuario_set['publicar_sysusu'])=="0") { $_POST['publicar_sysusu']=0; } else { $_POST['publicar_sysusu']=1; }             
				if(trim($sysgrupousuario_set['despublicar_sysusu'])==""||trim($sysgrupousuario_set['despublicar_sysusu'])=="0") { $_POST['despublicar_sysusu']=0; } else { $_POST['despublicar_sysusu']=1; }             
				if(trim($sysgrupousuario_set['lixeira_sysusu'])==""||trim($sysgrupousuario_set['lixeira_sysusu'])=="0") { $_POST['lixeira_sysusu']=0; } else { $_POST['lixeira_sysusu']=1; }             
				if(trim($sysgrupousuario_set['restaurar_sysusu'])==""||trim($sysgrupousuario_set['restaurar_sysusu'])=="0") { $_POST['restaurar_sysusu']=0; } else { $_POST['restaurar_sysusu']=1; }             
				if(trim($sysgrupousuario_set['senha_sysusu'])==""||trim($sysgrupousuario_set['senha_sysusu'])=="0") { $_POST['senha_sysusu']=0; } else { $_POST['senha_sysusu']=1; }             
				if(trim($sysgrupousuario_set['dados_sysusu'])==""||trim($sysgrupousuario_set['dados_sysusu'])=="0") { $_POST['dados_sysusu']=0; } else { $_POST['dados_sysusu']=1; }             
				if(trim($sysgrupousuario_set['configuracao_sysusu'])==""||trim($sysgrupousuario_set['configuracao_sysusu'])=="0") { $_POST['configuracao_sysusu']=0; } else { $_POST['configuracao_sysusu']=1; }
				if(trim($sysgrupousuario_set['chat_sysusu'])==""||trim($sysgrupousuario_set['chat_sysusu'])=="0") { $_POST['chat_sysusu']=0; } else { $_POST['chat_sysusu']=1; }
			
				if(trim($sysgrupousuario_set['visualizar_sysgrupousuario'])==""||trim($sysgrupousuario_set['visualizar_sysgrupousuario'])=="0") { $_POST['visualizar_sysgrupousuario']=0; } else { $_POST['visualizar_sysgrupousuario']=1; }             
				if(trim($sysgrupousuario_set['inserir_sysgrupousuario'])==""||trim($sysgrupousuario_set['inserir_sysgrupousuario'])=="0") { $_POST['inserir_sysgrupousuario']=0; } else { $_POST['inserir_sysgrupousuario']=1; }             
				if(trim($sysgrupousuario_set['editar_sysgrupousuario'])==""||trim($sysgrupousuario_set['editar_sysgrupousuario'])=="0") { $_POST['editar_sysgrupousuario']=0; } else { $_POST['editar_sysgrupousuario']=1; }             
				if(trim($sysgrupousuario_set['excluir_sysgrupousuario'])==""||trim($sysgrupousuario_set['excluir_sysgrupousuario'])=="0") { $_POST['excluir_sysgrupousuario']=0; } else { $_POST['excluir_sysgrupousuario']=1; }             
				if(trim($sysgrupousuario_set['publicar_sysgrupousuario'])==""||trim($sysgrupousuario_set['publicar_sysgrupousuario'])=="0") { $_POST['publicar_sysgrupousuario']=0; } else { $_POST['publicar_sysgrupousuario']=1; }             
				if(trim($sysgrupousuario_set['despublicar_sysgrupousuario'])==""||trim($sysgrupousuario_set['despublicar_sysgrupousuario'])=="0") { $_POST['despublicar_sysgrupousuario']=0; } else { $_POST['despublicar_sysgrupousuario']=1; }             
				if(trim($sysgrupousuario_set['lixeira_sysgrupousuario'])==""||trim($sysgrupousuario_set['lixeira_sysgrupousuario'])=="0") { $_POST['lixeira_sysgrupousuario']=0; } else { $_POST['lixeira_sysgrupousuario']=1; }             
				if(trim($sysgrupousuario_set['restaurar_sysgrupousuario'])==""||trim($sysgrupousuario_set['restaurar_sysgrupousuario'])=="0") { $_POST['restaurar_sysgrupousuario']=0; } else { $_POST['restaurar_sysgrupousuario']=1; }             
			
				if(trim($sysgrupousuario_set['visualizar_sysmidia'])==""||trim($sysgrupousuario_set['visualizar_sysmidia'])=="0") { $_POST['visualizar_sysmidia']=0; } else { $_POST['visualizar_sysmidia']=1; }             
			
				if(trim($sysgrupousuario_set['visualizar_syspermadmin'])==""||trim($sysgrupousuario_set['visualizar_syspermadmin'])=="0") { $_POST['visualizar_syspermadmin']=0; } else { $_POST['visualizar_syspermadmin']=1; }             
				if(trim($sysgrupousuario_set['editar_syspermadmin'])==""||trim($sysgrupousuario_set['editar_syspermadmin'])=="0") { $_POST['editar_syspermadmin']=0; } else { $_POST['editar_syspermadmin']=1; }             
			
				if(trim($sysgrupousuario_set['visualizar_syssuporte'])==""||trim($sysgrupousuario_set['visualizar_syssuporte'])=="0") { $_POST['visualizar_syssuporte']=0; } else { $_POST['visualizar_syssuporte']=1; }             
				if(trim($sysgrupousuario_set['inserir_syssuporte'])==""||trim($sysgrupousuario_set['inserir_syssuporte'])=="0") { $_POST['inserir_syssuporte']=0; } else { $_POST['inserir_syssuporte']=1; }             
			
				if(trim($sysgrupousuario_set['visualizar_sysacesso'])==""||trim($sysgrupousuario_set['visualizar_sysacesso'])=="0") { $_POST['visualizar_sysacesso']=0; } else { $_POST['visualizar_sysacesso']=1; }             
				if(trim($sysgrupousuario_set['admin_sysacesso'])==""||trim($sysgrupousuario_set['admin_sysacesso'])=="0") { $_POST['admin_sysacesso']=0; } else { $_POST['admin_sysacesso']=1; }             
			
				if(trim($sysgrupousuario_set['visualizar_syslog'])==""||trim($sysgrupousuario_set['visualizar_syslog'])=="0") { $_POST['visualizar_syslog']=0; } else { $_POST['visualizar_syslog']=1; }             
				if(trim($sysgrupousuario_set['admin_syslog'])==""||trim($sysgrupousuario_set['admin_syslog'])=="0") { $_POST['admin_syslog']=0; } else { $_POST['admin_syslog']=1; }             
			
				if(trim($sysgrupousuario_set['visualizar_sysfonte'])==""||trim($sysgrupousuario_set['visualizar_sysfonte'])=="0") { $_POST['visualizar_sysfonte']=0; } else { $_POST['visualizar_sysfonte']=1; }             
			
				if(trim($sysgrupousuario_set['admin_sysconfig'])==""||trim($sysgrupousuario_set['admin_sysconfig'])=="0") { $_POST['admin_sysconfig']=0; } else { $_POST['admin_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['site_sysconfig'])==""||trim($sysgrupousuario_set['site_sysconfig'])=="0") { $_POST['site_sysconfig']=0; } else { $_POST['site_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['layout_sysconfig'])==""||trim($sysgrupousuario_set['layout_sysconfig'])=="0") { $_POST['layout_sysconfig']=0; } else { $_POST['layout_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['imagens_sysconfig'])==""||trim($sysgrupousuario_set['imagens_sysconfig'])=="0") { $_POST['imagens_sysconfig']=0; } else { $_POST['imagens_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['mensagens_sysconfig'])==""||trim($sysgrupousuario_set['mensagens_sysconfig'])=="0") { $_POST['mensagens_sysconfig']=0; } else { $_POST['mensagens_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['seo_sysconfig'])==""||trim($sysgrupousuario_set['seo_sysconfig'])=="0") { $_POST['seo_sysconfig']=0; } else { $_POST['seo_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['indexacao_sysconfig'])==""||trim($sysgrupousuario_set['indexacao_sysconfig'])=="0") { $_POST['indexacao_sysconfig']=0; } else { $_POST['indexacao_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['analytics_sysconfig'])==""||trim($sysgrupousuario_set['analytics_sysconfig'])=="0") { $_POST['analytics_sysconfig']=0; } else { $_POST['analytics_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['erro404_sysconfig'])==""||trim($sysgrupousuario_set['erro404_sysconfig'])=="0") { $_POST['erro404_sysconfig']=0; } else { $_POST['erro404_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['instalacao_sysconfig'])==""||trim($sysgrupousuario_set['instalacao_sysconfig'])=="0") { $_POST['instalacao_sysconfig']=0; } else { $_POST['instalacao_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['dominios_sysconfig'])==""||trim($sysgrupousuario_set['dominios_sysconfig'])=="0") { $_POST['dominios_sysconfig']=0; } else { $_POST['dominios_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['servidor_sysconfig'])==""||trim($sysgrupousuario_set['servidor_sysconfig'])=="0") { $_POST['servidor_sysconfig']=0; } else { $_POST['servidor_sysconfig']=1; }             
				if(trim($sysgrupousuario_set['visualizar_sysconfig'])==""||trim($sysgrupousuario_set['visualizar_sysconfig'])=="0") { $_POST['visualizar_sysconfig']=0; } else { $_POST['visualizar_sysconfig']=1; }             
			
				$qSql = mysql_query("SELECT * FROM sysmod WHERE stat='1' ORDER BY ordem");
				while($rSql = mysql_fetch_array($qSql)) {
					if(trim($sysgrupousuario_set['visualizar_'.$rSql['bd'].''])==""||trim($sysgrupousuario_set['visualizar_'.$rSql['bd'].''])=="0") { $_POST['visualizar_'.$rSql['bd'].'']=0; } else { $_POST['visualizar_'.$rSql['bd'].'']=1; }             
					if(trim($sysgrupousuario_set['todos_'.$rSql['bd'].''])==""||trim($sysgrupousuario_set['todos_'.$rSql['bd'].''])=="0") { $_POST['todos_'.$rSql['bd'].'']=0; } else { $_POST['todos_'.$rSql['bd'].'']=1; }             
					if(trim($sysgrupousuario_set['inserir_'.$rSql['bd'].''])==""||trim($sysgrupousuario_set['inserir_'.$rSql['bd'].''])=="0") { $_POST['inserir_'.$rSql['bd'].'']=0; } else { $_POST['inserir_'.$rSql['bd'].'']=1; }             
					if(trim($sysgrupousuario_set['editar_'.$rSql['bd'].''])==""||trim($sysgrupousuario_set['editar_'.$rSql['bd'].''])=="0") { $_POST['editar_'.$rSql['bd'].'']=0; } else { $_POST['editar_'.$rSql['bd'].'']=1; }             
					if(trim($sysgrupousuario_set['excluir_'.$rSql['bd'].''])==""||trim($sysgrupousuario_set['excluir_'.$rSql['bd'].''])=="0") { $_POST['excluir_'.$rSql['bd'].'']=0; } else { $_POST['excluir_'.$rSql['bd'].'']=1; }             
					if(trim($sysgrupousuario_set['publicar_'.$rSql['bd'].''])==""||trim($sysgrupousuario_set['publicar_'.$rSql['bd'].''])=="0") { $_POST['publicar_'.$rSql['bd'].'']=0; } else { $_POST['publicar_'.$rSql['bd'].'']=1; }             
					if(trim($sysgrupousuario_set['despublicar_'.$rSql['bd'].''])==""||trim($sysgrupousuario_set['despublicar_'.$rSql['bd'].''])=="0") { $_POST['despublicar_'.$rSql['bd'].'']=0; } else { $_POST['despublicar_'.$rSql['bd'].'']=1; }             
					if(trim($sysgrupousuario_set['lixeira_'.$rSql['bd'].''])==""||trim($sysgrupousuario_set['lixeira_'.$rSql['bd'].''])=="0") { $_POST['lixeira_'.$rSql['bd'].'']=0; } else { $_POST['lixeira_'.$rSql['bd'].'']=1; }             
					if(trim($sysgrupousuario_set['restaurar_'.$rSql['bd'].''])==""||trim($sysgrupousuario_set['restaurar_'.$rSql['bd'].''])=="0") { $_POST['restaurar_'.$rSql['bd'].'']=0; } else { $_POST['restaurar_'.$rSql['bd'].'']=1; }             
					if(trim($sysgrupousuario_set['descricao_'.$rSql['bd'].''])==""||trim($sysgrupousuario_set['descricao_'.$rSql['bd'].''])=="0") { $_POST['descricao_'.$rSql['bd'].'']=0; } else { $_POST['descricao_'.$rSql['bd'].'']=1; }             
					if(trim($sysgrupousuario_set['seo_'.$rSql['bd'].''])==""||trim($sysgrupousuario_set['seo_'.$rSql['bd'].''])=="0") { $_POST['seo_'.$rSql['bd'].'']=0; } else { $_POST['seo_'.$rSql['bd'].'']=1; }             
				}
	
				$sysusu_exist = mysql_num_rows(mysql_query("SELECT * FROM syspermadmin WHERE idsysusu='".$rSqlSysusu['id']."'"));
	
				if(trim($sysusu_exist)==0) {
					$_POST['numeroUnico'] = geraCodReturn();
		
					insert($_POST,"syspermadmin");
				} else {
					$syspermadmin_set = mysql_fetch_array(mysql_query("SELECT * FROM syspermadmin WHERE idsysusu='".$rSqlSysusu['id']."'"));
					update($_POST,"syspermadmin",$syspermadmin_set['id']);
				}

			}
			
		} else {
			if(trim($_POST['acaoForm'])=="excluir") {
				foreach ($_POST['msg_sel'] as $idcheck) {
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
					}
				}
			}
		}
	}

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
?>