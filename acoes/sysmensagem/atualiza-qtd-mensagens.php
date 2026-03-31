<?
include("../../include/inc/data.php");

if(trim($_SESSION["perfil"])=="administrador") { 
	$campoFiltro = "destinatario_admin";
} else {
	$campoFiltro = "destinatario_cliente";
}


$qSql = mysql_query("SELECT * FROM sysmensagem WHERE ".$campoFiltro." LIKE '%|".$sysusu['id']."|%' AND stat='1'");
while($rSql = mysql_fetch_array($qSql)) {
	$lida = mysql_num_rows(mysql_query("SELECT * FROM sysmensagem WHERE numeroUnico='".$rSql['numeroUnico']."' AND lista_".$campoFiltro." LIKE '%|".$sysusu['id']."|%'"));
	if(trim($lida)==0) { $msgN++; }
}

if($msgN==0) { } else { echo $msgN; }
?>
