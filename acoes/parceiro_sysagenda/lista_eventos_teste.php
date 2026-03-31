<?php
include("../../include/inc/data.php");


if(trim($_GET['filtro'])=="1") {
	$listaIdGet = $_GET['listaIdS'];
	$listaIdGet = str_replace("||","','",$listaIdGet);
	$listaIdGet = str_replace("|","'",$listaIdGet);
	$pesquisaListaIds = " AND idparceiro_sysagenda_categoria IN(".$listaIdGet.") ";
	$criadorGet = $_GET['criadorS'];
	$var1Get = $_GET['var1S'];
	$var2Get = $_GET['var2S'];
} else {
	$pesquisaListaIds = "";
	$criadorGet = $_REQUEST['criadorS'];
	$var1Get = $_REQUEST['var1S'];
	$var2Get = $_REQUEST['var2S'];
}

$i=0;

$qSql = mysql_query("SELECT * FROM parceiro_sysagenda WHERE data_inicio BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' ".$pesquisaListaIds." AND criador='".$criadorGet."' OR lista_admin LIKE '%|".$criadorGet."|%'  ORDER BY data_inicio, hora_inicio");
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

	if(trim($parceiro_sysagenda_categoria_set['cor'])=="") { $corSet = "#333333"; } else { $corSet = "#".$parceiro_sysagenda_categoria_set['cor'].""; }

	$busca[$i]['id'] = "".$rSql['id']."";
	$busca[$i]['title'] = "".$rSql['nome']."";
	$busca[$i]['description'] = "parceiro_sysagenda";
	$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
	$busca[$i]['end'] = "".$ano2."-".$mes2."-".$dia2." ".$hora2.":".$min2."";
	$busca[$i]['color'] = "".$corSet."";
	$busca[$i]['url'] = "".$link."".$var1Get."/".$var2Get."/editar/".$rSql['id']."/";
	$busca[$i]['className'] = "categoria-".$rSql['idparceiro_sysagenda_categoria']."";
	$busca[$i]['allDay'] = "false";
	$i++;
}

echo json_encode($busca);
?>
