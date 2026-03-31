<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");


$criadorGet = $_GET['criadorS'];
if(trim($_REQUEST['filtroDataS'])=="") {
$filtroDataGet = $_GET['filtroDataS'];
} else {
$filtroDataGet = $_REQUEST['filtroDataS'];
}

$filtroDataGet_ini = "".$filtroDataGet."-01";
$filtroDataGet_fim = "".$filtroDataGet."-31";
if(trim($filtroDataGet)=="") { } else {
	$filtroDataSet = " data_inicio BETWEEN '".$filtroDataGet_ini."' AND '".$filtroDataGet_fim."' ";
}

$sysusu_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$criadorGet."'"));

$listaIdGetSyscronograma = $_GET['listaIdSSyscronograma'];
if(trim($listaIdGetSyscronograma)=="") {
	$pesquisaListaIdsSyscronograma = "";
} else {
	$listaIdGetSyscronograma = str_replace("||","','",$listaIdGetSyscronograma);
	$listaIdGetSyscronograma = str_replace("|","'",$listaIdGetSyscronograma);
	$pesquisaListaIdsSyscronograma = "AND situacao IN (".$listaIdGetSyscronograma.") ";
}

$listaIdGetSysagenda = $_GET['listaIdSSysagenda'];
if(trim($listaIdGetSysagenda)=="") {
	$pesquisaListaIdsSysagenda = "";
} else {
	$listaIdGetSysagenda = str_replace("||","','",$listaIdGetSysagenda);
	$listaIdGetSysagenda = str_replace("|","'",$listaIdGetSysagenda);
	$pesquisaListaIdsSysagenda = " AND idsysagenda_categoria IN (".$listaIdGetSysagenda.") ";
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

$listaIdGetAdv_processo = $_GET['listaIdSAdv_processo'];
if(trim($listaIdGetAdv_processo)=="") {
	$pesquisaListaIdsAdv_processo = "";
} else {
	$listaIdGetAdv_processo = str_replace("||","','",$listaIdGetAdv_processo);
	$listaIdGetAdv_processo = str_replace("|","'",$listaIdGetAdv_processo);
	$pesquisaListaIdsAdv_processo = " AND idadv_processo_tipo IN (".$listaIdGetAdv_processo.") ";
}

$i=0;


$rSqlUrlMod = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='syscronograma'"));
$nomeLimpoUrlMod = transformaCaractere($rSqlUrlMod['nome']);

$rSqlUrlModCat = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlUrlMod['idsysmod_categoria']."'"));
$nomeLimpoUrlModCat = $rSqlUrlModCat['url_amigavel'];

if(trim($filtroDataSet)=="") { $filtroData_set = ""; } else {
	$filtroData_set = " WHERE ".$filtroDataSet." ";
}

#echo "SELECT * FROM syscronograma ".$filtroData_set." ORDER BY data_inicio, hora_inicio <br><br><br>";

$qSql = mysql_query("SELECT * FROM syscronograma ".$filtroData_set." ORDER BY data_inicio, hora_inicio");
while($rSql = mysql_fetch_array($qSql)) {
	
	if(trim($rSql['criador'])=="".$criadorGet.""||trim($rSql['responsavel'])=="".$criadorGet."") { 
		$mostra_syscronograma = "1";
	} else {
		$mostra_syscronograma = "0";
	}
	if(trim($mostra_syscronograma)=="1") { 

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
		$busca[$i]['description'] = "syscronograma";
		$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
		$busca[$i]['end'] = "".$ano2."-".$mes2."-".$dia2." ".$hora2.":".$min2."";
		$busca[$i]['color'] = "".$corSet."";
		$busca[$i]['url'] = "".$link."".$nomeLimpoUrlModCat."/".$nomeLimpoUrlMod."/editar/".$rSql['id']."/";
		$busca[$i]['className'] = "myClassSyscronograma";
		$busca[$i]['allDay'] = "false";
		$i++;

	}
}

$rSqlUrlMod = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='sysagenda'"));
$nomeLimpoUrlMod = transformaCaractere($rSqlUrlMod['nome']);

$rSqlUrlModCat = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlUrlMod['idsysmod_categoria']."'"));
$nomeLimpoUrlModCat = $rSqlUrlModCat['url_amigavel'];

if(trim($filtroDataSet)=="") { $filtroData_set = ""; } else {
	$filtroData_set = " WHERE ".$filtroDataSet." ";
}
$qSql = mysql_query("SELECT * FROM sysagenda ".$filtroData_set." ORDER BY data_inicio, hora_inicio");
while($rSql = mysql_fetch_array($qSql)) {
	$sysagenda_categoria_set = mysql_fetch_array(mysql_query("SELECT * FROM sysagenda_categoria WHERE id='".$rSql['idsysagenda_categoria']."'"));
	
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

	/*
	if(trim($rSql['criador'])=="".$criadorGet."") { 
		$corSet = "".$sysusu_set['cor'].""; 
	} else {
		if(strrpos($rSql['lista_admin'],"|".$criadorGet."|") === false) { 
			if(trim($sysagenda_categoria_set['cor'])=="") { 
				$corSet = "#333333"; 
			} else { 
				$corSet = "#".$sysagenda_categoria_set['cor'].""; 
			}
		} else { 
			$corSet = "".$sysusu_set['cor'].""; 
		}
	}
	*/

	if(trim($rSql['criador'])=="".$criadorGet."") { 
		$corSet = "#333333"; 
	} else {
		if(strrpos($rSql['lista_admin'],"|".$criadorGet."|") === false) { 
			$corSet = "#333333"; 
		} else { 
			$corSet = "".$sysusu_set['cor'].""; 
		}
	}
	

	$lista_sysusu_resp = "";
	$lista_sysusu_resp = str_replace("||","','",$rSql['lista_admin']);
	$lista_sysusu_resp = str_replace("|","'",$lista_sysusu_resp);
	$qSqlSysusu = mysql_query("SELECT * FROM sysusu WHERE id IN (".$lista_sysusu_resp.") ORDER BY nome LIMIT 1");
	while($rSqlSysusu = mysql_fetch_array($qSqlSysusu)) {
		$corSet = "".$rSqlSysusu['cor'].""; 
	}

	$data_evento = ajustaDataReturn($rSql['data'],"d/m/Y");

	$busca[$i]['id'] = "".$rSql['numeroUnico']."";
	$busca[$i]['title'] = "".$data_evento." \n ".$rSql['nome']."";
	$busca[$i]['description'] = "sysagenda";
	$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
	$busca[$i]['end'] = "".$ano2."-".$mes2."-".$dia2." ".$hora2.":".$min2."";
	if(trim($rSql['concluido'])=="1") {
	$busca[$i]['color'] = "#424830";
	} else {
	$busca[$i]['color'] = "".$corSet."";
	}
	$busca[$i]['url'] = "javascript:sysagenda_popup('".$rSql['id']."');";
	/*$busca[$i]['url'] = "".$link."".$nomeLimpoUrlModCat."/".$nomeLimpoUrlMod."/editar/".$rSql['id']."/";*/
	if(trim($rSql['concluido'])=="1") {
		$busca[$i]['className'] = "myClassSysagenda_concluida";
	} else {
		$busca[$i]['className'] = "myClassSysagenda";
	}
	$busca[$i]['allDay'] = "false";
	$i++;
}

$rSqlUrlMod = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='adv_processo'"));
$nomeLimpoUrlMod = transformaCaractere($rSqlUrlMod['nome']);

$rSqlUrlModCat = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlUrlMod['idsysmod_categoria']."'"));
$nomeLimpoUrlModCat = $rSqlUrlModCat['url_amigavel'];

if(trim($filtroDataSet)=="") { $filtroData_set = ""; } else {
	$filtroData_set = " WHERE ".$filtroDataSet." ";
}
$qSql = mysql_query("SELECT * FROM adv_processo ".$filtroData_set." ORDER BY data_inicio, hora_inicio");
while($rSql = mysql_fetch_array($qSql)) {
	$adv_processo_tipo_set = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo_tipo WHERE id='".$rSql['idadv_processo_tipo']."'"));
	
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

	if(trim($adv_processo_tipo_set['cor'])=="") { $corSet = "#333333"; } else { $corSet = "".$adv_processo_tipo_set['cor'].""; }

	/*
	$busca[$i]['id'] = "".$rSql['numeroUnico']."";
	$busca[$i]['title'] = "COD: ".$rSql['cod']."";
	$busca[$i]['description'] = "adv_processo";
	$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
	$busca[$i]['end'] = "".$ano2."-".$mes2."-".$dia2." ".$hora2.":".$min2."";
	$busca[$i]['color'] = "".$corSet."";
	$busca[$i]['url'] = "".$link."".$nomeLimpoUrlModCat."/".$nomeLimpoUrlMod."/editar/".$rSql['id']."/";
	$busca[$i]['className'] = "myClassAdv_processo";
	$busca[$i]['allDay'] = "false";
	$i++;
	*/
}

if(trim($listaAdvProcesso)=="") {
	$pesquisaNumeroUnicoPai = "";
} else {
	$pesquisaNumeroUnicoPai = " AND numeroUnico_pai	IN (".$listaAdvProcesso.")";
}

if(trim($filtroDataSet)=="") { $filtroData_set = ""; } else {
	$filtroData_set = " WHERE ".$filtroDataSet." ";
}
$qSql = mysql_query("SELECT * FROM adv_processo_agenda ".$filtroData_set." ORDER BY data_fim, hora_fim");
while($rSql = mysql_fetch_array($qSql)) {
	$adv_processo_set = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo WHERE numeroUnico='".$rSql['numeroUnico_pai']."'"));
	$adv_processo_tipo_set = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo_tipo WHERE id='".$adv_processo_set['idadv_processo_tipo']."'"));

	$dia  = substr($rSql['data_fim'],8,2);
	$mes  = substr($rSql['data_fim'],5,2);
	$ano  = substr($rSql['data_fim'],0,4);
	$hora = substr($rSql['hora_fim'],0,2);
	$min  = substr($rSql['hora_fim'],3,2);

	if(trim($rSql['criador'])=="".$criadorGet."") { 
		$corSet = "#333333"; 
	} else {
		if(strrpos($rSql['lista_admin'],"|".$criadorGet."|") === false) { 
			$corSet = "#333333"; 
		} else { 
			$corSet = "".$sysusu_set['cor'].""; 
		}
	}

	$lista_sysusu_resp = "";
	$lista_sysusu_resp = str_replace("||","','",$rSql['lista_admin']);
	$lista_sysusu_resp = str_replace("|","'",$lista_sysusu_resp);
	$qSqlSysusu = mysql_query("SELECT * FROM sysusu WHERE id IN (".$lista_sysusu_resp.") ORDER BY nome LIMIT 1");
	while($rSqlSysusu = mysql_fetch_array($qSqlSysusu)) {
		$corSet = "".$rSqlSysusu['cor'].""; 
	}

	$busca[$i]['id'] = "".$rSql['numeroUnico']."";
	$busca[$i]['title'] = "".$rSql['nome']."";
	$busca[$i]['description'] = "adv_processo_agenda";
	$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
	$busca[$i]['end'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
	if(trim($rSql['concluido'])=="1") {
	$busca[$i]['color'] = "#424830";
	} else {
	$busca[$i]['color'] = "".$corSet."";
	}
	$busca[$i]['url'] = "javascript:processo_agenda_popup('".$rSql['id']."');";
	if(trim($rSql['concluido'])=="1") {
		$busca[$i]['className'] = "myClassAdv_processo_agenda_concluida";
	} else {
		$busca[$i]['className'] = "myClassAdv_processo_agenda";
	}
	$busca[$i]['allDay'] = "false";
	$i++;
}

if(trim($filtroDataSet)=="") { $filtroData_set = ""; } else {
	$filtroData_set = " WHERE ".$filtroDataSet." ";
}
$qSql = mysql_query("SELECT * FROM adv_intimacao_agenda ".$filtroData_set." ORDER BY data_fim, hora_fim");
while($rSql = mysql_fetch_array($qSql)) {
	
	$adv_intimacao_set = mysql_fetch_array(mysql_query("SELECT * FROM adv_intimacao WHERE numeroUnico='".$rSql['numeroUnico_pai']."'"));

	if(trim($rSql['criador'])=="".$criadorGet."") { 
		$corSet = "#333333"; 
	} else {
		if(strrpos($rSql['lista_admin'],"|".$criadorGet."|") === false) { 
			$corSet = "#333333"; 
		} else { 
			$corSet = "".$sysusu_set['cor'].""; 
		}
	}
	
	$lista_sysusu_resp = "";
	$lista_sysusu_resp = str_replace("||","','",$rSql['lista_admin']);
	$lista_sysusu_resp = str_replace("|","'",$lista_sysusu_resp);
	$qSqlSysusu = mysql_query("SELECT * FROM sysusu WHERE id IN (".$lista_sysusu_resp.") ORDER BY nome LIMIT 1");
	while($rSqlSysusu = mysql_fetch_array($qSqlSysusu)) {
		$corSet = "".$rSqlSysusu['cor'].""; 
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
	if(trim($rSql['concluido'])=="1") {
	$busca[$i]['color'] = "#424830";
	} else {
	$busca[$i]['color'] = "".$corSet."";
	}
	$busca[$i]['url'] = "javascript:intimacao_agenda_popup('".$rSql['id']."');";
	if(trim($rSql['concluido'])=="1") {
		$busca[$i]['className'] = "myClassAdv_intimacao_agenda_concluida";
	} else {
		$busca[$i]['className'] = "myClassAdv_intimacao_agenda";
	}
	$busca[$i]['allDay'] = "false";
	$i++;

}

echo json_encode($busca);
?>
