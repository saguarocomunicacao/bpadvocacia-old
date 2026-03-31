<?
	$caminho1 = "Suporte";
	$caminhourl1 = "".$link."suporte/"; 

	if(trim($_REQUEST['var3'])=="")    { 
		$pagina="mod/".$mod."/list.php";    
	} else {
		if(trim($_REQUEST['var3'])=="detalhes")    { 
			$r = mysql_fetch_array(mysql_query("SELECT * FROM conteudo WHERE toDO='erro-404'"));
			$pagina="404.php";    
			$caminho1 = "Página não encontrada"; 
			/*
			$pagina="mod/".$mod."/form.php";    
			$id = "".$_REQUEST['var4']."";
			$confere = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idchamado='".$id."'"));
			if($confere==0) {
				$r = mysql_fetch_array(mysql_query("SELECT * FROM syssistema"));
				$pagina="404.php";    
				$caminho1 = "Página não encontrada"; 
			} else {
				$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE idchamado='".$id."'"));
				$caminho2 = "Chamado #".$row['idchamado']."";
			}
			*/
		} else {
			if(trim($_REQUEST['var3'])=="responder")    { 
				$pagina="mod/".$mod."/responder.php";    
				$id = "".$_REQUEST['var4']."";
				$menu_set = "off";
				$confere = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idchamado='".$id."'"));
				if($confere==0) {
					$r = mysql_fetch_array(mysql_query("SELECT * FROM syssistema"));
					$pagina="404.php";    
					$caminho1 = "Página não encontrada"; 
				} else {
					$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE idchamado='".$id."'"));
					$caminho2 = "Chamado #".$row['idchamado']."";
				}
			} else {
				$r = mysql_fetch_array(mysql_query("SELECT * FROM conteudo WHERE toDO='erro-404'"));
				$pagina="404.php";    
				$caminho1 = "Página não encontrada"; 
			}
		}
	}
?>