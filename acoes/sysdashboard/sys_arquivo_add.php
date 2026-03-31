<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");


#$qSql = mysql_query("SELECT * FROM sysagenda");
#$qSql = mysql_query("SELECT * FROM adv_processo_agenda");
#$qSql = mysql_query("SELECT * FROM adv_intimacao_agenda");
#$qSql = mysql_query("SELECT * FROM syscronograma");

$qSql = mysql_query("SELECT * FROM ".$_REQUEST['tipo']."");
while($rSql = mysql_fetch_array($qSql)) {

	if(trim($rSql['data_inicio'])=="" || trim($rSql['data_inicio'])=="0000-00-00"  ) {
		if(trim($rSql['data_fim'])=="" || trim($rSql['data_fim'])=="0000-00-00"  ) {
			$rSql['data_inicio'] = "".date("Y-m-d")."";		
		} else {
			$rSql['data_inicio'] = $rSql['data_fim'];		
		}
	} else {
		$rSql['data_inicio'] = $rSql['data_inicio'];
	}

	if(trim($rSql['data_fim'])=="" || trim($rSql['data_fim'])=="0000-00-00"  ) {
		if(trim($rSql['data_inicio'])=="" || trim($rSql['data_inicio'])=="0000-00-00"  ) {
			$rSql['data_fim'] = "".date("Y-m-d")."";		
		} else {
			$rSql['data_fim'] = $rSql['data_inicio'];		
		}
	} else {
		$rSql['data_fim'] = $rSql['data_fim'];
	}


	if(trim($rSql['hora_inicio'])=="" || trim($rSql['hora_inicio'])=="00:00:00"  ) {
		if(trim($rSql['hora_fim'])=="" || trim($rSql['hora_fim'])=="00:00:00"  ) {
			$rSql['hora_inicio'] = "".date("Y-m-d")."";		
		} else {
			$rSql['hora_inicio'] = $rSql['hora_fim'];		
		}
	} else {
		$rSql['hora_inicio'] = $rSql['hora_inicio'];
	}

	if(trim($rSql['hora_fim'])=="" || trim($rSql['hora_fim'])=="00:00:00"  ) {
		if(trim($rSql['hora_inicio'])=="" || trim($rSql['hora_inicio'])=="00:00:00"  ) {
			$rSql['hora_fim'] = "".date("Y-m-d")."";		
		} else {
			$rSql['hora_fim'] = $rSql['hora_inicio'];		
		}
	} else {
		$rSql['hora_fim'] = $rSql['hora_fim'];
	}

	$insert = mysql_query("INSERT INTO `sys_arquivo`
													(
													`tabela`,
													`id_antigo`,
													`numeroUnico`,
													`numeroUnico_pai`,
													`idsysagenda_categoria`,
													`idsyscliente`,
													`idsyscontrato`,
													`idsyscontrato_item`,
													`criador`,
													`horas`,
													`responsavel`,
													`lista_admin`,
													`situacao`,
													`cor`,
													`nome`,
													`imagem`,
													`arquivo`,
													`arquivo_2`,
													`arquivo_3`,
													`arquivo_4`,
													`arquivo_5`,
													`descricao`,
													`texto`,
													`data_criacao`,
													`hora_criacao`,
													`data_inicio`,
													`hora_inicio`,
													`data_fim`,
													`hora_fim`,
													`edicao_aberta`,
													`somente_criador`,
													`mostrar_dashboard`,
													`mostrar_agenda`,
													`aprovado`,
													`concluido`,
													`concluidor`,
													`stat`,
													`data`,
													`dataModificacao`)
												VALUES
													(
													'".$_REQUEST['tipo']."',
													'".$rSql['id']."',
													'".$rSql['numeroUnico']."',
													'".$rSql['numeroUnico_pai']."',
													'".$rSql['idsysagenda_categoria']."',
													'".$rSql['idsyscliente']."',
													'".$rSql['idsyscontrato']."',
													'".$rSql['idsyscontrato_item']."',
													'".$rSql['criador']."',
													'".$rSql['horas']."',
													'".$rSql['responsavel']."',
													'".$rSql['lista_admin']."',
													'".$rSql['situacao']."',
													'".$rSql['cor']."',
													'".$rSql['nome']."',
													'".$rSql['imagem']."',
													'".$rSql['arquivo']."',
													'".$rSql['arquivo_2']."',
													'".$rSql['arquivo_3']."',
													'".$rSql['arquivo_4']."',
													'".$rSql['arquivo_5']."',
													'".$rSql['descricao']."',
													'".$rSql['texto']."',
													'".$rSql['data_criacao']."',
													'".$rSql['hora_criacao']."',
													'".$rSql['data_inicio']."',
													'".$rSql['hora_inicio']."',
													'".$rSql['data_fim']."',
													'".$rSql['hora_fim']."',
													'".$rSql['edicao_aberta']."',
													'".$rSql['somente_criador']."',
													'".$rSql['mostrar_dashboard']."',
													'".$rSql['mostrar_agenda']."',
													'".$rSql['aprovado']."',
													'".$rSql['concluido']."',
													'".$rSql['concluidor']."',
													'".$rSql['stat']."',
													'".$rSql['data']."',
													'".$rSql['dataModificacao']."'
													);");

}
?>
