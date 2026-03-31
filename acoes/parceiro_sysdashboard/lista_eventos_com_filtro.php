<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");


$criadorGet = $_GET['criadorS'];

$sysusu_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$criadorGet."'"));

$listaIdGetparceiro_syscronograma = $_GET['listaIdSparceiro_syscronograma'];
if(trim($listaIdGetparceiro_syscronograma)=="") {
	$pesquisaListaIdsparceiro_syscronograma = "";
} else {
	$listaIdGetparceiro_syscronograma = str_replace("||","','",$listaIdGetparceiro_syscronograma);
	$listaIdGetparceiro_syscronograma = str_replace("|","'",$listaIdGetparceiro_syscronograma);
	$pesquisaListaIdsparceiro_syscronograma = "AND situacao IN (".$listaIdGetparceiro_syscronograma.") ";
}

$listaIdGetparceiro_sysagenda = $_GET['listaIdSparceiro_sysagenda'];
if(trim($listaIdGetparceiro_sysagenda)=="") {
	$pesquisaListaIdsparceiro_sysagenda = "";
} else {
	$listaIdGetparceiro_sysagenda = str_replace("||","','",$listaIdGetparceiro_sysagenda);
	$listaIdGetparceiro_sysagenda = str_replace("|","'",$listaIdGetparceiro_sysagenda);
	$pesquisaListaIdsparceiro_sysagenda = " AND idparceiro_sysagenda_categoria IN (".$listaIdGetparceiro_sysagenda.") ";
}

$listaIdGetSysconta_a_pagar = $_GET['listaIdSSysconta_a_pagar'];
if(trim($listaIdGetSysconta_a_pagar)=="") {
	$pesquisaListaIdsSysconta_a_pagar = "";
} else {
	$listaIdGetSysconta_a_pagar = str_replace("||","','",$listaIdGetSysconta_a_pagar);
	$listaIdGetSysconta_a_pagar = str_replace("|","'",$listaIdGetSysconta_a_pagar);
	$pesquisaListaIdsSysconta_a_pagar = " AND idsysconta_a_pagar_categoria IN (".$listaIdGetSysconta_a_pagar.") ";
}

$listaIdGetSysconta_a_receber = $_GET['listaIdSSysconta_a_receber'];
if(trim($listaIdGetSysconta_a_receber)=="") {
	$pesquisaListaIdsSysconta_a_receber = "";
} else {
	$listaIdGetSysconta_a_receber = str_replace("||","','",$listaIdGetSysconta_a_receber);
	$listaIdGetSysconta_a_receber = str_replace("|","'",$listaIdGetSysconta_a_receber);
	$pesquisaListaIdsSysconta_a_receber = " AND idsysconta_a_receber_categoria IN (".$listaIdGetSysconta_a_receber.") ";
}

$listaIdGetparceiro_adv_processo = $_GET['listaIdSparceiro_adv_processo'];
if(trim($listaIdGetparceiro_adv_processo)=="") {
	$pesquisaListaIdsparceiro_adv_processo = "";
} else {
	$listaIdGetparceiro_adv_processo = str_replace("||","','",$listaIdGetparceiro_adv_processo);
	$listaIdGetparceiro_adv_processo = str_replace("|","'",$listaIdGetparceiro_adv_processo);
	$pesquisaListaIdsparceiro_adv_processo = " AND idparceiro_adv_processo_tipo IN (".$listaIdGetparceiro_adv_processo.") ";
}

$i=0;

if($pesquisaListaIdsparceiro_syscronograma=="") { } else {

$rSqlUrlMod = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='parceiro_syscronograma'"));
$nomeLimpoUrlMod = transformaCaractere($rSqlUrlMod['nome']);

$rSqlUrlModCat = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlUrlMod['idsysmod_categoria']."'"));
$nomeLimpoUrlModCat = $rSqlUrlModCat['url_amigavel'];


$qSql = mysql_query("SELECT * FROM parceiro_syscronograma WHERE data BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' ".$pesquisaListaIdsparceiro_syscronograma."  ORDER BY data_inicio, hora_inicio");
while($rSql = mysql_fetch_array($qSql)) {
	
	if(trim($rSql['criador'])=="".$criadorGet.""||trim($rSql['responsavel'])=="".$criadorGet."") { 
		$mostra_parceiro_syscronograma = "1";
	} else {
		$mostra_parceiro_syscronograma = "0";
	}
	if(trim($mostra_parceiro_syscronograma)=="1") { 

		$dia  = substr($rSql['data_inicio'],8,2);
		$mes  = substr($rSql['data_inicio'],5,2);
		$ano  = substr($rSql['data_inicio'],0,4);
		$hora = substr($rSql['hora_inicio'],0,2);
		$min  = substr($rSql['hora_inicio'],3,2);
	
		$dia2  = substr($rSql['data_fim'],8,2);
		$mes2  = substr($rSql['data_fim'],5,2);
		$ano2  = substr($rSql['data_fim'],0,4);
		$hora2 = substr($rSql['hora_fim'],0,2);
		$min2  = substr($rSql['hora_fim'],3,2);
	
		if(trim($rSql['responsavel'])=="".$criadorGet."") { 
			$corSet = "".$sysusu_set['cor'].""; 
		} else {
			if(trim($rSql['situacao'])=="analise") { 
				$corSet = "#faa732"; 
			} else { 
				if(trim($rSql['situacao'])=="desenvolvimento") { 
					$corSet = "#49afcd"; 
				} else { 
					$corSet = "#4e7562"; 
				}
			}
		}
	
		$busca[$i]['id'] = "".$rSql['numeroUnico']."";
		$busca[$i]['title'] = "".$rSql['nome']."";
		$busca[$i]['description'] = "parceiro_syscronograma";
		$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
		$busca[$i]['end'] = "".$ano2."-".$mes2."-".$dia2." ".$hora2.":".$min2."";
		$busca[$i]['color'] = "".$corSet."";
		$busca[$i]['url'] = "".$link."".$nomeLimpoUrlModCat."/".$nomeLimpoUrlMod."/editar/".$rSql['id']."/";
		$busca[$i]['className'] = "myClassparceiro_syscronograma";
		$busca[$i]['allDay'] = "false";
		$i++;

	}
}
}

if($pesquisaListaIdsparceiro_sysagenda=="") { } else {

$rSqlUrlMod = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='parceiro_sysagenda'"));
$nomeLimpoUrlMod = transformaCaractere($rSqlUrlMod['nome']);

$rSqlUrlModCat = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlUrlMod['idsysmod_categoria']."'"));
$nomeLimpoUrlModCat = $rSqlUrlModCat['url_amigavel'];

$qSql = mysql_query("SELECT * FROM parceiro_sysagenda WHERE data BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' ".$pesquisaListaIdsparceiro_sysagenda." AND criador='".$criadorGet."' OR lista_admin LIKE '%|".$criadorGet."|%'  ORDER BY data_inicio, hora_inicio");
while($rSql = mysql_fetch_array($qSql)) {
	$parceiro_sysagenda_categoria_set = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_sysagenda_categoria WHERE id='".$rSql['idparceiro_sysagenda_categoria']."'"));
	
	$dia  = substr($rSql['data_inicio'],8,2);
	$mes  = substr($rSql['data_inicio'],5,2);
	$ano  = substr($rSql['data_inicio'],0,4);
	$hora = substr($rSql['hora_inicio'],0,2);
	$min  = substr($rSql['hora_inicio'],3,2);

	$dia2  = substr($rSql['data_fim'],8,2);
	$mes2  = substr($rSql['data_fim'],5,2);
	$ano2  = substr($rSql['data_fim'],0,4);
	$hora2 = substr($rSql['hora_fim'],0,2);
	$min2  = substr($rSql['hora_fim'],3,2);

	if(strrpos($rSql['lista_admin'],"|".$criadorGet."|") === false) { 
		if(trim($parceiro_sysagenda_categoria_set['cor'])=="") { 
			$corSet = "#333333"; 
		} else { 
			$corSet = "#".$parceiro_sysagenda_categoria_set['cor'].""; 
		}
	} else { 
		$corSet = "".$sysusu_set['cor'].""; 
	}
	

	$busca[$i]['id'] = "".$rSql['numeroUnico']."";
	$busca[$i]['title'] = "".$rSql['nome']."";
	$busca[$i]['description'] = "parceiro_sysagenda";
	$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
	$busca[$i]['end'] = "".$ano2."-".$mes2."-".$dia2." ".$hora2.":".$min2."";
	$busca[$i]['color'] = "".$corSet."";
	$busca[$i]['url'] = "".$link."".$nomeLimpoUrlModCat."/".$nomeLimpoUrlMod."/editar/".$rSql['id']."/";
	$busca[$i]['className'] = "myClassparceiro_sysagenda";
	$busca[$i]['allDay'] = "false";
	$i++;
}
}

if(trim($pesquisaListaIdsSysconta_a_pagar)=="") { } else {

$rSqlUrlMod = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='sysconta_a_pagar'"));
$nomeLimpoUrlMod = transformaCaractere($rSqlUrlMod['nome']);

$rSqlUrlModCat = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlUrlMod['idsysmod_categoria']."'"));
$nomeLimpoUrlModCat = $rSqlUrlModCat['url_amigavel'];

$qSql = mysql_query("SELECT * FROM sysconta_a_pagar WHERE data BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' ".$pesquisaListaIdsSysconta_a_pagar." ORDER BY data_vencimento");
while($rSql = mysql_fetch_array($qSql)) {

	$dia  = substr($rSql['data_vencimento'],8,2);
	$mes  = substr($rSql['data_vencimento'],5,2);
	$ano  = substr($rSql['data_vencimento'],0,4);

	if(trim($parceiro_adv_processo_tipo_set['cor'])=="") { $corSet = "#333333"; } else { $corSet = "".$parceiro_adv_processo_tipo_set['cor'].""; }

	$busca[$i]['id'] = "".$rSql['numeroUnico']."";
	$busca[$i]['title'] = "".$rSql['nome']."";
	$busca[$i]['description'] = "sysconta_a_pagar";
	$busca[$i]['start'] = "".$ano."-".$mes."-".$dia."";
	$busca[$i]['end'] = "".$ano."-".$mes."-".$dia."";
	$busca[$i]['color'] = "#f20f0f";
	$busca[$i]['url'] = "".$link."".$nomeLimpoUrlModCat."/".$nomeLimpoUrlMod."/editar/".$rSql['id']."/";
	$busca[$i]['className'] = "myClassSysconta_a_pagar";
	$busca[$i]['allDay'] = "false";
	$i++;
}
}

if(trim($pesquisaListaIdsSysconta_a_receber)=="") { } else {

$rSqlUrlMod = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='sysconta_a_receber'"));
$nomeLimpoUrlMod = transformaCaractere($rSqlUrlMod['nome']);

$rSqlUrlModCat = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlUrlMod['idsysmod_categoria']."'"));
$nomeLimpoUrlModCat = $rSqlUrlModCat['url_amigavel'];

$qSql = mysql_query("SELECT * FROM sysconta_a_receber WHERE data BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' ".$pesquisaListaIdsSysconta_a_receber." ORDER BY data_vencimento");
while($rSql = mysql_fetch_array($qSql)) {

	$dia  = substr($rSql['data_vencimento'],8,2);
	$mes  = substr($rSql['data_vencimento'],5,2);
	$ano  = substr($rSql['data_vencimento'],0,4);

	if(trim($parceiro_adv_processo_tipo_set['cor'])=="") { $corSet = "#333333"; } else { $corSet = "".$parceiro_adv_processo_tipo_set['cor'].""; }

	$busca[$i]['id'] = "".$rSql['numeroUnico']."";
	$busca[$i]['title'] = "".$rSql['nome']."";
	$busca[$i]['description'] = "sysconta_a_receber";
	$busca[$i]['start'] = "".$ano."-".$mes."-".$dia."";
	$busca[$i]['end'] = "".$ano."-".$mes."-".$dia."";
	$busca[$i]['color'] = "#81bd0a";
	$busca[$i]['url'] = "".$link."".$nomeLimpoUrlModCat."/".$nomeLimpoUrlMod."/editar/".$rSql['id']."/";
	$busca[$i]['className'] = "myClassSysconta_a_receber";
	$busca[$i]['allDay'] = "false";
	$i++;
}
}

if(trim($pesquisaListaIdsparceiro_adv_processo)=="") { } else {

$rSqlUrlMod = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='parceiro_adv_processo'"));
$nomeLimpoUrlMod = transformaCaractere($rSqlUrlMod['nome']);

$rSqlUrlModCat = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlUrlMod['idsysmod_categoria']."'"));
$nomeLimpoUrlModCat = $rSqlUrlModCat['url_amigavel'];

$qSql = mysql_query("SELECT * FROM parceiro_adv_processo WHERE data BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' ".$pesquisaListaIdsparceiro_adv_processo." AND criador='".$criadorGet."' ORDER BY data_inicio, hora_inicio");
while($rSql = mysql_fetch_array($qSql)) {
	$parceiro_adv_processo_tipo_set = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE id='".$rSql['idparceiro_adv_processo_tipo']."'"));
	
	if(trim($listaAdvProcesso)=="") {
		$listaAdvProcesso = "'".$rSql['numeroUnico']."'";
	} else {
		$listaAdvProcesso = "".$listaAdvProcesso.",'".$rSql['numeroUnico']."'";
	}
	
	$dia  = substr($rSql['data_inicio'],8,2);
	$mes  = substr($rSql['data_inicio'],5,2);
	$ano  = substr($rSql['data_inicio'],0,4);
	$hora = substr($rSql['hora_inicio'],0,2);
	$min  = substr($rSql['hora_inicio'],3,2);

	$dia2  = substr($rSql['data_fim'],8,2);
	$mes2  = substr($rSql['data_fim'],5,2);
	$ano2  = substr($rSql['data_fim'],0,4);
	$hora2 = substr($rSql['hora_fim'],0,2);
	$min2  = substr($rSql['hora_fim'],3,2);

	if(trim($parceiro_adv_processo_tipo_set['cor'])=="") { $corSet = "#333333"; } else { $corSet = "".$parceiro_adv_processo_tipo_set['cor'].""; }

	$busca[$i]['id'] = "".$rSql['numeroUnico']."";
	$busca[$i]['title'] = "COD: ".$rSql['cod']."";
	$busca[$i]['description'] = "parceiro_adv_processo";
	$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
	$busca[$i]['end'] = "".$ano2."-".$mes2."-".$dia2." ".$hora2.":".$min2."";
	$busca[$i]['color'] = "".$corSet."";
	$busca[$i]['url'] = "".$link."".$nomeLimpoUrlModCat."/".$nomeLimpoUrlMod."/editar/".$rSql['id']."/";
	$busca[$i]['className'] = "myClassparceiro_adv_processo";
	$busca[$i]['allDay'] = "false";
	$i++;
}

if(trim($listaAdvProcesso)=="") {
	$pesquisaNumeroUnicoPai = "";
} else {
	$pesquisaNumeroUnicoPai = " AND numeroUnico_pai	IN (".$listaAdvProcesso.")";
}

$qSql = mysql_query("SELECT * FROM parceiro_adv_processo_agenda WHERE data BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' ".$pesquisaNumeroUnicoPai." AND lista_admin LIKE '%|".$criadorGet."|%' ORDER BY data_fim, hora_fim");
while($rSql = mysql_fetch_array($qSql)) {
	$parceiro_adv_processo_set = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo WHERE numeroUnico='".$rSql['numeroUnico_pai']."'"));
	$parceiro_adv_processo_tipo_set = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE id='".$parceiro_adv_processo_set['idparceiro_adv_processo_tipo']."'"));

	$dia  = substr($rSql['data_fim'],8,2);
	$mes  = substr($rSql['data_fim'],5,2);
	$ano  = substr($rSql['data_fim'],0,4);
	$hora = substr($rSql['hora_fim'],0,2);
	$min  = substr($rSql['hora_fim'],3,2);

	if(strrpos($rSql['lista_admin'],"|".$criadorGet."|") === false) { 
		if(trim($parceiro_adv_processo_tipo_set['cor'])=="") { 
			$corSet = "#333333"; 
		} else {
			$corSet = "".$parceiro_adv_processo_tipo_set['cor'].""; 
		}
	} else { 
		$corSet = "".$sysusu_set['cor'].""; 
	}

	$busca[$i]['id'] = "".$rSql['numeroUnico']."";
	$busca[$i]['title'] = "".$rSql['nome']."";
	$busca[$i]['description'] = "parceiro_adv_processo_agenda";
	$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
	$busca[$i]['end'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
	$busca[$i]['color'] = "".$corSet."";
	$busca[$i]['url'] = "".$link."".$nomeLimpoUrlModCat."/".$nomeLimpoUrlMod."/editar/".$parceiro_adv_processo_set['id']."/";
	$busca[$i]['className'] = "myClassparceiro_adv_processo_agenda";
	$busca[$i]['allDay'] = "false";
	$i++;
}
}

$qSql = mysql_query("SELECT * FROM adv_intimacao_agenda WHERE data BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' AND lista_admin LIKE '%|".$criadorGet."|%' ORDER BY data_fim, hora_fim");
while($rSql = mysql_fetch_array($qSql)) {
	
	if(trim($rSql['somente_criador'])=="1") {
		if(trim($rSql['criador'])==$criadorGet) {
			$mostra_intimacao_agenda = "1";
		} else {
			$mostra_intimacao_agenda = "0";
		}
	} else {
		$mostra_intimacao_agenda = "1";
	}

	if(trim($mostra_intimacao_agenda)=="1") {
		$adv_intimacao_set = mysql_fetch_array(mysql_query("SELECT * FROM adv_intimacao WHERE numeroUnico='".$rSql['numeroUnico_pai']."'"));
	
		if(strrpos($rSql['lista_admin'],"|".$criadorGet."|") === false) { 
			$corSet = "#CA3B2A"; 
		} else { 
			$corSet = "".$sysusu_set['cor'].""; 
		}
	
		$dia  = substr($rSql['data_fim'],8,2);
		$mes  = substr($rSql['data_fim'],5,2);
		$ano  = substr($rSql['data_fim'],0,4);
		$hora = substr($rSql['hora_fim'],0,2);
		$min  = substr($rSql['hora_fim'],3,2);
	
		$busca[$i]['id'] = "".$rSql['numeroUnico']."";
		$busca[$i]['title'] = "".$rSql['nome']."";
		$busca[$i]['description'] = "adv_intimacao_agenda";
		$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
		$busca[$i]['end'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
		$busca[$i]['color'] = "".$corSet."";
		$busca[$i]['url'] = "javascript:intimacao_agenda_popup('".$rSql['id']."');";
		/*$busca[$i]['url'] = "".$link."intimacoes/intimacoes-pendentes/editar/".$adv_intimacao_set['cod']."/";*/
		if(trim($rSql['concluido'])=="1") {
			$busca[$i]['className'] = "myClassAdv_intimacao_agenda_concluida";
		} else {
			$busca[$i]['className'] = "myClassAdv_intimacao_agenda";
		}
		$busca[$i]['allDay'] = "false";
		$i++;
	}
}

echo json_encode($busca);
//echo $pesquisaListaIdsparceiro_syscronograma;
?>
