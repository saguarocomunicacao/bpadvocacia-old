<?php
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("../../include/inc/main.php");
include("../../include/inc/data.php");


session_name("painel-admin");
session_start();

$criadorGet = $_GET['criadorS'];
$listaIdSFiltra_sysusuGet = $_GET['listaIdSFiltra_sysusuS'];
$listaIdSFiltra_sysusuGet = str_replace("||",",",$listaIdSFiltra_sysusuGet);
$listaIdSFiltra_sysusuGet = str_replace("|","",$listaIdSFiltra_sysusuGet);


$palavra_chaveGet = $_GET['palavra_chaveS'];

$_SESSION['_listaIdSFiltra_sysusuS'] = $_GET['listaIdSFiltra_sysusuS'];
$_SESSION['_palavra_chaveS'] = $_GET['palavra_chaveS'];

if(trim($listaIdSFiltra_sysusuGet)=="") {
	$listaIdSFiltra_sysusuGet = "0000000";
}

$Ids = explode(",", $listaIdSFiltra_sysusuGet);
foreach($Ids as $Id) {
	if(trim($Id)=="0000000") {
		$filtroSysusu = "";
	} else {
		$filtroSysusu = " AND mod_sys_arquivo.lista_admin LIKE '%|".$Id."|%' ";
	}

	if(trim($palavra_chaveGet)=="") {
		$filtroPalavra_chave = "";
	} else {
		$filtroPalavra_chave = " AND mod_sys_arquivo.nome LIKE '%".$palavra_chaveGet."%' ";
	}

	$i=0;
	$SQL = "
						SELECT 
							mod_sys_arquivo.tabela, 
							mod_sys_arquivo.responsavel, 
							mod_sys_arquivo.situacao, 
							mod_sys_arquivo.numeroUnico, 
							mod_sys_arquivo.nome, 
							mod_sys_arquivo.id_antigo, 
							mod_sys_arquivo.lista_admin, 
							mod_sys_arquivo.concluido, 
							mod_sys_arquivo.criador, 
							mod_sys_arquivo.data_inicio, 
							mod_sys_arquivo.hora_inicio,
							mod_sys_arquivo.data_fim, 
							mod_sys_arquivo.hora_fim,
	
							mod_sysusu.cor AS sysusu_cor
	
						FROM 
							sys_arquivo AS mod_sys_arquivo 
	
						LEFT JOIN 
							sysusu AS mod_sysusu ON (mod_sysusu.id = mod_sys_arquivo.criador)
						WHERE
							mod_sys_arquivo.data BETWEEN '2023-01-01 00:00:00' AND '9999-12-31 23:59:59'
							".$filtroSysusu."
							".$filtroPalavra_chave."
	
						ORDER BY 
							mod_sys_arquivo.data_inicio, 
							mod_sys_arquivo.hora_inicio
						";
	#echo $SQL_PRINT."<br><br>";

	$qSql = mysql_query("".$SQL."");
	while($rSql = mysql_fetch_array($qSql)) {
		
	
		if(trim($rSql['tabela'])=="adv_intimacao_agenda") {
			$dia  = substr($rSql['data_fim'],8,2);
			$mes  = substr($rSql['data_fim'],5,2);
			$ano  = substr($rSql['data_fim'],0,4);
			$hora = substr($rSql['hora_fim'],0,2);
			$min  = substr($rSql['hora_fim'],3,2);
		} else {
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
		}
		
		if(trim($rSql['tabela'])=="syscronograma") {
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
	
			if(trim($rSql['criador'])=="".$criadorGet.""||trim($rSql['responsavel'])=="".$criadorGet."") { 
				$mostra_syscronograma = "1";
			} else {
				$mostra_syscronograma = "0";
			}
			if(trim($mostra_syscronograma)=="1") { 
				$busca[$i]['id'] = "".$rSql['numeroUnico']."";
				$busca[$i]['title'] = "".$rSql['nome']."";
				$busca[$i]['description'] = "syscronograma";
				$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
				$busca[$i]['end'] = "".$ano2."-".$mes2."-".$dia2." ".$hora2.":".$min2."";
				$busca[$i]['color'] = "".$corSet."";
				$busca[$i]['url'] = "".$link."".$nomeLimpoUrlModCat."/".$nomeLimpoUrlMod."/editar/".$rSql['id_antigo']."/";
				$busca[$i]['className'] = "myClassSyscronograma";
				$busca[$i]['allDay'] = "false";
				$i++;
			}
		} elseif(trim($rSql['tabela'])=="sysagenda") {
			/*
			if(trim($rSql['criador'])=="".$criadorGet."") { 
				$corSet = "".$sysusu_set['cor'].""; 
			} else {
			*/
			if(strrpos($rSql['lista_admin'],"|".$criadorGet."|") === false) { 
				if(trim($rSql['lista_admin']) == "") { 
					$corSet = "".$rSql['sysusu_cor'].""; 
				} else {
					$id_lista_admin = str_replace("|","",$rSql['lista_admin']);
					$sysusu_resp = mysql_fetch_array(mysql_query("SELECT cor FROM sysusu WHERE id='".$id_lista_admin."'"));
					$corSet = "".$sysusu_resp['cor'].""; 
				}
			} else { 
				if(trim($rSql['lista_admin']) == "") { 
					$corSet = "".$sysusu_set['cor'].""; 
				} else {
					$id_lista_admin = str_replace("|","",$rSql['lista_admin']);
					$sysusu_resp = mysql_fetch_array(mysql_query("SELECT cor FROM sysusu WHERE id='".$id_lista_admin."'"));
					$corSet = "".$sysusu_resp['cor'].""; 
				}
			}
		
			$busca[$i]['id'] = "".$rSql['numeroUnico']."";
			$busca[$i]['title'] = "".$data_evento." \n ".$rSql['nome']."";
			$busca[$i]['description'] = "sysagenda";
			$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
			$busca[$i]['end'] = "".$ano2."-".$mes2."-".$dia2." ".$hora2.":".$min2."";
			if(trim($rSql['concluido'])=="99") {
				$busca[$i]['color'] = "#179bff";
			} else if(trim($rSql['concluido'])=="1") {
				$busca[$i]['color'] = "#424830";
			} else {
				$busca[$i]['color'] = "".$corSet."";
			}
			$busca[$i]['url'] = "javascript:sysagenda_popup('".$rSql['id_antigo']."');";
			if(trim($rSql['concluido'])=="1") {
				$busca[$i]['className'] = "myClassSysagenda_concluida";
			} else {
				$busca[$i]['className'] = "myClassSysagenda";
			}
			$busca[$i]['allDay'] = "false";
			$i++;
		} elseif(trim($rSql['tabela'])=="adv_processo") {
			/*
			$busca[$i]['id'] = "".$rSql['numeroUnico']."";
			$busca[$i]['title'] = "COD: ".$rSql['cod']."";
			$busca[$i]['description'] = "adv_processo";
			$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
			$busca[$i]['end'] = "".$ano2."-".$mes2."-".$dia2." ".$hora2.":".$min2."";
			$busca[$i]['color'] = "".$corSet."";
			$busca[$i]['url'] = "".$link."".$nomeLimpoUrlModCat."/".$nomeLimpoUrlMod."/editar/".$rSql['id_antigo']."/";
			$busca[$i]['className'] = "myClassAdv_processo";
			$busca[$i]['allDay'] = "false";
			$i++;
			*/
			$i++;
		} elseif(trim($rSql['tabela'])=="adv_processo_agenda") {
			if(strrpos($rSql['lista_admin'],"|".$criadorGet."|") === false) { 
				if(trim($rSql['lista_admin']) == "") { 
					$corSet = "".$rSql['sysusu_cor'].""; 
				} else {
					$id_lista_admin = str_replace("|","",$rSql['lista_admin']);
					$sysusu_resp = mysql_fetch_array(mysql_query("SELECT cor FROM sysusu WHERE id='".$id_lista_admin."'"));
					$corSet = "".$sysusu_resp['cor'].""; 
				}
			} else { 
				if(trim($rSql['lista_admin']) == "") { 
					$corSet = "".$sysusu_set['cor'].""; 
				} else {
					$id_lista_admin = str_replace("|","",$rSql['lista_admin']);
					$sysusu_resp = mysql_fetch_array(mysql_query("SELECT cor FROM sysusu WHERE id='".$id_lista_admin."'"));
					$corSet = "".$sysusu_resp['cor'].""; 
				}
			}
	
			$busca[$i]['id'] = "".$rSql['numeroUnico']."";
			$busca[$i]['title'] = "".$rSql['nome']."";
			$busca[$i]['description'] = "adv_processo_agenda";
			$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
			$busca[$i]['end'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
			if(trim($rSql['concluido'])=="99") {
				$busca[$i]['color'] = "#179bff";
			} else if(trim($rSql['concluido'])=="1") {
				$busca[$i]['color'] = "#424830";
			} else {
				$busca[$i]['color'] = "".$corSet."";
			}
			$busca[$i]['url'] = "javascript:processo_agenda_popup('".$rSql['id_antigo']."');";
			if(trim($rSql['concluido'])=="1") {
				$busca[$i]['className'] = "myClassAdv_processo_agenda_concluida";
			} else {
				$busca[$i]['className'] = "myClassAdv_processo_agenda";
			}
			$busca[$i]['allDay'] = "false";
			$i++;
		} elseif(trim($rSql['tabela'])=="adv_intimacao_agenda") {
			if(strrpos($rSql['lista_admin'],"|".$criadorGet."|") === false) { 
				if(trim($rSql['lista_admin']) == "") { 
					$corSet = "".$rSql['sysusu_cor'].""; 
				} else {
					$id_lista_admin = str_replace("|","",$rSql['lista_admin']);
					$sysusu_resp = mysql_fetch_array(mysql_query("SELECT cor FROM sysusu WHERE id='".$id_lista_admin."'"));
					$corSet = "".$sysusu_resp['cor'].""; 
				}
			} else { 
				if(trim($rSql['lista_admin']) == "") { 
					$corSet = "".$sysusu_set['cor'].""; 
				} else {
					$id_lista_admin = str_replace("|","",$rSql['lista_admin']);
					$sysusu_resp = mysql_fetch_array(mysql_query("SELECT cor FROM sysusu WHERE id='".$id_lista_admin."'"));
					$corSet = "".$sysusu_resp['cor'].""; 
				}
			}
		
			$busca[$i]['id'] = "".$rSql['numeroUnico']."";
			$busca[$i]['title'] = "".$rSql['nome']."";
			$busca[$i]['description'] = "adv_intimacao_agenda";
			$busca[$i]['start'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
			$busca[$i]['end'] = "".$ano."-".$mes."-".$dia." ".$hora.":".$min."";
			if(trim($rSql['concluido'])=="99") {
				$busca[$i]['color'] = "#179bff";
			} else if(trim($rSql['concluido'])=="1") {
				$busca[$i]['color'] = "#424830";
			} else {
				$busca[$i]['color'] = "".$corSet."";
			}
			$busca[$i]['url'] = "javascript:intimacao_agenda_popup('".$rSql['id_antigo']."');";
			if(trim($rSql['concluido'])=="1") {
				$busca[$i]['className'] = "myClassAdv_intimacao_agenda_concluida";
			} else {
				$busca[$i]['className'] = "myClassAdv_intimacao_agenda";
			}
			$busca[$i]['allDay'] = "false";
			$i++;
		}
	
	}
}
echo json_encode($busca);
?>
