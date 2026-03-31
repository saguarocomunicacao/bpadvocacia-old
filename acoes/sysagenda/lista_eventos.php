<?php
include("../../include/inc/data.php");
include("../../include/inc/main.php");


$criadorGet = $_GET['criadorS'];
$var1Get = $_GET['var1S'];
$var2Get = $_GET['var2S'];

$sysusu_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$criadorGet."'"));

$listaIdGet = $_GET['listaIdS'];
if(trim($listaIdGet)=="") {
	$pesquisaListaIds = "";
} else {
	$listaIdGet = str_replace("||","','",$listaIdGet);
	$listaIdGet = str_replace("|","'",$listaIdGet);
	$pesquisaListaIds = " AND idsysagenda_categoria IN(".$listaIdGet.") ";
}

$i=0;

$qSql = mysql_query("SELECT * FROM sysagenda WHERE data_inicio BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' ".$pesquisaListaIds."  ORDER BY data_inicio, hora_inicio");
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

	$data_evento = ajustaData($rSql['data'],"d/m/Y");
	
	$busca[$i]['id'] = "".$rSql['id']."";
	$busca[$i]['title'] = "".$data_evento." | ".$rSql['nome']."";
	$busca[$i]['description'] = "sysagenda";
	$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
	$busca[$i]['end'] = "".$ano2."-".$mes2."-".$dia2." ".$hora2.":".$min2."";
	if(trim($rSql['concluido'])=="1") {
	$busca[$i]['color'] = "#424830";
	} else {
	$busca[$i]['color'] = "".$corSet."";
	}
	$busca[$i]['url'] = "javascript:sysagenda_popup('".$rSql['id']."');";
	if(trim($rSql['concluido'])=="1") {
		$busca[$i]['className'] = "myClassSysagenda_concluida";
	} else {
		$busca[$i]['className'] = "myClassSysagenda";
	}
	$busca[$i]['allDay'] = "false";
	$i++;
}

echo json_encode($busca);
?>
