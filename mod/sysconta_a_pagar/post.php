<?
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add"||trim($_POST['acaoForm'])=="add-continuar"||trim($_POST['acaoForm'])=="add-clone") {

		if(trim($_POST['acaoForm'])=="add-clone") {
			$_POST['numeroUnico'] = geraCodReturn();
		}
		
		if(trim($_POST['mostrar_agenda'])=="") { $_POST['mostrar_agenda']=0; } else { $_POST['mostrar_agenda']=1; }
		if(trim($_POST['mostrar_dashboard'])=="") { $_POST['mostrar_dashboard']=0; } else { $_POST['mostrar_dashboard']=1; }
		if(trim($_POST['pago'])=="") { $_POST['pago']=0; } else { $_POST['pago']=1; }             

		$_POST['data_referencia'] = normalTOdate($_POST['data_referencia']);
		$_POST['data_emissao'] = normalTOdate($_POST['data_emissao']);
		$_POST['data_vencimento'] = normalTOdate($_POST['data_vencimento']);
		$_POST['data_pagamento'] = normalTOdate($_POST['data_pagamento']);

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

			$_POST['dataModificacao'] = $data;

			update($_POST,$mod."",$idEditavel);

			$itemFluxo = mysql_fetch_array(mysql_query("SELECT * FROM sysfluxo_de_caixa WHERE numeroUnico_pai='".$_POST['numeroUnico']."'"));
			$update = mysql_query("UPDATE sysfluxo_de_caixa SET 
															   data_referencia='".$_POST['data_referencia']."',
															   data_emissao='".$_POST['data_emissao']."',
															   data_vencimento='".$_POST['data_vencimento']."',
															   data_pagamento='".$_POST['data_pagamento']."',
															   pago='".$_POST['pago']."',
															   stat='".$_POST['stat']."',
															   dataModificacao='".$data."' 
															   WHERE id='".$itemFluxo['id']."'");

		} else {
			# Gravação do Log
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Adicionar";
			$logLocal = "".$caminho1."";
			$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
			$logData = $data;
	
			$_POST['data'] = $data;
			$_POST['dataModificacao'] = $data;
	
			insert($_POST,$mod."");

			$_POST['numeroUnicoFluxo'] = geraCodReturn();
			$insert = mysql_query("INSERT INTO sysfluxo_de_caixa (
			                                                      numeroUnico,
																  numeroUnico_pai,
																  local,
																  data_referencia,
																  data_emissao,
																  data_vencimento,
																  data_pagamento,
																  pago,
																  stat,
																  data,
																  dataModificacao
																  ) 
																  VALUES 
															     (
																  '".$_POST['numeroUnicoFluxo']."',
																  '".$_POST['numeroUnico']."',
																  'sysconta_a_pagar',
																  '".$_POST['data_referencia']."',
																  '".$_POST['data_emissao']."',
																  '".$_POST['data_vencimento']."',
																  '".$_POST['data_pagamento']."',
																  '".$_POST['pago']."',
																  '".$_POST['stat']."',
																  '".$data."',
																  '".$data."'
																  )");

		}


	} else {
		if(trim($_POST['acaoForm'])=="editar") {
			$idEditavel = $_POST['iditem'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
			
			if(trim($_POST['mostrar_agenda'])=="") { $_POST['mostrar_agenda']=0; } else { $_POST['mostrar_agenda']=1; }
			if(trim($_POST['mostrar_dashboard'])=="") { $_POST['mostrar_dashboard']=0; } else { $_POST['mostrar_dashboard']=1; }
			if(trim($_POST['pago'])=="") { $_POST['pago']=0; } else { $_POST['pago']=1; }             

			$_POST['data_referencia'] = normalTOdate($_POST['data_referencia']);
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

			$_POST['dataModificacao'] = $data;

			update($_POST,$mod."",$idEditavel);

			$itemFluxo = mysql_fetch_array(mysql_query("SELECT * FROM sysfluxo_de_caixa WHERE numeroUnico_pai='".$_POST['numeroUnico']."'"));
			$update = mysql_query("UPDATE sysfluxo_de_caixa SET 
															   data_referencia='".$_POST['data_referencia']."',
															   data_emissao='".$_POST['data_emissao']."',
															   data_vencimento='".$_POST['data_vencimento']."',
															   data_pagamento='".$_POST['data_pagamento']."',
															   pago='".$_POST['pago']."',
															   stat='".$_POST['stat']."',
															   dataModificacao='".$data."' 
															   WHERE id='".$itemFluxo['id']."'");
		} else {
			if(trim($_POST['acaoForm'])=="excluir") {
				foreach ($_POST['msg_sel'] as $idcheck) {
					$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idcheck."'"));
					$itemFluxo = mysql_fetch_array(mysql_query("SELECT * FROM sysfluxo_de_caixa WHERE numeroUnico_pai='".$item['numeroUnico']."'"));

					$sql = mysql_query("DELETE FROM ".$mod." WHERE id='".$idcheck."'");
					$sqlFluxo = mysql_query("DELETE FROM sysfluxo_de_caixa WHERE id='".$itemFluxo['id']."'");
				}
			} else {
				if(trim($_POST['acaoForm'])=="publicar") {
					foreach ($_POST['msg_sel'] as $idcheck) {
						$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idcheck."'"));
						$itemFluxo = mysql_fetch_array(mysql_query("SELECT * FROM sysfluxo_de_caixa WHERE numeroUnico_pai='".$item['numeroUnico']."'"));

						$sql = mysql_query("UPDATE ".$mod." SET stat='1' WHERE id='".$idcheck."'");
						$sqlFluxo = mysql_query("UPDATE sysfluxo_de_caixa SET stat='1' WHERE id='".$itemFluxo['id']."'");
					}
				} else {
					if(trim($_POST['acaoForm'])=="despublicar") {
						foreach ($_POST['msg_sel'] as $idcheck) {
							$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idcheck."'"));
							$itemFluxo = mysql_fetch_array(mysql_query("SELECT * FROM sysfluxo_de_caixa WHERE numeroUnico_pai='".$item['numeroUnico']."'"));

							$sql = mysql_query("UPDATE ".$mod." SET stat='0' WHERE id='".$idcheck."'");
							$sqlFluxo = mysql_query("UPDATE sysfluxo_de_caixa SET stat='0' WHERE id='".$itemFluxo['id']."'");
						}
					} else {
					}
				}
			}
		}
	}

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	if(trim($_POST['acaoForm'])=="add-continuar") {
		$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
		echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$item['id']."/','_self','')</script>";
	} else {
		echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
	}
?>