<?
	if(trim($_POST['acaoForm'])=="add") {
		$mod = "".$linguagem_set."".$_POST['modulo']."";
	
		$data = date("Y-m-d H:i:s");
		
		$numeroUnicoGet = geraCodReturn();
		
		$insert = mysql_query("INSERT INTO adv_intimacao (
																 numeroUnico,
																 cod,
																 cod_processo,
																 data_xml,
																 orgao,
																 cidade,
																 nome,
																 jornal,
																 vara,
																 pagina,
																 texto,
																 pendente,
																 stat,
																 data,
																 dataModificacao
																 ) 
																 VALUES 
																(
																 '".$numeroUnicoGet."',
																 '".$_POST['cod']."',
																 '".$_POST['cod_processo']."',
																 '".$_POST['data_xml']."',
																 '".$_POST['orgao']."',
																 '".$_POST['cidade']."',
																 '".$_POST['nome']."',
																 '".$_POST['jornal']."',
																 '".$_POST['vara']."',
																 '".$_POST['pagina']."',
																 '".$_POST['texto']."',
																 '".$_POST['pendente']."',
																 '1',
																 '".$data."',
																 '".$data."'
																 )");
		
		if(trim($_POST['iditem'])!="") {
			$update = mysql_query("UPDATE adv_intimacao_xml SET stat='0',dataModificacao='".$data."' WHERE id='".$_POST['iditem']."'");
		}
		
		# Gravação do Log
		$logPerfil = "administrador";
		$logId = $sysusu['id'];
		$logAcao = "Adicionou";
		$logLocal = "Intimações Novas";
		$logDescricao = "Foi agendado o item de código <b>".$_POST['cod']."</b>";
		$logData = $data;
		gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
		if(trim($_POST['pendente'])=="1"||trim($_POST['pendente'])=="2"||trim($_POST['pendente'])=="3"||trim($_POST['pendente'])=="4") {
			echo"<script>window.open('".$link."intimacoes/intimacoes-novas/','_self','')</script>";
		} else {
			$adv_intimacao = mysql_fetch_array(mysql_query("SELECT id FROM adv_intimacao WHERE numeroUnico='".$numeroUnicoGet."'"));
			echo"<script>window.open('".$link."intimacoes/intimacoes-pendentes/editar/".$adv_intimacao['id']."/','_self','')</script>";
		}
	} else {
		if(trim($_POST['acaoForm'])=="add_selecionados") {

			$data = date("Y-m-d H:i:s");
	
			$_POST['ids_selecionados'] = str_replace("||",",",$_POST['ids_selecionados']);
			$_POST['ids_selecionados'] = str_replace("|","",$_POST['ids_selecionados']);
			$kws = explode(",", $_POST['ids_selecionados']);
			for($i = 0, $c = count($kws); $i < $c; $i++) {
				$cod = $kws[$i];
				$numeroUnicoGet = geraCodReturn();

				if($sysusu['id']=="1") {
					echo "<script>alert('[".$kws[$i]."]');</script>";
					$update = mysql_query("UPDATE adv_intimacao_xml SET stat='1',pendente='".$_POST['acao_definida']."' WHERE id='".$kws[$i]."'");
				} else {
					$insert = mysql_query("INSERT INTO adv_intimacao (
																			 numeroUnico,
																			 cod,
																			 cod_processo,
																			 data_xml,
																			 orgao,
																			 cidade,
																			 nome,
																			 jornal,
																			 vara,
																			 pagina,
																			 texto,
																			 pendente,
																			 stat,
																			 data,
																			 dataModificacao
																			 ) 
																			 VALUES 
																			(
																			 '".$numeroUnicoGet."',
																			 '".$_POST[''.$cod.'_cod']."',
																			 '".$_POST[''.$cod.'_cod_processo']."',
																			 '".$_POST[''.$cod.'_data_xml']."',
																			 '".$_POST[''.$cod.'_orgao']."',
																			 '".$_POST[''.$cod.'_cidade']."',
																			 '".$_POST[''.$cod.'_nome']."',
																			 '".$_POST[''.$cod.'_jornal']."',
																			 '".$_POST[''.$cod.'_vara']."',
																			 '".$_POST[''.$cod.'_pagina']."',
																			 '".$_POST[''.$cod.'_texto']."',
																			 '".$_POST['acao_definida']."',
																			 '1',
																			 '".$data."',
																			 '".$data."'
																			 )");
				}
			}
			echo"<script>window.open('".$link."intimacoes/intimacoes-pendentes/tipo/".$_POST['acao_definida']."/','_self','')</script>";
		} else {
			if(trim($_POST['acaoForm'])=="add_selecionados_cron") {
				$_POST['ids_selecionados'] = str_replace("||",",",$_POST['ids_selecionados']);
				$_POST['ids_selecionados'] = str_replace("|","",$_POST['ids_selecionados']);
				$kws = explode(",", $_POST['ids_selecionados']);
				for($i = 0, $c = count($kws); $i < $c; $i++) {
					$numeroUnicoGet = geraCodReturn();
					$idSet = $kws[$i];
					$mod_adv_intimacao = "adv_intimacao";
					$insert = mysql_query("INSERT INTO adv_intimacao_cron (
																			 numeroUnico,
																			 cod,
																			 cod_processo,
																			 data_xml,
																			 orgao,
																			 cidade,
																			 nome,
																			 jornal,
																			 vara,
																			 pagina,
																			 texto,
																			 pendente,
																			 stat,
																			 data,
																			 dataModificacao
																			 ) 
																			 VALUES 
																			(
																			 '".$numeroUnicoGet."',
																			 '".$_SESSION['intimaca_'.$idSet.'']['cod']."',
																			 '".$_SESSION['intimaca_'.$idSet.'']['cod_processo']."',
																			 '".$_SESSION['intimaca_'.$idSet.'']['data_xml']."',
																			 '".$_SESSION['intimaca_'.$idSet.'']['orgao']."',
																			 '".$_SESSION['intimaca_'.$idSet.'']['cidade']."',
																			 '".$_SESSION['intimaca_'.$idSet.'']['nome']."',
																			 '".$_SESSION['intimaca_'.$idSet.'']['jornal']."',
																			 '".$_SESSION['intimaca_'.$idSet.'']['vara']."',
																			 '".$_SESSION['intimaca_'.$idSet.'']['pagina']."',
																			 '".$_SESSION['intimaca_'.$idSet.'']['texto']."',
																			 '".$_POST['acao_definida']."',
																			 '1',
																			 '".$data."',
																			 '".$data."'
																			 )");

					$insert = mysql_query("INSERT INTO ".$mod_adv_intimacao." (
																				 numeroUnico,
																				 cod,
																				 cod_processo,
																				 data_xml,
																				 orgao,
																				 cidade,
																				 nome,
																				 jornal,
																				 vara,
																				 pagina,
																				 texto,
																				 pendente,
																				 stat,
																				 data,
																				 dataModificacao
																				 ) 
																				 VALUES 
																				(
																				 '".$numeroUnicoGet."',
																				 '".$_SESSION['intimaca_'.$idSet.'']['cod']."',
																				 '".$_SESSION['intimaca_'.$idSet.'']['cod_processo']."',
																				 '".$_SESSION['intimaca_'.$idSet.'']['data_xml']."',
																				 '".$_SESSION['intimaca_'.$idSet.'']['orgao']."',
																				 '".$_SESSION['intimaca_'.$idSet.'']['cidade']."',
																				 '".$_SESSION['intimaca_'.$idSet.'']['nome']."',
																				 '".$_SESSION['intimaca_'.$idSet.'']['jornal']."',
																				 '".$_SESSION['intimaca_'.$idSet.'']['vara']."',
																				 '".$_SESSION['intimaca_'.$idSet.'']['pagina']."',
																				 '".$_SESSION['intimaca_'.$idSet.'']['texto']."',
																				 '".$_POST['acao_definida']."',
																				 '1',
																				 '".$data."',
																				 '".$data."'
																				 )");

					$sql = mysql_query("DELETE FROM adv_intimacao_xml WHERE id='".$idSet."'");
				}
				echo"<script>window.open('".$link."intimacoes/intimacoes-pendentes/tipo/".$_POST['acao_definida']."/','_self','')</script>";
			}
		}
	}

?>