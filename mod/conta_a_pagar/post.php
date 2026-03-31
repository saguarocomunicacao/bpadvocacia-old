<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add") {

		if(trim($_POST['importante'])=="") { $_POST['importante']=0; } else { $_POST['importante']=1; }
		if(trim($_POST['enviar_email'])=="") { $_POST['enviar_email']=0; } else { $_POST['enviar_email']=1; }

		upload_arquivo($mod."","anexo","");
		
		$_POST['data_emissao'] = normalTOdate($_POST['data_emissao']);
		$_POST['data_vencimento'] = normalTOdate($_POST['data_vencimento']);
		$_POST['data_pagamento'] = normalTOdate($_POST['data_pagamento']);

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

		for ($i = 0; $i <= $_POST['parcelas']; $i++) {

			$d  = substr($_POST['data_vencimento'],8,2);
			$m  = substr($_POST['data_vencimento'],5,2);
			$a  = substr($_POST['data_vencimento'],0,4);
			
			$mes_set = $m + $i;
			
			$data_vencimento_set = "".$a."-".$mes_set."-".$d."";
			
			if($i>0) { $CodFatura = geraCodContReturn(10); $_POST['cod'] = strtoupper($CodFatura); } 

			$insert = mysql_query("INSERT INTO ".$mod." (
														  cod,
														  numeroUnico,
														  idconta_a_pagar_categoria,
														  idforma_pagamento,
														  idbanco,
														  importante,
														  enviar_email,
														  email_enviado,
														  enviar_email_dias,
														  nome,
														  anexo,
														  autor,
														  nf,
														  codigo_barra,
														  valor_real,
														  valor_juros,
														  valor_desconto,
														  texto,
														  data_emissao,
														  data_vencimento,
														  data_pagamento,
														  data,
														  dataModificacao,
														  stat
														  )
														  
														  VALUES
														  
														  (
														  '".$_POST['cod']."',
														  '".$_POST['numeroUnico']."',
														  '".$_POST['idconta_a_pagar_categoria']."',
														  '".$_POST['idforma_pagamento']."',
														  '".$_POST['idbanco']."',
														  '".$_POST['importante']."',
														  '".$_POST['enviar_email']."',
														  '0',
														  '".$_POST['enviar_email_dias']."',
														  '".$_POST['nome']."',
														  '".$_POST['anexo']."',
														  '".$_POST['autor']."',
														  '".$_POST['nf']."',
														  '".$_POST['codigo_barra']."',
														  '".$_POST['valor_real']."',
														  '".$_POST['valor_juros']."',
														  '".$_POST['valor_desconto']."',
														  '".$_POST['texto']."',
														  '".$_POST['data_emissao']."',
														  '".$data_vencimento_set."',
														  '".$_POST['data_pagamento']."',
														  '".$_POST['data']."',
														  '".$_POST['dataModificacao']."',
														  '".$_POST['stat']."'
														  )");
		}

	} else {
		if(trim($_POST['acaoForm'])=="editar") {
			$idEditavel = $_POST['iditem'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));

			if(trim($_POST['importante'])=="") { $_POST['importante']=0; } else { $_POST['importante']=1; }
			if(trim($_POST['enviar_email'])=="") { $_POST['enviar_email']=0; } else { $_POST['enviar_email']=1; }

			upload_arquivo($mod."","anexo","");

			$_POST['data_emissao'] = normalTOdate($_POST['data_emissao']);
			$_POST['data_vencimento'] = normalTOdate($_POST['data_vencimento']);
			$_POST['data_pagamento'] = normalTOdate($_POST['data_pagamento']);

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

			$update = mysql_query("UPDATE ".$mod." SET 
													 numeroUnico='".$_POST['numeroUnico']."',
													 cod='".$_POST['cod']."',
													 idconta_a_pagar_categoria='".$_POST['idconta_a_pagar_categoria']."',
													 idforma_pagamento='".$_POST['idforma_pagamento']."',
													 idbanco='".$_POST['idbanco']."',
													 importante='".$_POST['importante']."',
													 enviar_email='".$_POST['enviar_email']."',
													 enviar_email_dias='".$_POST['enviar_email_dias']."',
													 nome='".$_POST['nome']."',
													 anexo='".$_POST['anexo']."',
													 autor='".$_POST['autor']."',
													 nf='".$_POST['nf']."',
													 codigo_barra='".$_POST['codigo_barra']."',
													 valor_real='".$_POST['valor_real']."',
													 valor_juros='".$_POST['valor_juros']."',
													 valor_desconto='".$_POST['valor_desconto']."',
													 texto='".$_POST['texto']."',
													 data_emissao='".$_POST['data_emissao']."', 
													 data_vencimento='".$_POST['data_vencimento']."', 
													 data_pagamento='".$_POST['data_pagamento']."', 
													 dataModificacao='".$_POST['dataModificacao']."' 
													 
													 WHERE id='".$itemAtual['id']."'");
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